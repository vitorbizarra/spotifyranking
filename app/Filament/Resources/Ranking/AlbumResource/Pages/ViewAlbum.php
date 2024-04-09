<?php

namespace App\Filament\Resources\Ranking\AlbumResource\Pages;

use App\Filament\Resources\Ranking\AlbumResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAlbum extends ViewRecord
{
    protected static string $resource = AlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
