<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Paramètres du site';
    protected static ?string $title = 'Paramètres du site';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static string|\UnitEnum|null $navigationGroup = 'Configuration';
    protected string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()->can('gerer parametres');
    }

    public function mount(): void
    {
        $valeurs = SiteSetting::pluck('valeur', 'cle')->toArray();
        $this->form->fill($valeurs);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Coordonnées')
                    ->components([
                        TextInput::make('telephone')->label('Téléphone'),
                        TextInput::make('email')->label('Email')->email(),
                        TextInput::make('adresse')->label('Adresse'),
                    ]),

                Section::make('Réseaux sociaux')
                    ->components([
                        TextInput::make('facebook')->label('Lien Facebook')->url(),
                        TextInput::make('instagram')->label('Lien Instagram')->url(),
                        TextInput::make('linkedin')->label('Lien LinkedIn')->url(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $donnees = $this->form->getState();

        foreach ($donnees as $cle => $valeur) {
            SiteSetting::updateOrCreate(
                ['cle' => $cle],
                ['valeur' => $valeur]
            );
        }

        Notification::make()
            ->title('Paramètres enregistrés')
            ->success()
            ->send();
    }
}