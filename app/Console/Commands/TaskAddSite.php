<?php

namespace App\Console\Commands;

use App\Homestead;
use App\Site;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;

class TaskAddSite extends Command
{
    use PrependsOutput, PrependsTimestamp;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homestead:add-site {--box=} {--domain=} {--folder=} {--db=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add site for Homestead box';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = $this->option('box');
        if(!$id) {
            $this->error('Invalid or missing box');
            exit;
        }

        $box = Homestead::find($id);
        if(!$box) {
            $this->error('No box found with ID: ' . $id);
            exit;
        }

        exec('cp -aR ' . $box->yaml_location . ' ' . storage_path() . '/app/box-' . $box->id . '.yaml');
        
        $yaml = Yaml::parse(file_get_contents(storage_path() . '/app/box-' . $box->id . '.yaml'));

        if(!$this->option('domain') || !$this->option('folder')) {
            $this->error('A domain and folder is required to be passed');
            exit;
        }

        $this->info('Adding too to box: ' . $box->box_name . ' for domain: ' . $this->option('domain'));

        // Check if domain already exists in this Yaml
        $exists = false;
        if(isset($yaml['sites'])) {
            foreach ($yaml['sites'] as $siteData) {
                if($siteData['map'] == $this->option('domain')) {
                    $exists = true;
                }
            }
        }


        if($this->option('db')) {
            if($this->option('db')) {
                if(!in_array($this->option('db'), $yaml['databases'])) {
                    $yaml['databases'][] = $this->option('db');
                }
            }
        }

        if($exists === true) {
            $this->error('Domain already exists in Homestead.yaml');
            exit;
        }

        $yaml['sites'][] = [
            'map' => $this->option('domain'),
            'to' => $this->option('folder')
        ];


        // Put update Yaml back in temp folder
        $yamlContents = Yaml::dump($yaml, 3);
        file_put_contents(storage_path() . '/app/box-' . $box->id . '.yaml', $yamlContents);

        // Copy temp Yaml back to primary location that is used
        exec('cp -aR ' . storage_path() . '/app/box-' . $box->id . '.yaml ' . $box->yaml_location . '');

        $box->ip_address = $yaml['ip'];
        $box->cpus = $yaml['cpus'];
        $box->memory = $yaml['memory'];
        $box->save();

        $previousSites = Site::where('homestead_id', $box->id)->get();
        if($previousSites->count() > 0) {
            foreach($previousSites as $previousSite) {
                $previousSite->delete();
            }
        }

        if(isset($yaml['sites'])) {
            foreach($yaml['sites'] as $siteData) {
                
                $site = Site::withTrashed()->where('site_domain', $siteData['map'])->where('homestead_id', $box->id)->first();

                if($site) {
                    $site->restore();
                }
                if(!$site) {
                    $site = new Site;
                }
                $site->homestead_id = $box->id;
                $site->site_domain = $siteData['map'];
                $site->site_path = $siteData['to'];
                if($this->option('db') && $siteData['to'] == $this->option('domain')) {
                    $site->database_name = $this->option('db');
                }
                $site->save();
            }
        }

        $this->info('Site Added');
    }
}
