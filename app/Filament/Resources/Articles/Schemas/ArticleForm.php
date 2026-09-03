<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $state, Set $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Select::make('categorie')
                    ->options([
                        'Etudes' => 'Etudes',
                        'Installation' => 'Installation',
                        'Maintenance' => 'Maintenance',
                        'Actualites' => 'Actualités',
                        'Ressources' => 'Ressources',
                    ])
                    ->searchable()
                    ->preload(),

                DatePicker::make('date_publication')
                    ->required()
                    ->label('Date de publication'),

                Textarea::make('extrait')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('image_couverture')
                    ->label('Image de couverture')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('articles')
                    ->columnSpanFull(),

                RichEditor::make('contenu')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
