<?php

namespace App\Providers\Filament;

use App\Filament\FrontPanel\Resources\RunnerResource\Widgets\ListRunners;
use App\Filament\FrontPanel\Resources\RunnerResource\Widgets\Welcome;
use App\Filament\Pages\Auth\EditProfile;
use App\Filament\Pages\Auth\Register;
use App\Filament\Pages\Auth\RequestPasswordReset;
use App\Filament\Pages\Help;
use App\Models\Role;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Contracts\View\View;
use Filament\Actions;

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
            ->unsavedChangesAlerts()
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
                Help::class,
            ])
            ->discoverWidgets(in: app_path('Filament/FrontPanel/Widgets'), for: 'App\\Filament\\FrontPanel\\Widgets')
            ->widgets([
                ListRunners::class,
                Welcome::class,
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
                NavigationItem::make('dashboard admin')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->label(fn(): string => __('messages.navigation.admin.dashboard'))
                    ->url('/admin')
                    ->visible(fn(): bool => auth()->user()->hasRole(Role::ROLE_ADMIN)),
            ])
            ->discoverClusters('Filament/Clusters', for: 'App\\Filament\\Clusters')
            ->viteTheme('resources/css/filament/front/theme.css');
    }
}

FilamentView::registerRenderHook(
    PanelsRenderHook::AUTH_REGISTER_FORM_BEFORE,
    fn(): View => view('filament.pages.register-banner'),
);
