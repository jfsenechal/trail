<?php

namespace App\Listeners;

use App\Models\Jogger;
use App\Models\Registration;
use App\Models\Trail;
use Filament\Events\Auth\Registered;
use Illuminate\Support\Facades\DB;

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
        $user = $event->getUser();
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
        $jogger = Jogger::create(
            ['first_name' => $user->first_name, 'last_name' => $user->last_name, 'email' => $user->email],
        );
        $registration->joggers()->attach($jogger);
    }
}
