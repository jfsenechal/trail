<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Runner extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'uuid',
        'date_of_birth',
        'phone',
        'photo',
        'display_name',
        'gdpr_accepted',
    ];

    protected function casts(): array
    {
        return [

        ];
    }

    public function registrations(): BelongsToMany
    {
        return $this->belongsToMany(Registration::class)->withTimestamps();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);//belong id set here
    }
}
