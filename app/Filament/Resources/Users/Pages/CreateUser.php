<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Traits\FilamentCreateFunctions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected $routename = 'users';
    use FilamentCreateFunctions;
    protected static string $resource = UserResource::class;
    protected static bool $canCreateAnother = false;
    protected function getRedirectUrl(): string
    {
        return route('filament.' . env('PANEL_PATH') . '.resources.users.index', $this->record->id);
    }
}
