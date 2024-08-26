<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class Homepage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.home';
    // protected static bool $shouldRegisterNavigation = false;

    public $joggers = [];

    public function getSubheading(): ?string
    {
        return __('Homepage');
    }

    public static function canAccess(): bool
    {
        return true;
    }

    public function mount(): void
    {
        $this->joggers = DB::table('joggers')->get();
    }

    public function getLayout(): string
    {
        return static::$layout ?? 'filament-panels::components.layout.simple';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make(__('Register'))
                ->url(route('filament.front.auth.register')),
        ];
    }


}
