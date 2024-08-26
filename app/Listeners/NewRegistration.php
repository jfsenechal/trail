<?php

namespace App\Listeners;

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
        if (DB::table('migrations')
            ->where('user_id', '=', $user->id)
            ->where('trail_id', '=', $trail->id)
            ->doesntExist()) {
            Registration::create(['user_id' => $user->id, 'trail_id' => $trail->id]);
        }
    }
}
