<?php

namespace App\Http\Resources\FailedRow;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FailedRowResources extends JsonResource
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
            'key' => $this->key,
            'row' => $this->row,
            'message' => $this->message,
            'task_id' => $this->task_id,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
