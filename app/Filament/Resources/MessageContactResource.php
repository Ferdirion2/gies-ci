<?php

namespace App\Filament\Resources;

use App\Models\MessageContact;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class MessageContactResource extends Resource
{
    protected static ?string $model = MessageContact::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $recordTitleAttribute = 'sujet';

    public static function form(Schema $schema): Schema
    {
        return self::messageContactForm($schema);
    }

    public static function table(Table $table): Table
    {
        return self::messageContactsTable($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    // Restrict access to the same permission as Devis (gerer devis)
    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->can('gerer devis');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMessageContacts::route('/'),
            'create' => CreateMessageContact::route('/create'),
            'edit' => EditMessageContact::route('/{record}/edit'),
        ];
    }

    // Inline form definition
    protected static function messageContactForm(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('nom')->disabled(),
            TextInput::make('email')->disabled(),
            TextInput::make('sujet')->disabled(),
            Textarea::make('message')->disabled()->rows(6),
            Select::make('statut')
                ->label('Statut')
                ->options([
                    'non_lu' => 'Non lu',
                    'lu' => 'Lu',
                    'traite' => 'Traité',
                ])
                ->required(),
        ]);
    }

    // Inline table definition
    protected static function messageContactsTable(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('sujet')->limit(60)->searchable(),
                TextColumn::make('statut')
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
                TextColumn::make('created_at')->label('Reçu le')->dateTime('d/m/Y')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('statut')
                    ->options([
                        'non_lu' => 'Non lu',
                        'lu' => 'Lu',
                        'traite' => 'Traité',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

// Pages defined in the same file to avoid needing new directories
class ListMessageContacts extends ListRecords
{
    protected static string $resource = MessageContactResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}

class CreateMessageContact extends CreateRecord
{
    protected static string $resource = MessageContactResource::class;
}

class EditMessageContact extends EditRecord
{
    protected static string $resource = MessageContactResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
