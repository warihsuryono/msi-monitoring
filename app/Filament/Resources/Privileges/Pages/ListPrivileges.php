<?php

namespace App\Filament\Resources\Privileges\Pages;

use App\Filament\Resources\Privileges\PrivilegeResource;
use App\Traits\FilamentListFunctions;
use Filament\Resources\Pages\ListRecords;

class ListPrivileges extends ListRecords
{
    protected $routename = 'privileges';
    use FilamentListFunctions;
    protected static string $resource = PrivilegeResource::class;
}
