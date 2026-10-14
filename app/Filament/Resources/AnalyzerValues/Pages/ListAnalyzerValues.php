<?php

namespace App\Filament\Resources\AnalyzerValues\Pages;

use App\Filament\Resources\AnalyzerValues\AnalyzerValueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAnalyzerValues extends ListRecords
{
    protected static string $resource = AnalyzerValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
