<?php

namespace App\Filament\Resources\Realisations\RelationManagers;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;

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
                    ->live(),

                FileUpload::make('path')
                    ->label('Fichier')
                    ->image()
                     ->disk('public')
                    ->directory('realisations')
                    ->required(),

                TextInput::make('ordre')
                    ->numeric()
                    ->default(0),

                Toggle::make('est_principale')
                ->label('Image principale'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('path')->label('Aperçu'),
                TextColumn::make('type')->badge(),
                TextColumn::make('ordre')->sortable(),
                IconColumn::make('est_principale')->boolean()->label('Principale'),
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