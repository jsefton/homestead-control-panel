<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TaskProvision extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homestead:name';

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
        //
    }
}
