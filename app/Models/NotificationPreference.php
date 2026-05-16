<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationPreference extends Model
{
    protected $fillable = [
        'user_id',
        'alert_filter',
        'sound_enabled',
        'push_enabled',
        'email_enabled',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'sound_enabled' => 'boolean',
        'push_enabled' => 'boolean',
        'email_enabled' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
