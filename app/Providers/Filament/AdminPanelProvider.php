<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\LatestQuotations;
use App\Filament\Widgets\QuotationStatusChart;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\VisitorDevicesChart;
use App\Filament\Widgets\VisitorTrafficChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Bali Easy Sourcing')
            ->brandLogo(fn () => view('filament.admin-brand'))
            ->brandLogoHeight('2.4rem')
            ->darkMode(false)
            ->colors([
                'primary' => Color::Amber,
                'gray' => Color::Stone,
            ])
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn () => view('filament.auth-login-helper')
            )
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                fn () => view('filament.topbar-public-link')
            )
            ->sidebarCollapsibleOnDesktop()
            ->navigationItems([
                NavigationItem::make('Buka Website')
                    ->url(fn () => url('/'), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->sort(999),
            ])
            ->navigationGroups([
                'Ringkasan & Analisis',
                'Sourcing & RFQ',
                'Catalog',
                'Directory (Stay & Eat)',
                'Content Management',
                'Marketing',
                'System & Settings',
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->widgets([
                StatsOverview::class,
                VisitorTrafficChart::class,
                VisitorDevicesChart::class,
                QuotationStatusChart::class,
                AccountWidget::class,
                LatestQuotations::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
