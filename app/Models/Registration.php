<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Number;

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

    public function priceFormated(): string|bool
    {
        return Number::currency($this->price, in: 'EUR', locale: 'fr_BE');
    }

    public function isPaid(): bool
    {
        return (bool)$this->paid;
    }

    public function runnersPaid(): array
    {
        return $this->all()
            ->filter->isPaid()
            //   ->filter->shipped()
            ->map->items
            ->collapse()
            ->groupBy->product_id
            ->map
            ->sum('price')
            ->filter(function ($total) {
                return $total > 1000;
            })
            ->sortDesc()
            ->take(10);
    }
}
