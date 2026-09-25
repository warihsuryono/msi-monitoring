<?php

namespace App\Filament\Resources\Units\Pages;

use App\Filament\Resources\Units\UnitResource;
use App\Traits\FilamentEditFunctions;
use Filament\Resources\Pages\EditRecord;

class EditUnit extends EditRecord
{
    protected $routename = 'units';
    use FilamentEditFunctions;
    protected static string $resource = UnitResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
