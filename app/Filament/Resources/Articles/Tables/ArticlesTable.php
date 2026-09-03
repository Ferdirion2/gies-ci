<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_couverture')
                    ->label('Image')
                    ->disk('public')
                    ->height(56)
                    ->width(72),

                TextColumn::make('titre')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('categorie')
                    ->label('Catégorie')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('date_publication')
                    ->label('Date')
                    ->date()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
