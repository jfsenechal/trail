<?php

namespace App\Filament\FrontPanel\Resources\RegistrationResource\RelationManagers;

use App\Constant\DisplayNameEnum;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class RunnersRelationManager extends RelationManager
{
    protected static string $relationship = 'runners';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->id('main-section')
                    ->description('Coordonnées')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(120),
                        Forms\Components\TextInput::make('first_name')
                            ->label(__('messages.first_name'))
                            ->required()
                            ->maxLength(120),
                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->email()
                            ->label('Email address')
                            ->maxLength(120)
                            ->suffixIcon('heroicon-m-at-symbol'),
                        Forms\Components\Select::make('display_name')
                            ->required()
                            ->label(__('messages.display_name.select.label'))
                            ->columnSpan(2)
                            ->helperText(
                                __('messages.display_name.select.help'),
                            )
                            ->options(
                                DisplayNameEnum::class,
                            ),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('first_name')
            ->columns([
                Tables\Columns\TextColumn::make('first_name'),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('display_name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                ]),
            ]);
    }
}
