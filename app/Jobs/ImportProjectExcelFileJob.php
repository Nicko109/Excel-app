<?php

namespace App\Jobs;

use App\Http\Controllers\ProjectController;
use App\Imports\ProjectDynamicImport;
use App\Imports\ProjectImport;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Excel;

class ImportProjectExcelFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $path;
    private $task;


    /**
     * Create a new job instance.
     * @param $path
     * @param $task
     */
    public function __construct($path, $task)
    {
        $this->path = $path;
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->task->update(['status' => Task::STATUS_SUCCESS]);

        $methodName = 'import' . $this->task->type;

        $this->$methodName();

    }

    public function import1()
    {
        \Maatwebsite\Excel\Facades\Excel::import(new ProjectImport($this->task), $this->path, 'public');
    }

    public function import2()
    {
        \Maatwebsite\Excel\Facades\Excel::import(new ProjectDynamicImport($this->task), $this->path, 'public');
    }
}
