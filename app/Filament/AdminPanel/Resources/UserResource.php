<?php

namespace App\Filament\AdminPanel\Resources;

use App\Filament\AdminPanel\Resources\UserResource\Pages\CreateUser;
use App\Filament\AdminPanel\Resources\UserResource\Pages\EditUser;
use App\Filament\AdminPanel\Resources\UserResource\Pages\ListUsers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UserResource extends Resource
{
    // protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(120),
                Forms\Components\TextInput::make('second_name')
                    ->required()
                    ->maxLength(120),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->label('Email address')
                    ->maxLength(120),
                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload(),
                Forms\Components\TextInput::make('password')
                    ->required()
                    ->revealable()
                    ->password(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')->searchable(),
                Tables\Columns\TextColumn::make('second_name')->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('roles.name'),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->relationship('roles', 'name'),

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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
