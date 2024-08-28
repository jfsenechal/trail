<?php

namespace App\Filament\AdminPanel\Resources\RegistrationResource\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

/**
 * INFO  Make sure to register the widget in `JoggerResource::getWidgets()`, and then again in `getHeaderWidgets()` or `getFooterWidgets()` of any `JoggerResource` page.
 */
class LatestJoggers extends BaseWidget
{
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
            ->columns([
                TextColumn::make('first_name')
                    ->sortable(),
            ]);
    }
}
