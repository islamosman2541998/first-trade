<?php

namespace App\Livewire\Admin\AboutPage;

use App\Services\SettingService;
use Livewire\Component;
use Livewire\WithFileUploads;

class AboutPageForm extends Component
{
    use WithFileUploads;

    public array $settings = [];

    public $aboutHeroImage = null;
    public $aboutStoryImage = null;

    public function mount(): void
    {
        $keys = [
            'about_hero_subtitle_en', 'about_hero_subtitle_ar', 'about_hero_subtitle_nl',
            'about_hero_title_en', 'about_hero_title_ar', 'about_hero_title_nl',
            'about_hero_description_en', 'about_hero_description_ar', 'about_hero_description_nl',
            'about_hero_image',

            'about_story_subtitle_en', 'about_story_subtitle_ar', 'about_story_subtitle_nl',
            'about_story_title_en', 'about_story_title_ar', 'about_story_title_nl',
            'about_story_description_en', 'about_story_description_ar', 'about_story_description_nl',
            'about_story_image',

            'about_stat_1_number', 'about_stat_1_label_en', 'about_stat_1_label_ar', 'about_stat_1_label_nl',
            'about_stat_2_number', 'about_stat_2_label_en', 'about_stat_2_label_ar', 'about_stat_2_label_nl',
            'about_stat_3_number', 'about_stat_3_label_en', 'about_stat_3_label_ar', 'about_stat_3_label_nl',

            'about_values_subtitle_en', 'about_values_subtitle_ar', 'about_values_subtitle_nl',
            'about_values_title_en', 'about_values_title_ar', 'about_values_title_nl',

            'about_value_1_icon', 'about_value_1_title_en', 'about_value_1_title_ar', 'about_value_1_title_nl',
            'about_value_1_description_en', 'about_value_1_description_ar', 'about_value_1_description_nl',

            'about_value_2_icon', 'about_value_2_title_en', 'about_value_2_title_ar', 'about_value_2_title_nl',
            'about_value_2_description_en', 'about_value_2_description_ar', 'about_value_2_description_nl',

            'about_value_3_icon', 'about_value_3_title_en', 'about_value_3_title_ar', 'about_value_3_title_nl',
            'about_value_3_description_en', 'about_value_3_description_ar', 'about_value_3_description_nl',

            'about_cta_title_en', 'about_cta_title_ar', 'about_cta_title_nl',
            'about_cta_description_en', 'about_cta_description_ar', 'about_cta_description_nl',
        ];

        foreach ($keys as $key) {
            $this->settings[$key] = setting($key);
        }
    }

    public function save(): void
    {
        $this->validate([
            'aboutHeroImage' => ['nullable', 'image', 'max:4096'],
            'aboutStoryImage' => ['nullable', 'image', 'max:4096'],
            'settings.*' => ['nullable'],
        ]);

        if ($this->aboutHeroImage) {
            $this->settings['about_hero_image'] = 'storage/' . $this->aboutHeroImage->store('about-page', 'public');
        }

        if ($this->aboutStoryImage) {
            $this->settings['about_story_image'] = 'storage/' . $this->aboutStoryImage->store('about-page', 'public');
        }

        foreach ($this->settings as $key => $value) {
            $type = str_contains($key, 'image') ? 'image' : (str_contains($key, 'description') ? 'textarea' : 'text');

            SettingService::set($key, $value, $type, 'about');
        }

        $this->aboutHeroImage = null;
        $this->aboutStoryImage = null;

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function render()
    {
        return view('livewire.admin.about-page.about-page-form');
    }
}