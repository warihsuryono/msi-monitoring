<?php

namespace App\Filament\Resources\Childmenus\Tables;

use App\Filament\Tables\Columns\ReorderButton;
use App\Traits\FilamentListActions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ChildmenusTable
{
    use FilamentListActions;
    protected static ?string $label = "Child Menu";
    protected static ?string $routename = 'menus';
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('parentMenu.name')->label('Parent')->searchable(),
                TextColumn::make('name')->searchable(),
                ReorderButton::make('seqno')->label("Seq No")->sortable(),
                TextColumn::make('url')->searchable(),
                TextColumn::make('route'),
            ])
            ->groups([Group::make('parent_id')
                ->collapsible()])
            ->defaultGroup('parent_id')
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('parent_id', '<>', '0');
            })
            ->filters([])
            ->recordActions(
                self::actions(self::$routename),
                position: RecordActionsPosition::BeforeColumns
            );
    }
}
