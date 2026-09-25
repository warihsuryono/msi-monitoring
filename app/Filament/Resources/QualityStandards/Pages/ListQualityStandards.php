<?php

namespace App\Filament\Resources\QualityStandards\Pages;

use App\Filament\Resources\QualityStandards\QualityStandardResource;
use App\Traits\FilamentListFunctions;
use Filament\Resources\Pages\ListRecords;

class ListQualityStandards extends ListRecords
{
    protected static string $resource = QualityStandardResource::class;
    protected $routename = 'quality-standards';
    use FilamentListFunctions;
}
