<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    use SoftDeletes;

    public array $translatedAttributes = [
        'name',
        'description',
    ];

    protected $fillable = [
        'parent_id',
        'slug',
        'image',
        'sort_order',
        'is_active',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('id');
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->ordered();
    }

    public function activeChildren(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->active()
            ->ordered();
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function scopeParents($query)
{
    return $query->whereNull('parent_id');
}

public function scopeChildren($query)
{
    return $query->whereNotNull('parent_id');
}
}
