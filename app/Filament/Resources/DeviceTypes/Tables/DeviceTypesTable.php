<?php

namespace App\Filament\Resources\DeviceTypes\Tables;

use App\Traits\FilamentListActions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Table;

class DeviceTypesTable
{
    use FilamentListActions;
    protected static ?string $routename = 'device-types';
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('regulation_code')->searchable(),
            ])
            ->filters([])
            ->recordActions(
                self::actions(self::$routename),
                position: RecordActionsPosition::BeforeColumns
            );
    }
}
