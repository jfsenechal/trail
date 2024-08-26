<?php

namespace App\Filament\AdminPanel\Resources\TrailResource\Pages;

use App\Filament\AdminPanel\Resources\TrailResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTrail extends CreateRecord
{
    protected static string $resource = TrailResource::class;

    public static function canCreateAnother(): bool
    {
        return false;
    }
}
