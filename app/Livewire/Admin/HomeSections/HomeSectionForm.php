<?php

namespace App\Livewire\Admin\HomeSections;

use App\Models\HomeSection;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeSectionForm extends Component
{
    use WithFileUploads;

    public int $sectionId;

    public string $key = '';

    public ?string $title_en = null;
    public ?string $title_ar = null;
    public ?string $title_nl = null;

    public ?string $subtitle_en = null;
    public ?string $subtitle_ar = null;
    public ?string $subtitle_nl = null;

    public ?string $description_en = null;
    public ?string $description_ar = null;
    public ?string $description_nl = null;

    public ?string $button_text_en = null;
    public ?string $button_text_ar = null;
    public ?string $button_text_nl = null;

    public ?string $button_link = null;
    public string $button_target = '_self';

    public bool $is_active = true;
    public int $sort_order = 0;

    public ?string $currentImage = null;
    public $image = null;

    public function mount(int $sectionId): void
    {
        $section = HomeSection::findOrFail($sectionId);

        $this->sectionId = $section->id;
        $this->key = $section->key;

        $this->title_en = $section->title_en;
        $this->title_ar = $section->title_ar;
        $this->title_nl = $section->title_nl;

        $this->subtitle_en = $section->subtitle_en;
        $this->subtitle_ar = $section->subtitle_ar;
        $this->subtitle_nl = $section->subtitle_nl;

        $this->description_en = $section->description_en;
        $this->description_ar = $section->description_ar;
        $this->description_nl = $section->description_nl;

        $this->button_text_en = $section->button_text_en;
        $this->button_text_ar = $section->button_text_ar;
        $this->button_text_nl = $section->button_text_nl;

        $this->button_link = $section->button_link;
        $this->button_target = $section->button_target ?: '_self';

        $this->is_active = (bool) $section->is_active;
        $this->sort_order = (int) $section->sort_order;

        $this->currentImage = $section->image;
    }

    public function save(): void
    {
        $this->validate([
            'title_en' => ['nullable', 'string', 'max:255'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'title_nl' => ['nullable', 'string', 'max:255'],

            'subtitle_en' => ['nullable', 'string', 'max:255'],
            'subtitle_ar' => ['nullable', 'string', 'max:255'],
            'subtitle_nl' => ['nullable', 'string', 'max:255'],

            'description_en' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
            'description_nl' => ['nullable', 'string'],

            'button_text_en' => ['nullable', 'string', 'max:255'],
            'button_text_ar' => ['nullable', 'string', 'max:255'],
            'button_text_nl' => ['nullable', 'string', 'max:255'],

            'button_link' => ['nullable', 'string', 'max:255'],
            'button_target' => ['required', 'in:_self,_blank'],

            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $section = HomeSection::findOrFail($this->sectionId);

        $imagePath = $this->currentImage;

        if ($this->image) {
            $imagePath = 'storage/' . $this->image->store('home-sections', 'public');
        }

        $section->update([
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'title_nl' => $this->title_nl,

            'subtitle_en' => $this->subtitle_en,
            'subtitle_ar' => $this->subtitle_ar,
            'subtitle_nl' => $this->subtitle_nl,

            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
            'description_nl' => $this->description_nl,

            'button_text_en' => $this->button_text_en,
            'button_text_ar' => $this->button_text_ar,
            'button_text_nl' => $this->button_text_nl,

            'button_link' => $this->button_link,
            'button_target' => $this->button_target,

            'image' => $imagePath,

            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
        ]);

        $this->currentImage = $imagePath;
        $this->reset('image');

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function removeImage(): void
    {
        $section = HomeSection::findOrFail($this->sectionId);

        $section->update([
            'image' => null,
        ]);

        $this->currentImage = null;
        $this->reset('image');

        $this->dispatch('toastr-success', message: __('admin.deleted_successfully'));
    }

    public function render()
    {
        return view('livewire.admin.home-sections.home-section-form');
    }
}