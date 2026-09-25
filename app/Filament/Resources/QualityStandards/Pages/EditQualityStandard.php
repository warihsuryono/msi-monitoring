<?php

namespace App\Filament\Resources\QualityStandards\Pages;

use App\Filament\Resources\QualityStandards\QualityStandardResource;
use App\Traits\FilamentEditFunctions;
use Filament\Resources\Pages\EditRecord;

class EditQualityStandard extends EditRecord
{
    protected $routename = 'quality-standards';
    use FilamentEditFunctions;
    protected static string $resource = QualityStandardResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
