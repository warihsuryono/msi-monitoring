<?php

namespace App\Filament\Resources\Devices\Tables;

use App\Traits\FilamentListActions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Table;

class DevicesTable
{
    use FilamentListActions;
    protected static ?string $routename = 'devices';
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('topic')->searchable(),
                TextColumn::make('type.name')->label('Type'),
                TextColumn::make('address')->searchable(),
                TextColumn::make('latitude')->searchable(),
                TextColumn::make('longitude')->searchable(),
            ])
            ->filters([])
            ->recordActions(
                self::actions(self::$routename),
                position: RecordActionsPosition::BeforeColumns
            );
    }
}
