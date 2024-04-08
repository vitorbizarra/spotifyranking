<?php

namespace App\Models\Ranking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
}
