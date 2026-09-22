<?php

namespace App\Filament\Resources\Menus\Schemas;

use App\Models\Icon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name'),
                TextInput::make('url'),
                Select::make('icon')->options(Icon::all()->pluck('name', 'name'))->searchable(),
                TextInput::make('route')->nullable(),
            ]);
    }
}
