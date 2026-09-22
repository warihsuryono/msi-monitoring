<?php

namespace App\Filament\Resources\Menus\Tables;

use App\Filament\Tables\Columns\ReorderButton;
use App\Traits\FilamentListActions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MenusTable
{
    use FilamentListActions;
    protected static ?string $routename = 'menus';
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                ReorderButton::make('seqno')->label("Seq No")->sortable(),
                TextColumn::make('url')->searchable(),
                TextColumn::make('icon'),
                TextColumn::make('route'),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('parent_id', '=', '0');
            })
            ->filters([])
            ->recordActions(
                self::actions(self::$routename),
                position: RecordActionsPosition::BeforeColumns
            );
    }
}
