<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryForm extends Component
{
    use WithFileUploads;

    public ?int $categoryId = null;

    public array $translations = [
        'en' => [
            'name' => '',
            'description' => '',
        ],
        'ar' => [
            'name' => '',
            'description' => '',
        ],
        'nl' => [
            'name' => '',
            'description' => '',
        ],
    ];

    public ?int $parent_id = null;
    public string $slug = '';
    public ?string $image = null;
    public $newImage = null;

    public int $sort_order = 0;
    public bool $is_active = true;

    public ?string $seo_title = null;
    public ?string $seo_description = null;

    public function mount(?int $categoryId = null): void
    {
        $this->categoryId = $categoryId;

        if (! $categoryId) {
            return;
        }

        $category = Category::with('translations')->findOrFail($categoryId);

        $this->parent_id = $category->parent_id;
        $this->slug = $category->slug;
        $this->image = $category->image;
        $this->sort_order = $category->sort_order;
        $this->is_active = $category->is_active;
        $this->seo_title = $category->seo_title;
        $this->seo_description = $category->seo_description;

        foreach (['en', 'ar', 'nl'] as $locale) {
            $this->translations[$locale]['name'] = $category->translate($locale)?->name ?? '';
            $this->translations[$locale]['description'] = $category->translate($locale)?->description ?? '';
        }
    }

    public function updatedTranslationsEnName($value): void
    {
        if (! $this->categoryId && empty($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    public function save()
    {
        $this->validate([
            'translations.en.name' => ['required', 'string', 'max:190'],
            'translations.ar.name' => ['nullable', 'string', 'max:190'],
            'translations.nl.name' => ['nullable', 'string', 'max:190'],

            'translations.en.description' => ['nullable', 'string', 'max:2000'],
            'translations.ar.description' => ['nullable', 'string', 'max:2000'],
            'translations.nl.description' => ['nullable', 'string', 'max:2000'],

            'parent_id' => ['nullable', 'exists:categories,id'],
            'slug' => ['required', 'string', 'max:190', 'unique:categories,slug,' . $this->categoryId],
            'newImage' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['boolean'],

            'seo_title' => ['nullable', 'string', 'max:190'],
            'seo_description' => ['nullable', 'string', 'max:500'],
        ]);

        if ($this->categoryId && $this->parent_id == $this->categoryId) {
            $this->addError('parent_id', 'Category cannot be parent of itself.');
            return;
        }

        if ($this->newImage) {
            $this->image = 'storage/' . $this->newImage->store('categories', 'public');
        }

        $category = Category::updateOrCreate(
            ['id' => $this->categoryId],
            [
                'parent_id' => $this->parent_id ?: null,
                'slug' => $this->slug,
                'image' => $this->image,
                'sort_order' => $this->sort_order,
                'is_active' => $this->is_active,
                'seo_title' => $this->seo_title,
                'seo_description' => $this->seo_description,

                'en' => $this->translations['en'],
                'ar' => $this->translations['ar'],
                'nl' => $this->translations['nl'],
            ]
        );

        $this->categoryId = $category->id;
        $this->reset('newImage');

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        $parentCategories = Category::query()
            ->with('translations')
            ->whereNull('parent_id')
            ->when($this->categoryId, fn ($query) => $query->where('id', '!=', $this->categoryId))
            ->ordered()
            ->get();

        return view('livewire.admin.categories.category-form', [
            'parentCategories' => $parentCategories,
        ]);
    }
}