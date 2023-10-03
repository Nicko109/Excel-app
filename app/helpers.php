<?php

use App\Models\FailedRow;

if (!function_exists('processFailures')) {
    function processFailures($failures, $attributesMap, $task)
    {
        $map = [];
        foreach ($failures as $failure) {
            foreach ($failure->errors() as $error) {
                $map[] = [
                    'key' => $attributesMap[$failure->attribute()],
                    'row' => $failure->row(),
                    'message' => $error,
                    'task_id' => $task->id,
                ];

            }
        }
        if (count($map) > 0) FailedRow::insertFailedRows($map, $task);
    }
}
