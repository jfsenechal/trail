<?php

namespace App\Filament\AdminPanel\Resources\UserResource\Pages;

use App\Filament\AdminPanel\Resources\UserResource;
use Filament\Resources\Pages\Page;

class SortUsers extends Page
{
    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.resources.user-resource.pages.sort-users';
}
