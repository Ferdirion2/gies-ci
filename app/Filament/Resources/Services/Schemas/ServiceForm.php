<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class ServiceForm
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

                Textarea::make('description_courte')
                    ->required()
                    ->rows(2),

                RichEditor::make('description_longue'),

                Textarea::make('points_cles')
                    ->rows(3)
                    ->helperText('Un point par ligne'),

                FileUpload::make('image')
                    ->image()
                     ->disk('public')
                    ->directory('services'),

                Select::make('icone')
                    ->label('Icône')
                    ->options([
                        'heroicon-o-home-modern' => 'Maison / résidentiel',
                        'heroicon-o-building-office-2' => 'Entreprise / collectivité',
                        'heroicon-o-wrench-screwdriver' => 'Maintenance',
                        'heroicon-o-clipboard-document-check' => 'Audit / contrôle',
                        'heroicon-o-sun' => 'Solaire / énergie',
                        'heroicon-o-bolt' => 'Électricité',
                        'heroicon-o-cog-6-tooth' => 'Technique / équipement',
                        'heroicon-o-ruler' => 'Mesure / essai',
                        'heroicon-o-beaker' => 'Mesure / essai',
                        'heroicon-o-map-pin' => 'Piquetage / implantation',
                        'heroicon-o-squares-2x2' => 'Panneaux / modules',
                        'heroicon-o-link' => 'Câbles / raccordement',
                        'heroicon-o-light-bulb' => 'Éclairage solaire',
                        'heroicon-o-video-camera' => 'Vidéosurveillance',
                        'heroicon-o-magnifying-glass' => 'Contrôle / conformité',
                    ])
                    ->default('heroicon-o-sun')
                    ->searchable()
                    ->required(),

                Toggle::make('est_epingle')
                    ->label('Mettre en avant sur l\'accueil'),

                TextInput::make('ordre')
                    ->numeric()
                    ->default(0),
            ]);
    }
}