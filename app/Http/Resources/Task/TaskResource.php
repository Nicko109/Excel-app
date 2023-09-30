<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\File\FileResource;
use App\Http\Resources\User\UserResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'file' => new FileResource($this->file),
            'status' => Task::getStatuses()[$this->status],
            'failed_rows_count' => $this->failed_rows_count,
        ];
    }
}
