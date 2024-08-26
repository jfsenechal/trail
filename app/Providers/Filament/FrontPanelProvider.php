<?php

namespace App\Providers\Filament;

use App\Filament\FrontPanel\Resources\JoggerResource\Widgets\RegistratioinOverview;
use App\Filament\Pages\Auth\Register;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class FrontPanelProvider extends PanelProvider
{
    protected static string $routePath = 'finance';
    protected static ?string $title = 'Finance dashboard';

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('front')
            ->login()
            ->profile()
            ->registration(Register::class)//https://filamentphp.com/docs/3.x/panels/users#authentication-features
            ->path('front')->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(
                in: app_path('Filament/FrontPanel/Resources'),
                for: 'App\\Filament\\FrontPanel\\Resources',
            )
            ->discoverPages(in: app_path('Filament/FrontPanel/Pages'), for: 'App\\Filament\\FrontPanel\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/FrontPanel/Widgets'), for: 'App\\Filament\\FrontPanel\\Widgets')
            ->widgets([
                RegistratioinOverview::class,
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
