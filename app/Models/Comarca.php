<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Comarca extends Model
{
    use HasFactory;

    protected $fillable = ['province_id', 'name', 'slug', 'description'];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class);
    }

    public function events(): HasManyThrough
    {
        return $this->hasManyThrough(Event::class, Municipality::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
