<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todolist extends Model
{
    use HasFactory;

    protected $table = 'todolists';

    protected $fillable = [
        'task_name', 'priority', 'completed', 'user_id'
    ];

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}