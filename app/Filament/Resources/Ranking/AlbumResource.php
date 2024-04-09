<?php

namespace App\Filament\Resources\Ranking;

use App\Filament\Resources\Ranking\AlbumResource\Pages;
use App\Filament\Resources\Ranking\AlbumResource\RelationManagers;
use App\Forms\Components\EmbedInput;
use App\Infolists\Components\EmbedEntry;
use App\Models\Ranking\Album;
use App\Tables\Columns\EmbedColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlbumResource extends Resource
{
    protected static ?string $model = Album::class;

    protected static ?string $navigationIcon = 'heroicon-s-musical-note';

    protected static ?string $modelLabel = 'álbum';

    protected static ?string $pluralModelLabel = 'álbuns';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('level_id')
                            ->label('Ranking')
                            ->required()
                            ->relationship('level', 'title')
                            ->native(false),
                        Forms\Components\TextInput::make('title')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('tierlists')
                            ->relationship('tierlists', 'name')
                            ->searchable()
                            ->preload()
                            ->multiple()
                            ->columnSpanFull(),
                        EmbedInput::make('embed')
                            ->live()
                            ->required()
                            ->autosize()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('title')
                            ->label('Título'),
                        Infolists\Components\TextEntry::make('level')
                            ->label('Ranking')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state->title)
                            ->color(fn ($state) => Color::hex($state->color)),
                        EmbedEntry::make('embed')
                            ->columnSpanFull(),

                        Infolists\Components\Fieldset::make('Informações Adicionais')
                            ->columns(3)
                            ->schema([
                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Criado em:')
                                    ->dateTime('d/m/Y H:i')
                                    ->placeholder('Nunca'),

                                Infolists\Components\TextEntry::make('updated_at')
                                    ->label('Atualizado em:')
                                    ->dateTime('d/m/Y H:i')
                                    ->placeholder('Nunca'),

                                Infolists\Components\TextEntry::make('deleted_at')
                                    ->label('Excluído em:')
                                    ->dateTime('d/m/Y H:i')
                                    ->placeholder('Nunca'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    EmbedColumn::make('embed'),
                    Tables\Columns\Layout\Grid::make()
                        ->columns(6)
                        ->schema([
                            Tables\Columns\TextColumn::make('title')
                                ->label('Nome')
                                ->searchable()
                                ->columnSpan(5)
                                ->limit(24)
                                ->weight(FontWeight::SemiBold)
                                ->size(Tables\Columns\TextColumn\TextColumnSize::Large),
                            Tables\Columns\TextColumn::make('sort')
                                ->label('Posição')
                                ->badge()
                                ->sortable()
                                ->searchable()
                                ->alignRight(),
                        ]),
                    Tables\Columns\TextColumn::make('tierlists.0.pivot.level')
                        ->label('Ranking')
                        ->numeric()
                        ->badge()
                        ->formatStateUsing(fn ($state) => $state->title)
                        ->color(fn ($state) => Color::hex($state->color)),
                ])->space(2),
            ])
            ->contentGrid(['md' => 3])
            ->paginated([
                15,
                30,
                60,
                'all',
            ])
            ->groups([
                // Tables\Grouping\Group::make('tierlist.level_id')
                //     ->label('Ranking')
                //     ->getTitleFromRecordUsing(fn ($record): ?string => $record->level->title),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlbums::route('/'),
            'create' => Pages\CreateAlbum::route('/create'),
            'view' => Pages\ViewAlbum::route('/{record}'),
            'edit' => Pages\EditAlbum::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
