<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistrationJogger extends Model
{
    use HasFactory;

    // If you have extra fields in the pivot table, define fillable attributes here
    protected $fillable = ['registration_id', 'jogger_id'];

    public $timestamps = true; // Ensure timestamps are handled

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);//belong id set here
    }

    public function jogger(): BelongsTo
    {
        return $this->belongsTo(Jogger::class);//belong id set here
    }
}
