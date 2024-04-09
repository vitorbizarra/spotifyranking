<?php

namespace App\Models\Ranking;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AlbumTierlist extends Pivot
{
    protected $fillable = [
        'album_id',
        'tierlist_id',
        'level_id',
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function tierlist(): BelongsTo
    {
        return $this->belongsTo(Tierlist::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
}
