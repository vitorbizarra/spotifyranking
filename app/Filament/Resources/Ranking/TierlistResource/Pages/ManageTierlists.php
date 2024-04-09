<?php

namespace App\Filament\Resources\Ranking\TierlistResource\Pages;

use App\Filament\Resources\Ranking\TierlistResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTierlists extends ManageRecords
{
    protected static string $resource = TierlistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
