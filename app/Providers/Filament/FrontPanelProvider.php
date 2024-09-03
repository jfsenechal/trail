<?php

namespace App\Providers\Filament;

use App\Filament\FrontPanel\Resources\RunnerResource\Widgets\ListRunners;
use App\Filament\Pages\Auth\EditProfile;
use App\Filament\Pages\Auth\Register;
use App\Filament\Pages\Auth\RequestPasswordReset;
use App\Models\Role;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
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
    protected static ?string $title = 'Finance dashboard';

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('front')
            ->default()
            ->login()
            ->brandLogo('https://www.marche.be/administration/files/2014/08/Marche-_logo_quadri.png')
            ->font('Poppins')
            ->profile(EditProfile::class)
            ->passwordReset(RequestPasswordReset::class)
            ->emailVerification()
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
                ListRunners::class,
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
            ])
            ->navigationItems([
                NavigationItem::make('Site Marcheurs')
                    ->url('https://marcheursdelafamenne.marche.be', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-presentation-chart-line')
                    ->label(__('messages.navigation.website'))
                    ->sort(3),
                NavigationItem::make('dashboard admin')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->label(fn(): string => __('messages.navigation.admin.dashboard'))
                    ->url('/admin')
                    ->visible(fn(): bool => auth()->user()->hasRole(Role::ROLE_ADMIN)),
            ]);
    }
}
