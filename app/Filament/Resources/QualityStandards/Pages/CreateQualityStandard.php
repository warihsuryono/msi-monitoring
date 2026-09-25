<?php

namespace App\Filament\Resources\QualityStandards\Pages;

use App\Filament\Resources\QualityStandards\QualityStandardResource;
use App\Traits\FilamentCreateFunctions;
use Filament\Resources\Pages\CreateRecord;

class CreateQualityStandard extends CreateRecord
{
    protected $routename = 'quality-standards';
    use FilamentCreateFunctions;
    protected static string $resource = QualityStandardResource::class;
    protected static bool $canCreateAnother = false;
}
