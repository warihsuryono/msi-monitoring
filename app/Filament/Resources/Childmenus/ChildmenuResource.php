<?php

namespace App\Filament\Resources\Childmenus;

use App\Filament\Resources\Childmenus\Pages\CreateChildmenu;
use App\Filament\Resources\Childmenus\Pages\EditChildmenu;
use App\Filament\Resources\Childmenus\Pages\ListChildmenus;
use App\Filament\Resources\Childmenus\Schemas\ChildmenuForm;
use App\Filament\Resources\Childmenus\Tables\ChildmenusTable;
use App\Models\menu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChildmenuResource extends Resource
{
    protected static ?string $model = menu::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'menu';

    public static function form(Schema $schema): Schema
    {
        return ChildmenuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChildmenusTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListChildmenus::route('/'),
            'create' => CreateChildmenu::route('/create'),
            'edit' => EditChildmenu::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
