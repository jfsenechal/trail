<?php

namespace App\Filament\FrontPanel\Resources;

use App\Constant\DisplayNameEnum;
use App\Filament\Exports\RunnerExporter;
use App\Filament\FrontPanel\Resources\RunnerResource\Pages\CreateRunner;
use App\Filament\FrontPanel\Resources\RunnerResource\Pages\EditRunner;
use App\Filament\FrontPanel\Resources\RunnerResource\Pages\ListRunner;
use App\Models\Runner;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RunnerResource extends Resource
{
    protected static ?string $model = Runner::class;
    protected static ?string $navigationLabel = 'Mes runners';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        //https://filamentphp.com/docs/3.x/forms/layout/split multi columns
        return $form
            ->columns(3)
            ->schema([
                Section::make()
                    ->id('main-section')
                    ->columnSpan(2)
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
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->suffixIcon('heroicon-m-phone'),
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->required()
                            ->maxDate(now()),
                        Forms\Components\FileUpload::make('photo')
                            ->image()
                            ->imageEditor()
                            ->circleCropper()
                            ->columnSpan(2),
                    ]),
                Section::make()
                    ->id('side-section')
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\Select::make('display_name')
                            ->required()
                            ->label(__('messages.display_name.select.label'))
                            ->helperText(
                                __('messages.display_name.select.help'),
                            )
                            ->options(
                                DisplayNameEnum::class,
                            ),
                        Forms\Components\Checkbox::make('gdpr_accepted')
                            ->required()
                            ->helperText(
                                'J\'ai pris connaissance du règlement.',
                            ),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Vos participants')
            ->modifyQueryUsing(fn(Builder $query) => $query->where('user_id', auth()->id()))
            ->columns([
                Tables\Columns\TextColumn::make('last_name')->searchable(),
                Tables\Columns\TextColumn::make('first_name')->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('date_of_birth')->sortable(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('registrations_count')
                    ->counts('registrations')
                    ->sortable()
                    ->label('NB registration'),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Tables\Actions\ExportAction::make()
                    ->exporter(RunnerExporter::class)
                    ->formats([
                        ExportFormat::Xlsx,
                    ]),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRunner::route('/'),
            'create' => CreateRunner::route('/create'),
            'edit' => EditRunner::route('/{record}/edit'),
        ];
    }
}
