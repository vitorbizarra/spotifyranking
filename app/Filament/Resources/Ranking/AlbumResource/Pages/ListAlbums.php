<?php

namespace App\Filament\Resources\Ranking\AlbumResource\Pages;

use App\Filament\Resources\Ranking\AlbumResource;
use App\Models\Ranking\Tierlist;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListAlbums extends ListRecords
{
    protected static string $resource = AlbumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tierlists = Tierlist::orderBy('sort')->orderBy('name')->get();

        foreach ($tierlists as $tierlist) {
            $tabs[str($tierlist->name)->slug()->toString()] = Tab::make()
                ->label($tierlist->name)
                ->modifyQueryUsing(fn (Builder $query) => $query->with('tierlists', fn ($query) => $query->where('tierlist_id', $tierlist->id)->limit(1))
                    ->whereHas('tierlists', fn ($query) => $query->where('tierlist_id', $tierlist->id)));
        }

        return $tabs;
    }

    public function getDefaultActiveTab(): string|int|null
    {
        $firstTierlist = Tierlist::orderBy('sort')->orderBy('name')->first();

        return str($firstTierlist->name)->slug()->toString();
    }
}
