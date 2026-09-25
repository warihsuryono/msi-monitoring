<?php

namespace App\Filament\Resources\Parameters\Tables;

use App\Traits\FilamentListActions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Table;

class ParametersTable
{
    use FilamentListActions;
    protected static ?string $routename = 'parameters';
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('caption')->searchable()->html(),
                TextColumn::make('p_type')->label("Parameter Type")->searchable()->badge(),
                TextColumn::make('unit.name'),
                TextColumn::make('molecular_mass')->label('Molecular Mass (g/mol)'),
            ])
            ->filters([])
            ->recordActions(
                self::actions(self::$routename),
                position: RecordActionsPosition::BeforeColumns
            );
    }
}
