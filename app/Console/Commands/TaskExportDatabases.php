<?php

namespace App\Console\Commands;

use App\Homestead;
use Illuminate\Console\Command;

class TaskExportDatabases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homestead:db-export-all {--box=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all databases from a box';

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
        if(!$this->option('box')) {
            $this->error('You must specify a homestead box');
            exit;
        }

        $box = Homestead::find($this->option('box'));
        if(!$box) {
            $this->error('Box not found');
            exit;
        }

        $command = 'mysqldump -P 3306 -h ' . $box->ip_address . ' -u homestead -psecret --all-databases > ' . storage_path() . '/app/backup-box-' . $box->id . '-' . date("Y-m-d_H_i_s") . '-all_databases_backup.sql';
        $output = shell_exec($command);
        $this->info('Exported all databases from box: ' . $box->box_name);
    }
}
