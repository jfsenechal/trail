<?php

namespace App\Filament\AdminPanel\Resources\UserResource\Pages;

use App\Filament\AdminPanel\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $record = new ($this->getModel())($data);

        dd($record);

        return $record;
    }

}
