<?php

namespace App\Filament\Resources\Devices\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DeviceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                TextInput::make('topic')->placeholder('msi/sensor/xxx'),
                Select::make('device_type_id')->label("Type")->relationship('type', 'name')->required(),
                TextInput::make('address'),
                TextInput::make('latitude'),
                TextInput::make('longitude'),
            ]);
    }
}
