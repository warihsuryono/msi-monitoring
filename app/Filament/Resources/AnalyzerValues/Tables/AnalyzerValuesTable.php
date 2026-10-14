<?php

namespace App\Filament\Resources\AnalyzerValues\Tables;

use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AnalyzerValuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->dateTime()->sortable(),
                TextColumn::make('device.name'),
                TextColumn::make('parameter.name'),
                TextColumn::make('value')->numeric()->alignRight(),
                TextColumn::make('parameter.unit.name'),
            ])
            ->defaultSort("created_at", "desc")
            ->filters([
                SelectFilter::make('parameter_id')->relationship('parameter', 'name')->preload()->searchable()->label('Parameter')->multiple(true),
                Filter::make('created_at')
                    ->form([DateTimePicker::make('time_group_from'), DateTimePicker::make('time_group_until')])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['time_group_from'], fn(Builder $query, $date): Builder => $query->where('time_group', '>=', $date))
                            ->when($data['time_group_until'], fn(Builder $query, $date): Builder => $query->where('time_group', '<=', $date));
                    }),
            ])
            ->deferFilters(true)
            ->filtersFormColumns(4)
            ->paginated([100, 250, 500, 1000])
            // ->headerActions([
            //     ExportAction::make()->exporter(DataIntegrationExporter::class)->columnMapping(false)
            //         ->modalDescription("Are you sure you want to export the filtered data logs?")
            //         ->icon('heroicon-o-arrow-down-on-square')->color("success")
            // ])
            ->poll("60s");
    }
}
