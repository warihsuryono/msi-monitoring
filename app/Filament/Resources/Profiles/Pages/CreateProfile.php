<?php

namespace App\Filament\Resources\Profiles\Pages;

use App\Filament\Resources\Profiles\ProfileResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProfile extends CreateRecord
{
    protected function beforeFill(): void
    {
        redirect(App::make('url')->to(env('PANEL_PATH') . '/profiles'));
    }
    protected static string $resource = ProfileResource::class;
    protected static bool $canCreateAnother = false;
}
