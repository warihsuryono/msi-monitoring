<?php

namespace App\Filament\Resources\QualityStandards\Tables;

use App\Traits\FilamentListActions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Table;

class QualityStandardsTable
{
    use FilamentListActions;
    protected static ?string $routename = 'quality-standards';
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('regulation_code'),
                TextColumn::make('parameter.caption')->html(true),
                TextColumn::make('value')->numeric()->alignRight(),
                TextColumn::make('unit.name'),
            ])
            ->filters([])
            ->recordActions(
                self::actions(self::$routename),
                position: RecordActionsPosition::BeforeColumns
            );
    }
}
