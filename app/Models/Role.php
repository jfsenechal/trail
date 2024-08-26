<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    const ROLE_ADMIN = 'admin';
    const ROLE_JOGGER = 'jogger';

    protected $fillable = ['name'];

    public function users(): hasMany
    {
        return $this->hasMany(User::class);
    }
}
