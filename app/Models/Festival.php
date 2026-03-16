<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Festival extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    protected $fillable = [
        'municipality_id', 'category_id', 'name', 'slug', 'description',
        'short_description', 'start_date', 'end_date', 'is_active', 'is_featured',
        'website_url', 'address', 'lat', 'lng', 'cover_image', 'views_count', 'published_at',
    ];

    protected function casts(): array
    {
        return [
            'start_date'   => 'date',
            'end_date'     => 'date',
            'is_active'    => 'boolean',
            'is_featured'  => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Relationships

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(FestivalImage::class)->orderBy('sort_order');
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    // Scopes

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->whereNotNull('published_at');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('end_date', '>=', now()->toDateString())->orderBy('start_date');
    }

    public function scopeByProvince(Builder $query, int|string $provinceId): Builder
    {
        return $query->whereHas('municipality', fn ($q) => $q->where('province_id', $provinceId));
    }

    public function scopeByCategory(Builder $query, int|string $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByDateRange(Builder $query, ?string $from, ?string $to): Builder
    {
        if ($from) {
            $query->where('end_date', '>=', $from);
        }
        if ($to) {
            $query->where('start_date', '<=', $to);
        }

        return $query;
    }

    public function scopeSearch(Builder $query, string $term): Builder
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('short_description', 'like', "%{$term}%");
        });
    }
}
