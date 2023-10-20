<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const STATUS_PROCESS = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_ERROR = 3;
    protected $guarded = false;
    protected $table = 'tasks';

    public static function getStatuses()
    {
        return[
            self::STATUS_PROCESS => 'В процессе',
            self::STATUS_SUCCESS => 'Удачно загружен',
            self::STATUS_ERROR => 'Загружен с ошибками',

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
