<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SafetyGuide extends Model
{
    protected $fillable = [
        'title',
        'disaster_type',
        'category',
        'content',
        'video_url',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
