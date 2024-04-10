<?php

namespace App\Models\Ranking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
