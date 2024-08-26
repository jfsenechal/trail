<?php

namespace App\Filament\FrontPanel\Resources\JoggerResource\Pages;

use App\Filament\FrontPanel\Resources\JoggerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJogger extends EditRecord
{
    protected static string $resource = JoggerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
