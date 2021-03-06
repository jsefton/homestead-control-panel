<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\TaskProvision::class,
        Commands\TaskRestart::class,
        Commands\TaskPHPRestart::class,
        Commands\TaskShutdown::class,
        Commands\TaskPowerOn::class,
        Commands\TaskFetchSites::class,
        Commands\TaskAddSite::class,
        Commands\TaskTailLogs::class,
        Commands\TaskExportDatabase::class,
        Commands\TaskExportDatabases::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
