<?php

namespace App\Filament\AdminPanel\Resources\RegistrationResource\Widgets;

use App\Models\Jogger;
use App\Models\User;
use Filament\Tables\Columns\TextColumn;
use App\Models\Registration;
use App\Models\Trail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

/**
 * INFO  Make sure to register the widget in `JoggerResource::getWidgets()`, and then again in `getHeaderWidgets()` or `getFooterWidgets()` of any `JoggerResource` page.
 */
class LatestJoggers extends BaseWidget
{
    protected static ?string $model = Registration::class;

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

    /**
     * $flights = Flight::where('active', 1)
     * ->orderBy('name')
     * ->take(10)
     * ->get();
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::where('name', 'jf')
                    ->orderBy('name')
                    ->take(10),
            )
            ->columns([
                TextColumn::make('first_name')
                    ->sortable(),
            ]);
    }
}
