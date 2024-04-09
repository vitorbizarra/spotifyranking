<?php

namespace App\Filament\Resources\Ranking\LevelResource\Pages;

use App\Filament\Resources\Ranking\LevelResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;

class ManageLevels extends ManageRecords
{
    protected static string $resource = LevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth(MaxWidth::Large),
        ];
    }
}
