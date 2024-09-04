<?php

namespace App\Filament\FrontPanel\Resources\RunnerResource\Widgets;

use App\Models\Runner;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;

class ListRunners extends BaseWidget
{
    protected int|string|array $columnSpan = 2;
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->description('Vos participants')
            ->query(Runner::where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('first_name')
                    ->sortable(),
                TextColumn::make('last_name')
                    ->sortable(),
                TextColumn::make('email')
                    ->sortable(),
                TextColumn::make('display_name')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }
}
