<?php

namespace App\Filament\Resources\Childmenus\Pages;

use App\Filament\Resources\Childmenus\ChildmenuResource;
use App\Traits\FilamentCreateFunctions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateChildmenu extends CreateRecord
{
    protected static string $resource = ChildmenuResource::class;
    protected $routename = 'menus';
    use FilamentCreateFunctions;
    protected static bool $canCreateAnother = false;
    protected function getRedirectUrl(): string
    {
        return route('filament.' . env('PANEL_PATH') . '.resources.childmenus.index', $this->record->id);
    }

    protected function handleRecordCreation(array $data): Model
    {
        $lastmenu = static::getModel()::where(['parent_id' => '0'])->orderby('seqno', 'desc')->first();
        $data["seqno"] = $lastmenu->seqno + 1;
        return static::getModel()::create($data);
    }
}
