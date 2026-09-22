<?php

namespace App\Filament\Resources\Menus\Pages;

use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\Menus\MenuResource;
use App\Traits\FilamentCreateFunctions;
use Filament\Resources\Pages\CreateRecord;

class CreateMenu extends CreateRecord
{
    protected $routename = 'menus';
    use FilamentCreateFunctions;
    protected static string $resource = MenuResource::class;
    protected static bool $canCreateAnother = false;
    protected function getRedirectUrl(): string
    {
        return route('filament.' . env('PANEL_PATH') . '.resources.menus.index', $this->record->id);
    }

    protected function handleRecordCreation(array $data): Model
    {
        $lastmenu = static::getModel()::where(['parent_id' => '0'])->orderby('seqno', 'desc')->first();
        $data["seqno"] = $lastmenu->seqno + 1;
        return static::getModel()::create($data);
    }
}
