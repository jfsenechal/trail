<?php

namespace App\Filament\FrontPanel\Resources\JoggerResource\Widgets;

use App\Models\Jogger;
use App\Models\Registration;
use App\Models\Trail;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistratioinOverview extends Widget
{
    protected static string $view = 'filament.front-panel.resources.jogger-resource.widgets.registratioin-overview';

    public Collection|array $joggers = [];

    public function mount(): void
    {
        $user = Auth::getUser();
        $trail = Trail::find(1);

        //$posts = Registration::whereBelongsTo($user)->get();
        $registration = Registration::where('user_id', '=', $user->id)
            ->where('trail_id', '=', $trail->id)
            ->get()
            ->first();

        $this->joggers = DB::table('registrations')
            ->where('user_id', '=', $user->id)
            ->where('trail_id', '=', $trail->id)
            ->get();

        $this->joggers = $registration->joggers()->all();
    }

}
