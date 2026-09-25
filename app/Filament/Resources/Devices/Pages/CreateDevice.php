<?php

namespace App\Filament\Resources\Devices\Pages;

use App\Filament\Resources\Devices\DeviceResource;
use App\Traits\FilamentCreateFunctions;
use Filament\Resources\Pages\CreateRecord;

class CreateDevice extends CreateRecord
{
    protected $routename = 'devices';
    use FilamentCreateFunctions;
    protected static string $resource = DeviceResource::class;
    protected static bool $canCreateAnother = false;
}
