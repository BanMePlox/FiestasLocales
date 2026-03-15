<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FestivalImage extends Model
{
    protected $fillable = ['festival_id', 'path', 'caption', 'sort_order'];

    public function festival(): BelongsTo
    {
        return $this->belongsTo(Festival::class);
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->path);
    }
}
