<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $table = 'tasks';

    const STATUS_PROCESS = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_ERROR = 3;

    public static function getStatuses()
    {
        return [
            self::STATUS_PROCESS => 'Импорт в процессе обработки',
            self::STATUS_SUCCESS => 'Импорт данных успешно прошёл',
            self::STATUS_ERROR => 'Ошибка валидации во время импорта',
        ];

    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function failedRows()
    {
        return $this->hasMany(FailedRow::class, 'task_id', 'id');

    }
}
