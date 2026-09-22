<?php

namespace App\Filament\Resources\Childmenus\Schemas;

use App\Models\menu;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ChildmenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('parent_id')->label('Parent')->options(menu::where(['parent_id' => '0'])->get()->pluck('name', 'id')),
                TextInput::make('name'),
                TextInput::make('url'),
                TextInput::make('route')->nullable(),
            ]);
    }
}
