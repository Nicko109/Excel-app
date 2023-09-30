<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedRow extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $table = 'failed_rows';

    public static function insertFailedRows($items)
    {
        foreach ($items as $item) {
            FailedRow::create($item);
        }
    }
}
