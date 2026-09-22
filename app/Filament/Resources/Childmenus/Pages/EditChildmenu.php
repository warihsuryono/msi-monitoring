<?php

namespace App\Filament\Resources\Childmenus\Pages;

use App\Filament\Resources\Childmenus\ChildmenuResource;
use App\Traits\FilamentEditFunctions;
use Filament\Resources\Pages\EditRecord;

class EditChildmenu extends EditRecord
{
    protected static string $resource = ChildmenuResource::class;
    protected $routename = 'menus';
    use FilamentEditFunctions;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
