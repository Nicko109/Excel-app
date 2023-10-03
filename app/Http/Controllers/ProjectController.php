<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ImportStoreRequest;
use App\Http\Resources\Project\PojectResource;
use App\Jobs\ImportProjectExcelFileJob;
use App\Models\File;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(10);
        $projects = PojectResource::collection($projects);
        return inertia('Project/Index', compact('projects'));
    }

    public function import()
    {
        return inertia('Project/Import');
    }

    public function importStore(ImportStoreRequest $request)
    {
        $data = $request->validated();

        $file = File::putAndCreate($data['file']);

        $task = Task::create([
            'file_id' => $file->id,
            'user_id' => auth()->id(),
        ]);

        ImportProjectExcelFileJob::dispatch($file->path, $task);

    }

}


