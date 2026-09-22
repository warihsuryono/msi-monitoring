<?php

namespace App\Filament\Resources\Menus\Pages;

use App\Models\menu;
use Filament\Actions;
use Filament\Actions\Action;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Filament\Notifications\Notification;
use App\Http\Controllers\PrivilegeController;
use App\Filament\Resources\Menus\MenuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected static function actions(): array
    {
        $routename = explode('/', str_replace(env('PANEL_PATH') . '/', '', Route::current()->uri))[0];
        $menu_ids = menu::where('url', $routename)->get()->pluck('id');
        $actions = [Action::make('childmenus')->label('Show Child Menus')->url(App::make('url')->to(env('PANEL_PATH') . "/childmenus"))];
        if (PrivilegeController::privilege_check($menu_ids, 1))
            array_push($actions, CreateAction::make()->label('Add Menu')->icon('heroicon-o-plus'));
        return $actions;
    }

    protected function getHeaderActions(): array
    {
        $routename = explode('/', str_replace(env('PANEL_PATH') . '/', '', Route::current()->uri))[0];
        if (!PrivilegeController::privilege_check(menu::where('url', $routename)->get()->pluck('id')) && $routename != 'livewire') {
            Notification::make()
                ->title('Sorry, you don`t have the privilege!')
                ->warning()
                ->send();
            redirect(env('PANEL_PATH'));
        }
        return self::actions();
    }
}
