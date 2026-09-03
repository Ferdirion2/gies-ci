<?php

namespace App\Filament\Resources\Documents\Tables;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class DocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titre')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('categorie')
                    ->label('Catégorie')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('fichier')
                    ->label('Fichier')
                    ->formatStateUsing(fn (?string $state) => $state ? basename($state) : '—')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Ajouté le')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('download')
                    ->label('Télécharger')
                    ->url(fn ($record) => $record->fichier ? Storage::url($record->fichier) : null)
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => filled($record->fichier)),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
