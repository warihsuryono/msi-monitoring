<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Models\Privilege;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Details')->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('email')->required()->unique(ignoreRecord: true)->email(),
                    TextInput::make('institution')->required(),
                    Select::make('privilege_id')->options(Privilege::all()->pluck('name', 'id'))
                        ->relationship('privilege', 'name')
                        ->searchable()
                        ->required()
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required(),

                        ]),
                    TextInput::make('password')
                        ->required()
                        ->password()
                        ->dehydrateStateUsing(fn($state) => Hash::make($state))
                        ->visible(fn($livewire) => $livewire instanceof CreateUser)
                        ->rule(Password::default()),
                    TextInput::make('msisdn')->label('Mobile Phone')->prefix('+62')->tel()->required(),
                ]),
                Section::make('User New Password')->schema([
                    TextInput::make('new_password')->nullable()->password()->rule(Password::default()),
                    TextInput::make('new_password_confirmation')->password()->same('new_password')->requiredWith('new_password'),
                ])->visible(fn($livewire) => $livewire instanceof EditUser),
            ]);
    }
}
