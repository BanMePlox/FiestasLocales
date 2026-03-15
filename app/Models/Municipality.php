<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipality extends Model
{
    protected $fillable = ['province_id', 'comarca_id', 'name', 'slug', 'lat', 'lng', 'population'];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function comarca(): BelongsTo
    {
        return $this->belongsTo(Comarca::class);
    }

    public function festivals(): HasMany
    {
        return $this->hasMany(Festival::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
