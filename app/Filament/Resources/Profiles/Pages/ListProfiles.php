<?php

namespace App\Filament\Resources\Profiles\Pages;

use App\Filament\Resources\Profiles\ProfileResource;
use App\Traits\FilamentListFunctions;
use Filament\Resources\Pages\ListRecords;

class ListProfiles extends ListRecords
{
    use FilamentListFunctions;
    protected static string $resource = ProfileResource::class;
}
