<?php

namespace App\Filament\Resources\DeviceTypes\Pages;

use App\Filament\Resources\DeviceTypes\DeviceTypeResource;
use App\Traits\FilamentEditFunctions;
use Filament\Resources\Pages\EditRecord;

class EditDeviceType extends EditRecord
{
    protected $routename = 'device-types';
    use FilamentEditFunctions;
    protected static string $resource = DeviceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
