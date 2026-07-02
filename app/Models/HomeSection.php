<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeSection extends Model
{
    protected $fillable = [
        'key',

        'title_en',
        'title_ar',
        'title_nl',

        'subtitle_en',
        'subtitle_ar',
        'subtitle_nl',

        'description_en',
        'description_ar',
        'description_nl',

        'button_text_en',
        'button_text_ar',
        'button_text_nl',

        'button_link',
        'button_target',

        'image',

        'is_active',
        'sort_order',

        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'settings' => 'array',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(HomeSectionItem::class)->orderBy('sort_order')->orderBy('id');
    }

    public function activeItems(): HasMany
    {
        return $this->hasMany(HomeSectionItem::class)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function title(?string $locale = null): ?string
    {
        $locale = $locale ?: app()->getLocale();

        return $this->{'title_' . $locale} ?: $this->title_en;
    }

    public function subtitle(?string $locale = null): ?string
    {
        $locale = $locale ?: app()->getLocale();

        return $this->{'subtitle_' . $locale} ?: $this->subtitle_en;
    }

    public function description(?string $locale = null): ?string
    {
        $locale = $locale ?: app()->getLocale();

        return $this->{'description_' . $locale} ?: $this->description_en;
    }

    public function buttonText(?string $locale = null): ?string
    {
        $locale = $locale ?: app()->getLocale();

        return $this->{'button_text_' . $locale} ?: $this->button_text_en;
    }
}