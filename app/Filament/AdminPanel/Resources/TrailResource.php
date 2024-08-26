<?php

namespace App\Filament\AdminPanel\Resources;

use App\Filament\AdminPanel\Resources\TrailResource\Pages\CreateTrail;
use App\Filament\AdminPanel\Resources\TrailResource\Pages\EditTrail;
use App\Filament\AdminPanel\Resources\TrailResource\Pages\ListTrails;
use App\Models\Trail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TrailResource extends Resource
{
    protected static ?string $model = Trail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(150),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(150),
                Forms\Components\DatePicker::make('date_occurred')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTrails::route('/'),
            'create' => CreateTrail::route('/create'),
            'edit' => EditTrail::route('/{record}/edit'),
        ];
    }
}
