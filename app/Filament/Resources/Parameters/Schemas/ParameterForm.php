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
                TextInput::make('name')->maxLength(255)->placeholder("NO2")->required(),
                TextInput::make('caption')->maxLength(255)->required()->placeholder("NO2")->required(),
                Select::make('p_type')
                    ->label("Parameter Type")
                    ->options([
                        "gas" => "Gas",
                        "particulate" => "Particulate",
                        "liquid" => "Liquid",
                        "weather" => "Weather",
                        "emission" => "Emission",
                        "flow" => "Flow",
                        "noise" => "Noise"
                    ])
                    ->required(),
                Select::make('unit_id')->label("Unit")->relationship('unit', 'name')->required(),
                TextInput::make('molecular_mass')->numeric()->default(1)->required(),
            ]);
    }
}
