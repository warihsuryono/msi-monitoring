<?php

namespace App\Filament\Resources\QualityStandards\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QualityStandardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('regulation_code'),
                Select::make('parameter_id')->relationship('parameter', 'name')->preload()->searchable()->required(),
                TextInput::make('value')->required()->numeric()->suffix('μg/m³')
            ]);
    }
}
