<?php

namespace App\Models\Ranking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'level_id',
        'title',
        'embed',
        'sort',
    ];

    public function tierlists(): BelongsToMany
    {
        return $this->belongsToMany(Tierlist::class)->using(AlbumTierlist::class)->withPivot('level_id');
    }

    /**
     * Método necessário para utilizar um relacionamento ManyToMany no Repeater
     * @link https://filamentphp.com/docs/3.x/forms/fields/repeater#integrating-with-a-belongstomany-eloquent-relationship
     */
    public function albumTierlist(): HasMany
    {
        return $this->hasMany(AlbumTierlist::class);
    }
}
