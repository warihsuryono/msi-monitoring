<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use App\Models\menu;
use App\Models\Privilege;
use Exception;
use Filament\FontProviders\LocalFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;


class MsiPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $widgets = [];
        $panel->navigation(function (NavigationBuilder $builder): NavigationBuilder {
            $builder->items([
                NavigationItem::make('Dashboard')
                    ->url(App::make('url')->to(env('PANEL_PATH') . '/'))
                    ->icon('heroicon-o-home')
            ]);
            $navigation_groups = [];
            $navigations = [];
            $privileges = Privilege::find(Auth::user()->privilege_id);
            $menu_ids = explode(",", $privileges->menu_ids);

            if (Auth::user()->privilege_id == 1) $mainmenus = menu::where("parent_id", "0")->orderBy('seqno', 'asc')->get();
            else $mainmenus = menu::where("parent_id", "0")->whereIn('id', $menu_ids)->orderBy('seqno', 'asc')->get();

            foreach ($mainmenus as $mainmenu) {
                if (Auth::user()->privilege_id == 1) $childmenus = menu::where("parent_id", $mainmenu->id)->orderBy('seqno', 'asc')->get();
                else  $childmenus = menu::where("parent_id", $mainmenu->id)->whereIn('id', $menu_ids)->orderBy('seqno', 'asc')->get();

                if (count($childmenus) == 0) { // ga punya child
                    try {
                        $builder->items([
                            NavigationItem::make($mainmenu->name)
                                ->url(App::make('url')->to(env('PANEL_PATH') . '/' . $mainmenu->url))
                                ->icon($mainmenu->icon)
                        ]);
                    } catch (Exception $e) {
                    }
                } else {
                    foreach ($childmenus as $childmenu) {
                        array_push(
                            $navigations,
                            NavigationItem::make($childmenu->name)
                                ->url(App::make('url')->to(env('PANEL_PATH') . "/" . $childmenu->url))
                                ->group($mainmenu->name)
                        );
                    }
                    array_push(
                        $navigation_groups,
                        NavigationGroup::make()
                            ->label($mainmenu->name)
                            ->icon($mainmenu->icon)
                            ->items($navigations)
                            ->collapsed(true)
                    );
                    $builder->groups($navigation_groups);
                    $navigation_groups = [];
                    $navigations = [];
                }
            }
            return $builder;
        });

        return $panel
            ->plugins([
                FilamentApexChartsPlugin::make()
            ])
            ->default()
            ->darkMode(false)
            ->sidebarCollapsibleOnDesktop(true)
            ->id('msi')
            ->path('msi')
            ->favicon(asset('img/monitoring_msi_icon.png'))
            ->font('Poppins', url: asset("css/custom.css"), provider: LocalFontProvider::class)
            ->brandLogo(asset('img/monitoring_msi_logo.png'))
            ->brandLogoHeight('50px')
            ->brandName('MS Monitoring')
            ->homeUrl('/')
            ->databaseNotifications()
            ->login()
            ->passwordReset()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([Dashboard::class])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets($widgets)
            ->globalSearch(false)
            ->renderHook(
                PanelsRenderHook::BODY_END,
                fn() => view('header')
            )
            ->renderHook(
                PanelsRenderHook::FOOTER,
                fn() => view('footer')
            )
            ->renderHook(
                PanelsRenderHook::CONTENT_END,
                fn() => view('endcontent')
            )
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
