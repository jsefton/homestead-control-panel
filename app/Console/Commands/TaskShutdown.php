<?php

namespace App\Console\Commands;

use App\Homestead;
use Illuminate\Console\Command;

class TaskShutdown extends Command
{
    use PrependsOutput, PrependsTimestamp;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homestead:shutdown {--box=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shutdowns Homestead box';

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
        $this->info('Starting shutdown of box: ' . $box->box_name);
        exec('cd ' . $box->vagrant_file_location . ' && vagrant halt > ' .  storage_path() . "/logs/artisan-tasks.log");
        
        $this->info('Complete!');
    }
}
