<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeSectionItem extends Model
{
    protected $fillable = [
        'home_section_id',

        'title_en',
        'title_ar',
        'title_nl',

        'description_en',
        'description_ar',
        'description_nl',

        'icon',
        'image',

        'button_text_en',
        'button_text_ar',
        'button_text_nl',

        'button_link',
        'button_target',

        'is_active',
        'sort_order',

        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'settings' => 'array',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(HomeSection::class, 'home_section_id');
    }

    public function title(?string $locale = null): ?string
    {
        $locale = $locale ?: app()->getLocale();

        return $this->{'title_' . $locale} ?: $this->title_en;
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