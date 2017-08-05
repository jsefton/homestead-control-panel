<?php

namespace App\Console\Commands;

use App\Homestead;
use App\Site;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;

class TaskFetchSites extends Command
{
    use PrependsOutput, PrependsTimestamp;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homestead:sites-fetch {--box=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch sites for Homestead box';

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
        $this->info('Starting site import of box: ' . $box->box_name);
        exec('cp -aR ' . $box->yaml_location . ' ' . storage_path() . '/app/box-' . $box->id . '.yaml');
        
        $yaml = Yaml::parse(file_get_contents(storage_path() . '/app/box-' . $box->id . '.yaml'));

        $box->ip_address = $yaml['ip'];
        $box->cpus = $yaml['cpus'];
        $box->memory = $yaml['memory'];
        $box->save();
        $this->line('Box information updated: ip = ' . $box->ip_address);
        $this->line('Box information updated: cpus = ' . $box->cpus);
        $this->line('Box information updated: memory = ' . $box->memory);

        $previousSites = Site::where('homestead_id', $box->id)->get();
        if($previousSites->count() > 0) {
            foreach($previousSites as $previousSite) {
                $previousSite->delete();
            }
        }

        if(isset($yaml['sites'])) {
            foreach($yaml['sites'] as $siteData) {
                
                $site = Site::withTrashed()->where('site_domain', $siteData['map'])->first();

                if($site) {
                    $site->restore();
                }
                if(!$site) {
                    $site = new Site;
                }
                $site->homestead_id = $box->id;
                $site->site_domain = $siteData['map'];
                $site->site_path = $siteData['to'];
                $site->save();
                $this->line('Box Site: ' . $site->site_domain);
            }
        }

        $this->info('Complete!');
    }
}
