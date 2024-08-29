<?php

namespace App\Filament\FrontPanel\Resources;

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

class RunnerResource extends Resource
{
    protected static ?string $model = Runner::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
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
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->suffixIcon('heroicon-m-phone'),
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->required()
                            ->maxDate(now()),
                        Forms\Components\Checkbox::make('display_name')
                            ->required()
                            ->helperText(
                                'Vous pouvez choisir que votre nom apparaisse ou pas dans les résultats de l\'épreuve. Merci de nous préciser votre choix.',
                            ),
                        Forms\Components\Checkbox::make('gdpr_accepted')
                            ->required()
                            ->helperText(
                                'J\'ai pris connaissance du règlement.',
                            ),
                    ]),
                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->imageEditor()
                    ->circleCropper(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Vos participants')
            /*    ->query(function (Builder $query, string $search = 'jf'): Builder {
                    return $query
                        ->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                })*/
            /* ->query(function (Builder $query): Builder {
                 return $query->where('first_name', 'jf')->orderBy('created_at', 'desc');
             })  */
            //    ->query(fn(Builder $query) => $query->with('author')->where('status', 'published'))
            /*   ->query(function (Builder $query) {
                   $query->setModel(new Runner());

                   return $query->get();
               })*/
            ->columns([
                Tables\Columns\TextColumn::make('last_name')->searchable(),
                Tables\Columns\TextColumn::make('fist_name')->searchable(),
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
