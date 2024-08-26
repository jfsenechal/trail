<?php

namespace App\Filament\Exports;

use App\Models\Jogger;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class JoggerExporter extends Exporter
{
    protected static ?string $model = Jogger::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('email'),
            ExportColumn::make('last_name'),
            ExportColumn::make('first_name'),
            ExportColumn::make('date_of_birth'),
            ExportColumn::make('phone'),
            ExportColumn::make('photo'),
            ExportColumn::make('display_name'),
            ExportColumn::make('gdpr_accepted'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your jogger export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
