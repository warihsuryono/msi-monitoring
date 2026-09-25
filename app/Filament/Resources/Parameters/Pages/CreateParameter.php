<?php

namespace App\Filament\Resources\Parameters\Pages;

use App\Filament\Resources\Parameters\ParameterResource;
use App\Traits\FilamentCreateFunctions;
use Filament\Resources\Pages\CreateRecord;

class CreateParameter extends CreateRecord
{
    protected $routename = 'parameters';
    use FilamentCreateFunctions;
    protected static string $resource = ParameterResource::class;
    protected static bool $canCreateAnother = false;
    protected function getRedirectUrl(): string
    {
        return route('filament.' . env('PANEL_PATH') . '.resources.parameters.index', $this->record->id);
    }
}
