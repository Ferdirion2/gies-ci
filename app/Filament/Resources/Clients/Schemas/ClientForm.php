<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nom')->label('Nom complet')->disabled(),
            TextInput::make('email')->email()->disabled(),
            Placeholder::make('date_creation')
                ->label('Compte créé le')
                ->content(fn ($record) => $record?->created_at?->format('d/m/Y H:i') ?? 'Non renseigné'),
            Placeholder::make('statistiques')
                ->label('Statistiques')
                ->content(function ($record) {
                    if (! $record) return 'Aucune donnée';
                    $counts = $record->devis()->selectRaw("count(*) as total, sum(statut = 'recu') as recu, sum(statut = 'en_cours_etude') as encours, sum(statut = 'accepte') as accepte, sum(statut = 'refuse') as refuse")->first();
                    return new HtmlString(sprintf(
                        '<strong>Total :</strong> %d &nbsp; <strong>En attente :</strong> %d &nbsp; <strong>En cours :</strong> %d &nbsp; <strong>Acceptées :</strong> %d &nbsp; <strong>Refusées :</strong> %d',
                        $counts->total ?? 0, $counts->recu ?? 0, $counts->encours ?? 0, $counts->accepte ?? 0, $counts->refuse ?? 0
                    ));
                })
                ->columnSpanFull(),
        ]);
    }
}