<?php

namespace App\Filament\Resources\AnalyzerValues\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AnalyzerValueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('device_id')
                    ->relationship('device', 'name')
                    ->default(0),
                Select::make('parameter_id')
                    ->relationship('parameter', 'name')
                    ->default(0),
                TextInput::make('value')
                    ->numeric()
                    ->default(0),
                TextInput::make('is_ispu')
                    ->numeric()
                    ->default(0),
                TextInput::make('deleted_by')
                    ->numeric()
                    ->default(0),
                TextInput::make('created_by')
                    ->numeric()
                    ->default(0),
                TextInput::make('updated_by')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
