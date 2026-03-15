<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'color', 'icon'];

    public function festivals(): HasMany
    {
        return $this->hasMany(Festival::class);
    }
}
