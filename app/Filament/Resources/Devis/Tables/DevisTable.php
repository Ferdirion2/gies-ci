<?php

namespace App\Filament\Resources\Devis\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Models\Service;

class DevisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('service.titre')->label('Service')->badge(),
                TextColumn::make('type_bien')->badge(),
                TextColumn::make('statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'recu' => 'gray',
                        'en_cours_etude' => 'warning',
                        'chiffre' => 'info',
                        'accepte' => 'success',
                        'refuse' => 'danger',
                    }),
                TextColumn::make('created_at')->label('Reçu le')->dateTime('d/m/Y')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('statut')
                    ->options([
                        'recu' => 'Reçu',
                        'en_cours_etude' => 'En cours d\'étude',
                        'chiffre' => 'Chiffré',
                        'accepte' => 'Accepté',
                        'refuse' => 'Refusé',
                    ]),
                SelectFilter::make('service_id')
                    ->label('Service')
                    ->options(Service::pluck('titre', 'id')),
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