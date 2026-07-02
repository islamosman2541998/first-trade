<?php

namespace App\Livewire\Admin\HomeSections;

use App\Models\HomeSection;
use App\Models\HomeSectionItem;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeSectionItems extends Component
{
    use WithFileUploads;

    public int $sectionId;

    public ?int $editingItemId = null;

    public ?string $title_en = null;
    public ?string $title_ar = null;
    public ?string $title_nl = null;

    public ?string $description_en = null;
    public ?string $description_ar = null;
    public ?string $description_nl = null;

    public ?string $icon = null;

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
        $this->sectionId = $sectionId;
    }

    public function saveItem(): void
    {
        $this->validate([
            'title_en' => ['nullable', 'string', 'max:255'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'title_nl' => ['nullable', 'string', 'max:255'],

            'description_en' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
            'description_nl' => ['nullable', 'string'],

            'icon' => ['nullable', 'string', 'max:255'],

            'button_text_en' => ['nullable', 'string', 'max:255'],
            'button_text_ar' => ['nullable', 'string', 'max:255'],
            'button_text_nl' => ['nullable', 'string', 'max:255'],

            'button_link' => ['nullable', 'string', 'max:255'],
            'button_target' => ['required', 'in:_self,_blank'],

            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ]);

        $imagePath = $this->currentImage;

        if ($this->image) {
            $imagePath = 'storage/' . $this->image->store('home-section-items', 'public');
        }

        $data = [
            'home_section_id' => $this->sectionId,

            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'title_nl' => $this->title_nl,

            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
            'description_nl' => $this->description_nl,

            'icon' => $this->icon,
            'image' => $imagePath,

            'button_text_en' => $this->button_text_en,
            'button_text_ar' => $this->button_text_ar,
            'button_text_nl' => $this->button_text_nl,

            'button_link' => $this->button_link,
            'button_target' => $this->button_target,

            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
        ];

        if ($this->editingItemId) {
            HomeSectionItem::where('home_section_id', $this->sectionId)
                ->where('id', $this->editingItemId)
                ->update($data);
        } else {
            HomeSectionItem::create($data);
        }

        $this->resetForm();

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function editItem(int $itemId): void
    {
        $item = HomeSectionItem::where('home_section_id', $this->sectionId)
            ->findOrFail($itemId);

        $this->editingItemId = $item->id;

        $this->title_en = $item->title_en;
        $this->title_ar = $item->title_ar;
        $this->title_nl = $item->title_nl;

        $this->description_en = $item->description_en;
        $this->description_ar = $item->description_ar;
        $this->description_nl = $item->description_nl;

        $this->icon = $item->icon;

        $this->button_text_en = $item->button_text_en;
        $this->button_text_ar = $item->button_text_ar;
        $this->button_text_nl = $item->button_text_nl;

        $this->button_link = $item->button_link;
        $this->button_target = $item->button_target ?: '_self';

        $this->is_active = (bool) $item->is_active;
        $this->sort_order = (int) $item->sort_order;

        $this->currentImage = $item->image;
        $this->reset('image');
    }

    public function deleteItem(int $itemId): void
    {
        HomeSectionItem::where('home_section_id', $this->sectionId)
            ->where('id', $itemId)
            ->delete();

        if ($this->editingItemId === $itemId) {
            $this->resetForm();
        }

        $this->dispatch('toastr-success', message: __('admin.deleted_successfully'));
    }

    public function toggleItemStatus(int $itemId): void
    {
        $item = HomeSectionItem::where('home_section_id', $this->sectionId)
            ->findOrFail($itemId);

        $item->update([
            'is_active' => ! $item->is_active,
        ]);

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function resetForm(): void
    {
        $this->reset([
            'editingItemId',
            'title_en',
            'title_ar',
            'title_nl',
            'description_en',
            'description_ar',
            'description_nl',
            'icon',
            'button_text_en',
            'button_text_ar',
            'button_text_nl',
            'button_link',
            'currentImage',
            'image',
        ]);

        $this->button_target = '_self';
        $this->is_active = true;
        $this->sort_order = 0;
    }

    public function render()
    {
        $section = HomeSection::with(['items'])->findOrFail($this->sectionId);

        return view('livewire.admin.home-sections.home-section-items', [
            'section' => $section,
            'items' => $section->items()->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }
}