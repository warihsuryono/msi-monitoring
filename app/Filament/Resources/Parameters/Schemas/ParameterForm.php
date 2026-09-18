<?php

namespace App\Filament\Resources\Parameters\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ParameterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                TextInput::make('caption'),
                TextInput::make('p_type'),
                Select::make('unit_id')
                    ->relationship('unit', 'name')
                    ->default(0),
                TextInput::make('molecular_mass')
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
