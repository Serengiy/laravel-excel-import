<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = false;
    protected $table = 'projects';
    protected $casts =[
        'contracted_at' => 'datetime',
        'created_at_time' => 'datetime',
        'deadline' => 'datetime',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
