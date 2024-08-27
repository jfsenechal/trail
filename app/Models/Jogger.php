<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Jogger extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email'];

    public function registrations(): BelongsToMany
    {
        return $this->belongsToMany(Registration::class);
    }

    /*  public function registrationJoggers(): BelongsToMany
      {
          return $this->belongsToMany(RegistrationJogger::class)
              ->withTimestamps();
      }*/

}
