<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DisasterReport extends Model
{
    protected $fillable = [
        'user_id',
        'disaster_event_id',
        'type',
        'status',
        'location_name',
        'latitude',
        'longitude',
        'occurred_at',
        'description',
        'reporter_name',
        'reporter_phone',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'occurred_at' => 'datetime',
        'verified_at' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function disasterEvent(): BelongsTo
    {
        return $this->belongsTo(DisasterEvent::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ReportAttachment::class);
    }
}
