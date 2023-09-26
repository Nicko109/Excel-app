<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $table = 'files';

    public static function putAndCreate($dataFile)
    {
        $file = Storage::disk('public')->put('files/', $dataFile);
        File::create([
            'path' => $file,
            'mime_type' => $dataFile->getClientOriginalExtension(),
            'title' => $dataFile->getClientOriginalName(),
        ]);

        return $file;
    }
}
