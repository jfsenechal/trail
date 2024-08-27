<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Jogger extends Model
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

    /*  public function registrationJoggers(): BelongsToMany
      {
          return $this->belongsToMany(RegistrationJogger::class)
              ->withTimestamps();
      }*/

}
