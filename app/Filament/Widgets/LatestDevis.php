<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\Devis;
use Illuminate\Support\Facades\Schema;

class LatestDevis extends TableWidget
{
    protected static ?string $heading = 'Derniers devis recus';

    // Half width so it can sit next to LatestMessages
    protected int|string|array $columnSpan = 6;

    public function table(Table $table): Table
    {
        if (! Schema::hasTable('devis')) {
            return $table
                ->records(fn () => collect([]))
                ->defaultSort('created_at', 'desc')
                ->defaultPaginationPageOption(5)
                ->paginationPageOptions([5, 10, 25])
                ->columns([
                    TextColumn::make('nom')->label('Nom')->limit(30),
                    TextColumn::make('service.titre')->label('Service')->limit(30),
                    TextColumn::make('statut')
                        ->label('Statut')
                        ->badge()
                        ->formatStateUsing(fn (string $state): string => match ($state) {
                            'recu' => 'Reçu',
                            'en_cours_etude' => 'En cours d\'étude',
                            'chiffre' => 'Chiffré',
                            'accepte' => 'Accepté',
                            'refuse' => 'Refusé',
                        })
                        ->color(fn (string $state): string => match ($state) {
                            'recu' => 'gray',
                            'en_cours_etude' => 'warning',
                            'chiffre' => 'info',
                            'accepte' => 'success',
                            'refuse' => 'danger',
                        }),
                    TextColumn::make('created_at')->label('Date')->since(),
                ]);
        }

        return $table
            ->query(Devis::query()->latest())
            ->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(5)
            ->paginationPageOptions([5, 10, 25])
            ->columns([
                TextColumn::make('nom')->label('Nom')->limit(30),
                TextColumn::make('service.titre')->label('Service')->limit(30),
                TextColumn::make('statut')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'recu' => 'Reçu',
                        'en_cours_etude' => 'En cours d\'étude',
                        'chiffre' => 'Chiffré',
                        'accepte' => 'Accepté',
                        'refuse' => 'Refusé',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'recu' => 'gray',
                        'en_cours_etude' => 'warning',
                        'chiffre' => 'info',
                        'accepte' => 'success',
                        'refuse' => 'danger',
                    }),
                TextColumn::make('created_at')->label('Date')->since(),
            ]);
    }
}
