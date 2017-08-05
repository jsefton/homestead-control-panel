<?php

namespace App\Console\Commands;

use App\Site;
use Illuminate\Console\Command;

class TaskTailLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homestead:logs {--site=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tail logs of a Homestead box';

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
        $site = Site::find($this->option('site'));
        if(!$site) {
            $this->error('Site not found');
            exit;
        }

        $box = $site->homestead;
        $logPath = '/var/log/nginx/' . $site->site_domain . '-error.log';
        $output = shell_exec('ssh vagrant@' . $box->ip_address . ' cat ' . $logPath);
        if($output == "") {
            $output = "No errors to show :)";
        }
        file_put_contents(storage_path() . '/logs/site-log-' . $site->id . '.log', $output);
    }
}
