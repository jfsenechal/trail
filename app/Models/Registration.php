<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'trail_id',
        'user_id',
        'registration_date',
        'price',
    ];

    public function trail(): BelongsTo
    {
        return $this->belongsTo(Trail::class);//belong id set here
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);//belong id set here
    }

    public function runners(): BelongsToMany
    {
        return $this->belongsToMany(Runner::class)->withTimestamps();
    }
}
