<?php

namespace App\Filament\FrontPanel\Resources\JoggerResource\Widgets;

use App\Models\Registration;
use App\Models\Trail;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class RegistratioinOverview extends Widget
{
    protected static string $view = 'filament.front-panel.resources.jogger-resource.widgets.registratioin-overview';

    public Collection|array $joggers = [];

    public function mount(): void
    {
        $user = Auth::getUser();
        $trail = Trail::all()->first;

        $registration = Registration::where('user_id', '=', $user->id)
            ->where('trail_id', '=', $trail->id)
            ->get()
            ->first();

        if ($registration) {
            $this->joggers = $registration->joggers()->all();
        }
    }

}
