<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'date_occurred'];

    public function registrations(): hasMany
    {
        return $this->hasMany(Registration::class);
    }
}
