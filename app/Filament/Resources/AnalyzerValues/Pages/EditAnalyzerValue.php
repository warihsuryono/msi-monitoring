<?php

namespace App\Filament\Resources\AnalyzerValues\Pages;

use App\Filament\Resources\AnalyzerValues\AnalyzerValueResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditAnalyzerValue extends EditRecord
{
    protected static string $resource = AnalyzerValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
