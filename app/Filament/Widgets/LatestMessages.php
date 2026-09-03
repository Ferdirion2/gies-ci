<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use App\Models\MessageContact;
use Illuminate\Support\Facades\Schema;

class LatestMessages extends TableWidget
{
    protected static ?string $heading = 'Derniers messages de contact';

    // Half width in a 12-column layout
    protected int|string|array $columnSpan = 6;

    public function table(Table $table): Table
    {
        // If the table doesn't exist locally (e.g., migrations not run), avoid running a query
        // that would throw a QueryException during Livewire lazy loading. Use an empty data
        // source instead so the widget renders an empty table until the migrations are applied.
        if (! Schema::hasTable('message_contacts')) {
            return $table
                ->records(fn () => collect([]))
                ->defaultSort('created_at', 'desc')
                ->defaultPaginationPageOption(5)
                ->paginationPageOptions([5, 10, 25])
                ->columns([
                    TextColumn::make('nom')->label('Nom')->limit(30),
                    TextColumn::make('sujet')->label('Sujet')->limit(50),
                    TextColumn::make('statut')
                        ->label('Statut')
                        ->badge()
                        ->formatStateUsing(fn (string $state): string => match ($state) {
                            'non_lu' => 'Non lu',
                            'lu' => 'Lu',
                            'traite' => 'Traité',
                        })
                        ->color(fn (string $state): string => match ($state) {
                            'non_lu' => 'danger',
                            'lu' => 'warning',
                            'traite' => 'success',
                        }),
                    TextColumn::make('created_at')->label('Reçu')->since(),
                ]);
        }

        return $table
            ->query(MessageContact::query()->latest())
            ->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(5)
            ->paginationPageOptions([5, 10, 25])
            ->columns([
                TextColumn::make('nom')->label('Nom')->limit(30),
                TextColumn::make('sujet')->label('Sujet')->limit(50),
                TextColumn::make('statut')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'non_lu' => 'Non lu',
                        'lu' => 'Lu',
                        'traite' => 'Traité',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'non_lu' => 'danger',
                        'lu' => 'warning',
                        'traite' => 'success',
                    }),
                TextColumn::make('created_at')->label('Reçu')->since(),
            ])
            ->recordActions([]);
    }
}