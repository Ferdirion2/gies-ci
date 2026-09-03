<?php

namespace App\Filament\Resources\Articles\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MediaRelationManager extends RelationManager
{
    protected static string $relationship = 'media';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Vidéo',
                    ])
                    ->required()
                    ->native(false)
                    ->default('image'),

                FileUpload::make('path')
                    ->label('Fichier media')
                    ->disk('public')
                    ->directory('articles/media')
                    ->acceptedFileTypes([
                        'image/jpeg',
                        'image/png',
                        'image/webp',
                        'image/jpg',
                        'video/mp4',
                        'video/webm',
                        'video/quicktime',
                    ])
                    ->preserveFilenames()
                    ->required(),

                TextInput::make('ordre')
                    ->numeric()
                    ->default(0),

                Toggle::make('est_principale')
                    ->label('Media principal'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('path')
                    ->label('Aperçu')
                    ->disk('public')
                    ->height(60),
                TextColumn::make('type')->badge()->sortable(),
                TextColumn::make('ordre')->sortable(),
                IconColumn::make('est_principale')->boolean()->label('Principal'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
