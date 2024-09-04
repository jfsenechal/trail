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
         * Create token
         * @var User $user
         */
        $user = $event->getUser();
        $token = $user->createToken(config('app.name'));

        /**
         * Attach role
         */
        $runnerRole = Role::where('name', Role::ROLE_RUNNER)->get()->first();
        $user->roles()->attach($runnerRole);

        /**
         * Create a runner
         */
        $runner = new Runner(
            ['first_name' => $user->first_name, 'last_name' => $user->last_name, 'email' => $user->email],
        );
        $runner->user()->associate($user)->save();

        /**
         * Create registration
         */
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
        $registration->runners()->attach($runner);

        /**
         * Send mail
         */
        Mail::to($user->email)->send(new RegistrationCompleted($user, $token->plainTextToken));
    }
}
