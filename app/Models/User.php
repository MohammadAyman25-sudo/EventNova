<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'theme',
        'notify_new_events',
        'notify_weekly_digest',
        'notify_trending',
        'notification_frequency',
        'notification_channels',
        'available_balance',
        'pending_balance',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this));
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'stripe_id',
        'pm_type',
        'pm_last_four',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'trail_ends_at' => 'datetime',
            'notification_channels' => 'array',
        ];

    public function getFullNameAttribute() 
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
             ->singleFile(); // Ensures only one avatar per user
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
             ->width(100)
             ->height(100)
             ->sharpen(10)
             ->nonQueued();

        $this->addMediaConversion('profile')
             ->width(300)
             ->height(300)
             ->nonQueued();
    }

    public function interests()
    {
        return $this->belongsToMany(Category::class);
    }
}
