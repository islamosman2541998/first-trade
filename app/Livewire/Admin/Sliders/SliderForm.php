<?php

namespace App\Livewire\Admin\Sliders;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;

class SliderForm extends Component
{
    use WithFileUploads;

    public ?int $sliderId = null;

    public array $translations = [
        'en' => [
            'title' => '',
            'description' => '',
            'button_text' => '',
        ],
        'ar' => [
            'title' => '',
            'description' => '',
            'button_text' => '',
        ],
        'nl' => [
            'title' => '',
            'description' => '',
            'button_text' => '',
        ],
    ];

    public ?string $image = null;
    public $newImage = null;

    public ?string $button_link = null;
    public string $button_target = '_self';
    public int $sort_order = 0;
    public bool $is_active = true;

    public function mount(?int $sliderId = null): void
    {
        $this->sliderId = $sliderId;

        if (! $sliderId) {
            return;
        }

        $slider = Slider::with('translations')->findOrFail($sliderId);

        $this->image = $slider->image;
        $this->button_link = $slider->button_link;
        $this->button_target = $slider->button_target;
        $this->sort_order = $slider->sort_order;
        $this->is_active = $slider->is_active;

        foreach (['en', 'ar', 'nl'] as $locale) {
            $this->translations[$locale]['title'] = $slider->translate($locale)?->title ?? '';
            $this->translations[$locale]['description'] = $slider->translate($locale)?->description ?? '';
            $this->translations[$locale]['button_text'] = $slider->translate($locale)?->button_text ?? '';
        }
    }

    public function save()
    {
        $this->validate([
            'translations.en.title' => ['nullable', 'string', 'max:190'],
            'translations.ar.title' => ['nullable', 'string', 'max:190'],
            'translations.nl.title' => ['nullable', 'string', 'max:190'],

            'translations.en.description' => ['nullable', 'string', 'max:1000'],
            'translations.ar.description' => ['nullable', 'string', 'max:1000'],
            'translations.nl.description' => ['nullable', 'string', 'max:1000'],

            'translations.en.button_text' => ['nullable', 'string', 'max:100'],
            'translations.ar.button_text' => ['nullable', 'string', 'max:100'],
            'translations.nl.button_text' => ['nullable', 'string', 'max:100'],

            'button_link' => ['nullable', 'string', 'max:500'],
            'button_target' => ['required', 'in:_self,_blank'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
            'newImage' => [$this->sliderId ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        if ($this->newImage) {
            $this->image = 'storage/' . $this->newImage->store('sliders', 'public');
        }

        $slider = Slider::updateOrCreate(
            ['id' => $this->sliderId],
            [
                'image' => $this->image,
                'button_link' => $this->button_link,
                'button_target' => $this->button_target,
                'sort_order' => $this->sort_order,
                'is_active' => $this->is_active,

                'en' => $this->translations['en'],
                'ar' => $this->translations['ar'],
                'nl' => $this->translations['nl'],
            ]
        );

        $this->sliderId = $slider->id;
        $this->reset('newImage');

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));

        return redirect()->route('admin.sliders.index');
    }

    public function render()
    {
        return view('livewire.admin.sliders.slider-form');
    }
}