<?php

namespace App\Filament\Pages;

use App\Models\HomeContent;
use App\Models\PageAPropos;
use App\Models\PageServices;
use App\Models\PageRealisations;
use App\Models\PageRessources;
use App\Models\PageDevis;
use App\Models\PageContact;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;

class ManagePageContent extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Contenu du site';
    protected static ?string $title = 'Contenu du site';
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;
    protected static string|\UnitEnum|null $navigationGroup = 'Configuration';
    protected string $view = 'filament.pages.manage-page-content';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()->can('gerer contenu');
    }

    public function mount(): void
    {
        $this->form->fill([
            'apropos_histoire' => PageAPropos::first()?->histoire,
            'apropos_mission' => PageAPropos::first()?->mission_valeurs,
            'apropos_equipe' => PageAPropos::first()?->texte_equipe,
            'apropos_photo' => PageAPropos::first()?->photo_equipe,

            'services_intro' => PageServices::first()?->texte_intro,
            'realisations_intro' => PageRealisations::first()?->texte_intro,
            'ressources_intro' => PageRessources::first()?->texte_intro,
            'devis_intro' => PageDevis::first()?->texte_intro,
            'contact_intro' => PageContact::first()?->texte_intro,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Pages')
                    ->tabs([
                        Tab::make('À propos')
                            ->schema([
                                RichEditor::make('apropos_histoire')->label('Notre histoire'),
                                RichEditor::make('apropos_mission')->label('Mission et valeurs'),
                                RichEditor::make('apropos_equipe')->label('Texte équipe')->toolbarButtons([
                                    'bold',
                                    'italic',
                                    'underline',
                                    'bulletList',
                                    'orderedList',
                                    'blockquote',
                                    'link',
                                ]),
                                FileUpload::make('apropos_photo')->image()->disk('public')->directory('pages'),
                            ]),

                        Tab::make('Services')
                            ->schema([
                                Textarea::make('services_intro')->label('Texte d\'introduction')->rows(3),
                            ]),

                        Tab::make('Réalisations')
                            ->schema([
                                Textarea::make('realisations_intro')->label('Texte d\'introduction')->rows(3),
                            ]),

                        Tab::make('Ressources')
                            ->schema([
                                Textarea::make('ressources_intro')->label('Texte d\'introduction')->rows(3),
                            ]),

                        Tab::make('Devis')
                            ->schema([
                                Textarea::make('devis_intro')->label('Texte d\'introduction')->rows(3),
                            ]),

                        Tab::make('Contact')
                            ->schema([
                                Textarea::make('contact_intro')->label('Texte d\'introduction')->rows(3),
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $d = $this->form->getState();

        PageAPropos::updateOrCreate(['id' => 1], [
            'histoire' => $d['apropos_histoire'], 'mission_valeurs' => $d['apropos_mission'],
            'texte_equipe' => $d['apropos_equipe'], 'photo_equipe' => $d['apropos_photo'],
        ]);

        PageServices::updateOrCreate(['id' => 1], ['texte_intro' => $d['services_intro']]);
        PageRealisations::updateOrCreate(['id' => 1], ['texte_intro' => $d['realisations_intro']]);
        PageRessources::updateOrCreate(['id' => 1], ['texte_intro' => $d['ressources_intro']]);
        PageDevis::updateOrCreate(['id' => 1], ['texte_intro' => $d['devis_intro']]);
        PageContact::updateOrCreate(['id' => 1], ['texte_intro' => $d['contact_intro']]);

        Notification::make()->title('Contenu enregistré')->success()->send();
    }
}