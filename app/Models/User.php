<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'no_hp',
        'alamat',
        'signature',
        'profile_picture',
        'is_active',
        'last_active_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_active_at' => 'datetime',
        ];
    }

    public function getUserPermissions()
    {
        return $this->getAllPermissions()->mapWithKeys(fn($permission) => [$permission['name'] => true]);
    }

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }

    // Di dalam model User
    public function getProfilePictureUrlAttribute()
    {
        return $this->profile_picture
            ? asset('storage/profile_pictures/' . $this->profile_picture)
            : asset('icons/user.png');
    }

    public function isOnline(): bool
    {
        return Cache::has('user-online-' . $this->id);
    }

    public function scopeOnline($query)
    {
        $userIds = [];
        foreach (Cache::get('user-online-*') as $key => $value) {
            $userIds[] = str_replace('user-online-', '', $key);
        }

        return $query->whereIn('id', $userIds);
    }
}
