<?php

namespace App\Filament\FrontPanel\Resources\RunnerResource\Widgets;

use Filament\Widgets\Widget;

class Welcome extends Widget
{
    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    protected static string $view = 'filament.widgets.welcome';
}
