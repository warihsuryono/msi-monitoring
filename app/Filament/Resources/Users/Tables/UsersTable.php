<?php

namespace App\Filament\Resources\Users\Tables;

use App\Traits\FilamentListActions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
    use FilamentListActions;
    protected static ?string $routename = 'users';
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('institution')->searchable(),
                TextColumn::make('privilege.name')->searchable(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('id', '>', '1');
            })
            ->filters([
                SelectFilter::make('privilege_id')->relationship('privilege', 'name')
            ])
            ->recordActions(
                self::actions(self::$routename),
                position: RecordActionsPosition::BeforeColumns
            );
    }
}
