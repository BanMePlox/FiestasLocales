<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Event extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'municipality_id',
        'music_genre_id',
        'submitted_by',
        'name',
        'slug',
        'description',
        'starts_at',
        'ends_at',
        'venue',
        'address',
        'lat',
        'lng',
        'price',
        'min_age',
        'website_url',
        'instagram_url',
        'cover_image',
        'is_active',
        'approved_at',
    ];

    protected $casts = [
        'starts_at'   => 'datetime',
        'ends_at'     => 'datetime',
        'approved_at' => 'datetime',
        'price'       => 'decimal:2',
        'lat'         => 'float',
        'lng'         => 'float',
        'is_active'   => 'boolean',
        'min_age'     => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Relations
    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    public function musicGenre(): BelongsTo
    {
        return $this->belongsTo(MusicGenre::class);
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    // Scopes
    public function scopeApproved(Builder $query): Builder
    {
        return $query->whereNotNull('approved_at');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->whereNull('approved_at');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->approved();
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->active()->where('starts_at', '>=', now())->orderBy('starts_at');
    }

    public function scopePast(Builder $query): Builder
    {
        return $query->active()->where('starts_at', '<', now())->orderByDesc('starts_at');
    }

    public function scopeByComarca(Builder $query, string $slug): Builder
    {
        return $query->whereHas('municipality.comarca', fn ($q) => $q->where('slug', $slug));
    }

    public function scopeByMunicipality(Builder $query, string $slug): Builder
    {
        return $query->whereHas('municipality', fn ($q) => $q->where('slug', $slug));
    }

    public function scopeByGenre(Builder $query, string $slug): Builder
    {
        return $query->whereHas('musicGenre', fn ($q) => $q->where('slug', $slug));
    }

    // Helpers
    public function isFree(): bool
    {
        return is_null($this->price);
    }

    public function isApproved(): bool
    {
        return !is_null($this->approved_at);
    }

    public function formattedPrice(): string
    {
        return $this->isFree() ? 'Entrada libre' : number_format($this->price, 2) . ' €';
    }
}
