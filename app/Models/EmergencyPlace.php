<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyPlace extends Model
{
    protected $fillable = [
        'name',
        'type',
        'address',
        'area',
        'latitude',
        'longitude',
        'capacity',
        'contact',
        'status',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'latitude' => 'float',
        'longitude' => 'float',
        'capacity' => 'integer',
    ];
}
