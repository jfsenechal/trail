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
use Illuminate\Database\Eloquent\Builder;

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
            ->modifyQueryUsing(fn(Builder $query) => $query->where('user_id', auth()->id()))
            ->columns([
                Tables\Columns\TextColumn::make('trail.name')->label('Trail'),
                Tables\Columns\TextColumn::make('user.first_name')->searchable()->label('First name'),
                Tables\Columns\TextColumn::make('user.last_name')->searchable()->label('Last name'),
                Tables\Columns\TextColumn::make('user.email')->searchable()->label('Email'),
            ])
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
