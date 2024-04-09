<?php

namespace App\Models\Ranking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tierlist extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'sort',
    ];

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class);
    }
}
