<?php

namespace App\Filament\Resources\Devis\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use App\Models\Service;

class DevisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')->disabled(),
                TextInput::make('email')->disabled(),
                TextInput::make('telephone')->disabled(),

                Select::make('service_id')
                    ->label('Service')
                    ->options(Service::pluck('titre', 'id'))
                    ->disabled(),

                Select::make('type_bien')
                    ->options([
                        'maison' => 'Maison individuelle',
                        'entreprise' => 'Entreprise',
                        'collectivite' => 'Collectivité',
                    ])
                    ->disabled(),

                Textarea::make('message')
                    ->rows(4)
                    ->disabled(),

                Select::make('statut')
                    ->label('Statut')
                    ->options([
                        'recu' => 'Reçu',
                        'en_cours_etude' => 'En cours d\'étude',
                        'chiffre' => 'Chiffré',
                        'accepte' => 'Accepté',
                        'refuse' => 'Refusé',
                    ])
                    ->required(),
            ]);
    }
}