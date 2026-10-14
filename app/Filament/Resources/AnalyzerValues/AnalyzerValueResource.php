<?php

namespace App\Filament\Resources\AnalyzerValues;

use App\Filament\Resources\AnalyzerValues\Pages\CreateAnalyzerValue;
use App\Filament\Resources\AnalyzerValues\Pages\EditAnalyzerValue;
use App\Filament\Resources\AnalyzerValues\Pages\ListAnalyzerValues;
use App\Filament\Resources\AnalyzerValues\Schemas\AnalyzerValueForm;
use App\Filament\Resources\AnalyzerValues\Tables\AnalyzerValuesTable;
use App\Models\AnalyzerValue;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnalyzerValueResource extends Resource
{
    protected static ?string $model = AnalyzerValue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'AnalyzerValue';

    public static function form(Schema $schema): Schema
    {
        return AnalyzerValueForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnalyzerValuesTable::configure($table);
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
            'index' => ListAnalyzerValues::route('/'),
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
