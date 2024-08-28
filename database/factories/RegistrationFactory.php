<?php

namespace Database\Factories;

use App\Models\Runner;
use App\Models\Registration;

class RegistrationFactory
{
    public function test(): void
    {
        $registration = Registration::factory()->create();
        $runner = Runner::factory()->create();

        $registration->runners()->sync([$runner->id]);

        //
        $runner->registations()->sync([
            $registration->id,
        ]);
    }
}
