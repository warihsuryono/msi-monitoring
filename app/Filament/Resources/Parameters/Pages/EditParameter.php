<?php

namespace App\Filament\Resources\Parameters\Pages;

use App\Filament\Resources\Parameters\ParameterResource;
use App\Traits\FilamentEditFunctions;
use Filament\Resources\Pages\EditRecord;

class EditParameter extends EditRecord
{
    protected $routename = 'parameters';
    use FilamentEditFunctions;
    protected static string $resource = ParameterResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
