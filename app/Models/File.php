<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $guarded = false;
    protected $table = 'files';

    public static function putAndCreate($file)
    {
        $path = Storage::disk('public')->put('files/', $file);
        return File::create([
            'path' => $path,
            'mime_type' =>$file->getClientOriginalExtension(),
            'title'=> $file->getClientOriginalName()
        ]);
    }
}
