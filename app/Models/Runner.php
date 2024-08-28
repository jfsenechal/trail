<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function registrations(): BelongsToMany
    {
        return $this->belongsToMany(Registration::class)->withTimestamps();
    }

    /*  public function registrationRunners(): BelongsToMany
      {
          return $this->belongsToMany(RegistrationRunner::class)
              ->withTimestamps();
      }*/

}
