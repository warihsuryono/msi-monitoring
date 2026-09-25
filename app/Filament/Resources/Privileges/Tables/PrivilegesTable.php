<?php

namespace App\Filament\Resources\Privileges\Tables;

use App\Traits\FilamentListActions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PrivilegesTable
{
    use FilamentListActions;
    protected static ?string $routename = 'privileges';

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('id', '>', '1');
            })
            ->filters([
                //
            ])
            ->recordActions(
                self::actions(self::$routename),
                position: RecordActionsPosition::BeforeColumns
            );
    }
}
