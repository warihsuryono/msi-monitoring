<?php

namespace App\Filament\Resources\Profiles\Pages;

use App\Filament\Resources\Profiles\ProfileResource;
use App\Traits\FilamentEditFunctions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditProfile extends EditRecord
{
    protected $routename = 'profiles';
    use FilamentEditFunctions;
    protected static string $resource = ProfileResource::class;
    protected static ?string $title = 'Profile';

    public function mutateFormDataBeforeFill(array $data): array
    {
        if ($data['id'] != Auth::user()->id) redirect(App::make('url')->to(env('PANEL_PATH') . '/profiles'));
        return $data;
    }

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
