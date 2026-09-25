<?php

namespace App\Filament\Resources\Privileges\Pages;

use App\Filament\Resources\Privileges\PrivilegeResource;
use App\Traits\FilamentCreateFunctions;
use Filament\Resources\Pages\CreateRecord;

class CreatePrivilege extends CreateRecord
{
    protected $routename = 'privileges';
    use FilamentCreateFunctions;
    protected static string $resource = PrivilegeResource::class;
    protected static bool $canCreateAnother = false;
}
