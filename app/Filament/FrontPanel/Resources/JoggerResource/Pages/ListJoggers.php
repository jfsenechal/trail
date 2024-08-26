<?php

namespace App\Filament\FrontPanel\Resources\JoggerResource\Pages;

use App\Filament\FrontPanel\Resources\JoggerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJoggers extends ListRecords
{
    protected static string $resource = JoggerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
