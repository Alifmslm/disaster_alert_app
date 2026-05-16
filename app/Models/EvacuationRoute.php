<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvacuationRoute extends Model
{
    protected $fillable = [
        'name',
        'disaster_type',
        'status',
        'area',
        'start_latitude',
        'start_longitude',
        'end_latitude',
        'end_longitude',
        'distance_km',
        'description',
    ];

    protected $casts = [
        'start_latitude' => 'float',
        'start_longitude' => 'float',
        'end_latitude' => 'float',
        'end_longitude' => 'float',
        'distance_km' => 'float',
    ];
}
