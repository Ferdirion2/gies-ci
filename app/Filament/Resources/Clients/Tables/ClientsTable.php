<?php

namespace App\Filament\Resources\Clients\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->withCount([
                'devis',
                'devis as en_cours_count' => fn ($query) => $query->where('statut', 'en_cours_etude'),
                'devis as accepte_count' => fn ($query) => $query->where('statut', 'accepte'),
            ]))
            ->columns([
                TextColumn::make('nom')->label('Client')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('devis_count')->label('Demandes')->sortable(),
                TextColumn::make('en_cours_count')->label('En cours')->sortable(),
                TextColumn::make('accepte_count')->label('Acceptées')->sortable(),
                TextColumn::make('created_at')->label('Créé le')->dateTime('d/m/Y')->sortable(),
            ])
            ->recordActions([EditAction::make()->label('Consulter')]);
    }
}