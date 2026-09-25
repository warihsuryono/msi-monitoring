<?php

namespace App\Filament\Resources\QualityStandards;

use App\Filament\Resources\QualityStandards\Pages\CreateQualityStandard;
use App\Filament\Resources\QualityStandards\Pages\EditQualityStandard;
use App\Filament\Resources\QualityStandards\Pages\ListQualityStandards;
use App\Filament\Resources\QualityStandards\Schemas\QualityStandardForm;
use App\Filament\Resources\QualityStandards\Tables\QualityStandardsTable;
use App\Models\QualityStandard;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QualityStandardResource extends Resource
{
    protected static ?string $model = QualityStandard::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'QualityStandard';

    public static function form(Schema $schema): Schema
    {
        return QualityStandardForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QualityStandardsTable::configure($table);
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
            'index' => ListQualityStandards::route('/'),
            'create' => CreateQualityStandard::route('/create'),
            'edit' => EditQualityStandard::route('/{record}/edit'),
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
