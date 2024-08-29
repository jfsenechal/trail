<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    use HasApiTokens, HasFactory, Notifiable;

    private ?string $avatar_url = null;
    //to send by email
    public ?string $plainPassword = null;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'plainPassword',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function ($model) {
            // Unset the field so it doesn't save to the database
            $model->plainPassword = $model->attributes['plainPassword'];
            unset($model->attributes['plainPassword']);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'gender',
    ];

    public function registrations(): hasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->BelongsToMany(Role::class);
    }

    public function runners(): hasMany
    {
        return $this->hasMany(Runner::class);
    }

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
            'roles' => 'array',
        ];
    }

    public function hasRole(string $roleToFind): bool
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->name === $roleToFind) {
                return true;
            }
        }

        return false;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            //&& $this->hasVerifiedEmail()
            return $this->hasRole(Role::ROLE_ADMIN);
        }

        if ($panel->getId() === 'front') {
            return $this->hasRole(Role::ROLE_RUNNER);
        }

        return false;
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;//Filament will fall back to ui-avatars.com.
    }
}
