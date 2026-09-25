<?php

namespace App\Filament\Resources\Privileges;

use App\Filament\Resources\Privileges\Pages\CreatePrivilege;
use App\Filament\Resources\Privileges\Pages\EditPrivilege;
use App\Filament\Resources\Privileges\Pages\ListPrivileges;
use App\Filament\Resources\Privileges\Schemas\PrivilegeForm;
use App\Filament\Resources\Privileges\Tables\PrivilegesTable;
use App\Models\Privilege;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrivilegeResource extends Resource
{
    protected static ?string $model = Privilege::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Privilege';

    public static function form(Schema $schema): Schema
    {
        return PrivilegeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PrivilegesTable::configure($table);
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
            'index' => ListPrivileges::route('/'),
            'create' => CreatePrivilege::route('/create'),
            'edit' => EditPrivilege::route('/{record}/edit'),
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
