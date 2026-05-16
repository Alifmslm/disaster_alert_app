<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'staff_id',
        'agency',
        'position',
        'profile_photo_path',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function reports(): HasMany
    {
        return $this->hasMany(DisasterReport::class);
    }

    public function verifiedReports(): HasMany
    {
        return $this->hasMany(DisasterReport::class, 'verified_by');
    }

    public function mitigationNotes(): HasMany
    {
        return $this->hasMany(MitigationNote::class, 'officer_id');
    }

    public function notificationPreference(): HasOne
    {
        return $this->hasOne(NotificationPreference::class);
    }
}
