<?php

namespace App\Filament\Resources\Units\Pages;

use App\Filament\Resources\Units\UnitResource;
use App\Traits\FilamentListFunctions;
use Filament\Resources\Pages\ListRecords;

class ListUnits extends ListRecords
{
    protected $routename = 'units';
    use FilamentListFunctions;
    protected static string $resource = UnitResource::class;
}
