<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tools extends Model
{
    use HasFactory;
    protected $table = 'tools';

    protected $fillable = [
        'tool_name', 'tool_description', 'health_domain', 'age_group', 'notes', 'attachment', 'outcome', 'gender', 'health_condition', 'modality', 'specific_NB', 'settings',
        'reliability', 'validity', 'author', 'title', 'date', 'country', 'journal', 'measure', 'program_content', 'creadit', 'status_ID',
    ];

    /**
     * get visitor of tool
     */
    public function request()
    {
        return $this->hasOne('App\Models\request', 'tool_ID');
    }

    /**
     * get links of tool
     */
    public function linkLists()
    {
        return $this->hasMany('App\Models\linkList', 'tool_ID');
    }

    /**
     * feedbacks for tool
     */
    public function feedbacks()
    {
        return $this->hasMany('App\Models\toolsFeedback', 'tool_ID');
    }
}
