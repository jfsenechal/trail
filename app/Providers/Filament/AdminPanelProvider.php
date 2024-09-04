<?php

namespace App\Providers\Filament;

use App\Filament\AdminPanel\Resources\RegistrationResource\Widgets\LatestRunners;
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

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->profile()
            // ->brandLogo('https://www.marche.be/administration/files/2014/08/Marche-_logo_quadri.png')
            //   ->brandName('Hi jf')
            ->brandLogoHeight('10rem')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(
                in: app_path('Filament/AdminPanel/Resources'),
                for: 'App\\Filament\\AdminPanel\\Resources',
            )
            ->discoverPages(in: app_path('Filament/AdminPanel/Pages'), for: 'App\\Filament\\AdminPanel\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/AdminPanel/Widgets'), for: 'App\\Filament\\AdminPanel\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                LatestRunners::class,
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
