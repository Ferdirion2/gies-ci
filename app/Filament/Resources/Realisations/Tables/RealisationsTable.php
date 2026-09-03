<?php

namespace App\Filament\Resources\Realisations\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Models\Service;

class RealisationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titre')->searchable()->sortable(),
                TextColumn::make('services.titre')->label('Services')->badge(),
                TextColumn::make('type_bien')->badge(),
                TextColumn::make('lieu'),
                TextColumn::make('kwc')->suffix(' kWc'),
                IconColumn::make('est_epingle')->boolean()->label('Épinglé'),
            ])
            ->filters([
                SelectFilter::make('services')
                    ->label('Service')
                    ->relationship('services', 'titre'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}