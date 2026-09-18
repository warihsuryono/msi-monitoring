<?php

namespace App\Filament\Resources\Parameters\Schemas;

use App\Models\Parameter;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ParameterInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->placeholder('-'),
                TextEntry::make('caption')
                    ->placeholder('-'),
                TextEntry::make('p_type')
                    ->placeholder('-'),
                TextEntry::make('unit.name')
                    ->label('Unit')
                    ->placeholder('-'),
                TextEntry::make('molecular_mass')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('deleted_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('updated_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Parameter $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
