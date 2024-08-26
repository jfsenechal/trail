<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Help extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.help';
    private array $post = ['name' => 'ello'];

    protected function getHeaderActions(): array
    {
        return [
           /* Action::make('edit')
                ->url(route('posts.edit', ['post' => $this->post])),*/
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __('Custom Page Title');
    }

    public function getHeading(): string
    {
        return __('Custom Page Heading');
    }

    public static function getNavigationLabel(): string
    {
        return __('Custom Navigation Label');
    }
}
