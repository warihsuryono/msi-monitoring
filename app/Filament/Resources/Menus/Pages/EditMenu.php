<?php

namespace App\Filament\Resources\Menus\Pages;

use App\Filament\Resources\Menus\MenuResource;
use App\Traits\FilamentEditFunctions;
use Filament\Resources\Pages\EditRecord;

class EditMenu extends EditRecord
{
    protected $routename = 'menus';
    use FilamentEditFunctions;
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
