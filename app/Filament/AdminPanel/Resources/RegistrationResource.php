<?php

namespace App\Filament\AdminPanel\Resources;

use App\Filament\AdminPanel\Resources\RegistrationResource\Pages\CreateRegistration;
use App\Filament\AdminPanel\Resources\RegistrationResource\Pages\EditRegistration;
use App\Filament\AdminPanel\Resources\RegistrationResource\Pages\ListRegistrations;
use App\Models\Registration;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
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
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->required()
                    ->default(auth()->id()),
                Wizard::make([
                    Wizard\Step::make('Pour quel trail')
                        ->icon('heroicon-m-shopping-bag')
                        ->completedIcon('heroicon-m-hand-thumb-up')
                        ->schema([
                            Forms\Components\Select::make('trail_id')
                                ->relationship(name: 'trail', titleAttribute: 'name')
                                ->required(),
                        ]),
                    Wizard\Step::make('Liste des marcheurs')
                        ->schema([
                            Forms\Components\Repeater::make('runner_id')
                                ->columns(2)
                                ->relationship('runners')
                                //->addable(false)
                                ->reorderable(false)
                                ->addActionLabel(__('messages.register.form.btn.add.runner.label'))
                                ->schema([
                                    Forms\Components\TextInput::make('first_name')
                                        ->required()
                                        ->maxLength(150),
                                    Forms\Components\TextInput::make('last_name')
                                        ->required()
                                        ->maxLength(150),
                                    Forms\Components\TextInput::make('email')
                                        ->label('Email address')
                                        ->email()
                                        ->maxLength(150),
                                    Forms\Components\TextInput::make('phone')
                                        ->label('Phone number')
                                        ->tel(),
                                ]),
                        ]),
                    Wizard\Step::make('Payement')
                        ->schema([

                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.first_name')->searchable(),
                Tables\Columns\TextColumn::make('user.last_name')->searchable(),
                Tables\Columns\TextColumn::make('user.email')->searchable(),
                Tables\Columns\TextColumn::make('runners')->counts('runners'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => ListRegistrations::route('/'),
            'create' => CreateRegistration::route('/create'),
            'edit' => EditRegistration::route('/{record}/edit'),
        ];
    }
}
