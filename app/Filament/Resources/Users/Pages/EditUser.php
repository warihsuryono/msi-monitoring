<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Traits\FilamentEditFunctions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected $routename = 'users';
    use FilamentEditFunctions;
    protected static string $resource = UserResource::class;

    public function mutateFormDataBeforeSave(array $data): array
    {
        if (array_key_exists('new_password', $data) && filled($data['new_password']))
            $this->record->password = Hash::make($data['new_password']);
        unset($data['new_password']);
        unset($data['new_password_confirmation']);
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
