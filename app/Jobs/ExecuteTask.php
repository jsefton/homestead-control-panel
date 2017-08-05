<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Artisan;

class ExecuteTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $task = "";

    protected $logPath;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($task, $logPath = false)
    {
        $this->task = $task;
        if($logPath) {
            $this->logPath = $logPath;
        } else {
            $this->logPath = storage_path() . "/logs/artisan-tasks.log";
        }

        file_put_contents($this->logPath, "");
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        exec(' cd ' . base_path() . ' && php artisan ' . $this->task . ' > ' . $this->logPath);
        return true;
    }
}
