<?php

namespace App\Models\Ranking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'color',
        'sort',
    ];

    public function albumsTierlists(): BelongsToMany
    {
        return $this->belongsToMany(AlbumTierlist::class);
    }
}
