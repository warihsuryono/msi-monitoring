<?php

namespace App\Filament\Resources\DeviceTypes\Pages;

use App\Filament\Resources\DeviceTypes\DeviceTypeResource;
use App\Traits\FilamentCreateFunctions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeviceType extends CreateRecord
{
    protected $routename = 'device-types';
    use FilamentCreateFunctions;
    protected static string $resource = DeviceTypeResource::class;
    protected static bool $canCreateAnother = false;
}
