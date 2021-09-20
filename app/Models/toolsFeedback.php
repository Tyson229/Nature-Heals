<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toolsFeedback extends Model
{
    use HasFactory;

    protected $table = 'tools_feedback';

    protected $fillable = [
        'name', 'email', 'comment', 'tool_ID'
    ];

    public function tool()
    {
        return $this->belongsTo('App\Models\tools', 'tool_ID');
    }
}
