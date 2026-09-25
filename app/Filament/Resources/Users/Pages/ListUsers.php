<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Traits\FilamentListFunctions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected $routename = 'users';
    use FilamentListFunctions;
    protected static string $resource = UserResource::class;
}
