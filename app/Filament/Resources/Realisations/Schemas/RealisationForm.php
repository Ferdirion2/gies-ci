<?php

namespace App\Filament\Resources\Realisations\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use App\Models\Service;
use Illuminate\Support\Str;
use Filament\Forms\Components\RichEditor;

class RealisationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $state, Set $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                RichEditor::make('description_longue'),

                TextInput::make('lieu'),

                DatePicker::make('date_realisation'),

                TextInput::make('client')
                    ->helperText('Nom du client ou "Confidentiel"'),

                TextInput::make('kwc')
                    ->numeric()
                    ->suffix('kWc'),

                Select::make('type_bien')
                    ->options([
                        'maison' => 'Maison individuelle',
                        'entreprise' => 'Entreprise',
                        'collectivite' => 'Collectivité',
                    ])
                    ->required(),

                Select::make('services')
                    ->label('Services associés')
                    ->options(Service::pluck('titre', 'id'))
                    ->searchable()
                    ->multiple()
                    ->preload()
                    ->relationship('services', 'titre')
                    ->required(),

                Toggle::make('est_epingle')
                    ->label('Épingler sur l\'accueil'),
            ]);
    }
}