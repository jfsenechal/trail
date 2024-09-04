<?php

namespace App\Filament\FrontPanel\Resources;

use App\Filament\FrontPanel\Resources\RegistrationResource\Pages\EditRegistration;
use App\Filament\FrontPanel\Resources\RegistrationResource\Pages\ListRegistrations;
use App\Filament\FrontPanel\Resources\RegistrationResource\RelationManagers\RunnersRelationManager;
use App\Models\Registration;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Infolist;
use NumberFormatter;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;

class RegistrationResource extends Resource
{
    protected static ?string $model = Registration::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name'),
                TextEntry::make('price')
                    ->formatStateUsing(function ($state) {
                        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);

                        return $formatter->formatCurrency($state / 100, 'eur');
                    }),
                Actions::make([
                    Action::make('Buy product')
                        ->url('/'),
                ]),
            ]);
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
                Tables\Columns\TextColumn::make('registrationRunner.price')
                    ->label('Price')
                    ->formatStateUsing(function ($state) {
                        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);

                        return $formatter->formatCurrency($state / 100, 'eur');
                    }),
                Tables\Columns\TextColumn::make('registrationRunner.paid')
                    ->label('Paid')
                    ->badge(),
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
