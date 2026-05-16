<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportAttachment extends Model
{
    protected $fillable = [
        'disaster_report_id',
        'file_path',
        'caption',
        'mime_type',
        'size',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(DisasterReport::class, 'disaster_report_id');
    }
}
