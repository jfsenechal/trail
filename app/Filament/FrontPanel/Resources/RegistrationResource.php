<?php

namespace App\Filament\FrontPanel\Resources;

use App\Filament\FrontPanel\Resources\RegistrationResource\Pages\EditRegistration;
use App\Filament\FrontPanel\Resources\RegistrationResource\Pages\ListRegistrations;
use App\Filament\FrontPanel\Resources\RegistrationResource\RelationManagers\RunnersRelationManager;
use App\Models\Registration;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RegistrationResource extends Resource
{
    protected static ?string $model = Registration::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.first_name')->searchable(),
                Tables\Columns\TextColumn::make('user.last_name')->searchable(),
                Tables\Columns\TextColumn::make('user.email')->searchable(),
            ])
            //    ->query()
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RunnersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRegistrations::route('/'),
            'edit' => EditRegistration::route('/{record}/edit'),
        ];
    }
}
