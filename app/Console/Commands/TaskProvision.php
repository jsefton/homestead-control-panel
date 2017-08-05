<?php

namespace App\Console\Commands;

use App\Homestead;
use Illuminate\Console\Command;

class TaskProvision extends Command
{

    use PrependsOutput, PrependsTimestamp;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homestead:provision {--box=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs provision task on Homestead box';

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
        $this->info('Starting provision on of box: ' . $box->box_name);
        sleep(1);
        if($box->homestead_alias) {
            exec('homestead provision > ' . storage_path() . "/logs/artisan-tasks.log");
        } else {
            exec('cd ' . $box->vagrant_file_location . ' && vagrant provision > ' .  storage_path() . "/logs/artisan-tasks.log");
        }
        $this->info('Complete!');
    }
}
