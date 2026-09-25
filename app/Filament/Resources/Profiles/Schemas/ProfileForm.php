<?php

namespace App\Filament\Resources\Profiles\Schemas;

use App\Models\Privilege;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Password;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Details')->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('email')->required()->disabled(true),
                    Select::make('privilege_id')->options(Privilege::all()->pluck('name', 'id'))
                        ->relationship('privilege', 'name')
                        ->disabled(true),
                    TextInput::make('msisdn')->label('Mobile Phone')->prefix('+62')->tel()->required(),
                ]),
                Section::make('User New Password')->schema([
                    TextInput::make('new_password')->nullable()->password()->rule(Password::default()),
                    TextInput::make('new_password_confirmation')->password()->same('new_password')->requiredWith('new_password'),
                ]),
            ]);
    }
}
