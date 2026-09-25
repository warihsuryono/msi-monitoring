<?php

namespace App\Filament\Resources\Parameters\Pages;

use App\Filament\Resources\Parameters\ParameterResource;
use App\Traits\FilamentListFunctions;
use Filament\Resources\Pages\ListRecords;

class ListParameters extends ListRecords
{
    protected $routename = 'parameters';
    use FilamentListFunctions;
    protected static string $resource = ParameterResource::class;
}
