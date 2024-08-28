<?php

namespace App\Filament\FrontPanel\Resources\RunnerResource\Pages;

use App\Filament\FrontPanel\Resources\RunnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRunner extends EditRecord
{
    protected static string $resource = RunnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
