<?php

namespace App\Filament\Resources\Clients\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DevisRelationManager extends RelationManager
{
    protected static string $relationship = 'devis';

    public function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->label('Référence'),
            TextColumn::make('created_at')->label('Date')->dateTime('d/m/Y H:i'),
            TextColumn::make('service.titre')->label('Objet'),
            TextColumn::make('statut')->badge(),
            TextColumn::make('updated_at')->label('Mise à jour')->dateTime('d/m/Y H:i'),
        ]);
    }
}