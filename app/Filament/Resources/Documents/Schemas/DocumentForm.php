<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required()
                    ->maxLength(255),

                TextInput::make('categorie')
                    ->label('Catégorie')
                    ->maxLength(255),

                Textarea::make('description')
                    ->rows(4)
                    ->columnSpanFull(),

                FileUpload::make('fichier')
                    ->label('Document')
                    ->required()
                    ->disk('public')
                    ->directory('documents')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/zip',
                        'application/x-zip-compressed',
                    ])
                    ->downloadable()
                    ->preserveFilenames()
                    ->columnSpanFull(),
            ]);
    }
}
