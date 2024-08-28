<?php

namespace App\Filament\FrontPanel\Resources\RunnerResource\Widgets;

use App\Models\Registration;
use App\Models\Trail;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class RegistrationOverview extends Widget
{
    protected static string $view = 'filament.front-panel.resources.runner-resource.widgets.registration-overview';

    public Collection|array $runners = [];

    public function mount(): void
    {
        $user = Auth::getUser();
        $trail = Trail::all()->first;

        $registration = Registration::where('user_id', '=', $user->id)
            ->where('trail_id', '=', $trail->id)
            ->get()
            ->first();

        if ($registration) {
            $this->runners = $registration->runners()->all();
        }
    }

}
