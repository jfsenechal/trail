<?php

namespace Database\Factories;

use App\Models\Jogger;
use App\Models\Registration;

class RegistrationFactory
{
    public function test(): void
    {
        $registration = Registration::factory()->create();
        $jogger = Jogger::factory()->create();

        //$registration->jogger()->associate($jogger);
        // Create relation between Driver and Car.
        //  use the sync() function to prevent duplicated relations.
        $registration->joggers()->sync([$jogger->id]);

        //
        $jogger->registations()->sync([
            $registration->id,
        ]);
    }
}
