<?php

namespace App\Listeners;

use App\Mail\RegistrationCompleted;
use App\Models\Role;
use App\Models\Runner;
use App\Models\Registration;
use App\Models\Trail;
use App\Models\User;
use Filament\Events\Auth\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NewRegistration
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        /**
         * @var User $user
         */
        $user = $event->getUser();
        $token = $user->createToken(config('app.name'));

        $runner = Role::factory()->create([
            'name' => Role::ROLE_RUNNER,
        ]);
        $user->roles()->attach($runner);
        $trail = Trail::all()->first;
        $registrations = DB::table('registrations')
            ->where('user_id', '=', $user->id)
            ->where('trail_id', '=', $trail->id)
            ->get();

        if ($registrations->isEmpty()) {
            $registration = Registration::create(['user_id' => $user->id, 'trail_id' => $trail->first()->id]);
        } else {
            $registration = $registrations->first();
        }
        $runner = Runner::create(
            ['first_name' => $user->first_name, 'last_name' => $user->last_name, 'email' => $user->email],
        );
        $registration->runners()->attach($runner);

        Mail::to($user->email)->send(new RegistrationCompleted($user, $token));
    }
}
