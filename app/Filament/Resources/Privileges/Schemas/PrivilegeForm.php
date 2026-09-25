<?php

namespace App\Filament\Resources\Privileges\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PrivilegeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
            ]);
    }
}
