<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    public ?int $productId = null;

    public array $translations = [
        'en' => [
            'name' => '',
            'short_description' => '',
            'description' => '',
        ],
        'ar' => [
            'name' => '',
            'short_description' => '',
            'description' => '',
        ],
        'nl' => [
            'name' => '',
            'short_description' => '',
            'description' => '',
        ],
    ];

    public ?int $category_id = null;
    public string $slug = '';
    public ?string $sku = null;

    public ?string $main_image = null;
    public $newImage = null;

    public ?string $country_of_origin = null;
    public ?string $season = null;
    public ?string $packaging = null;
    public ?string $size = null;
    public ?string $grade = null;
    public ?string $availability = null;

    public bool $is_featured = false;
    public bool $is_active = true;
    public int $sort_order = 0;

    public ?string $seo_title = null;
    public ?string $seo_description = null;

    public function mount(?int $productId = null): void
    {
        $this->productId = $productId;

        if (! $productId) {
            return;
        }

        $product = Product::with('translations')->findOrFail($productId);

        $this->category_id = $product->category_id;
        $this->slug = $product->slug;
        $this->sku = $product->sku;
        $this->main_image = $product->main_image;

        $this->country_of_origin = $product->country_of_origin;
        $this->season = $product->season;
        $this->packaging = $product->packaging;
        $this->size = $product->size;
        $this->grade = $product->grade;
        $this->availability = $product->availability;

        $this->is_featured = $product->is_featured;
        $this->is_active = $product->is_active;
        $this->sort_order = $product->sort_order;

        $this->seo_title = $product->seo_title;
        $this->seo_description = $product->seo_description;

        foreach (['en', 'ar', 'nl'] as $locale) {
            $this->translations[$locale]['name'] = $product->translate($locale)?->name ?? '';
            $this->translations[$locale]['short_description'] = $product->translate($locale)?->short_description ?? '';
            $this->translations[$locale]['description'] = $product->translate($locale)?->description ?? '';
        }
    }

    public function updatedTranslationsEnName($value): void
    {
        if (! $this->productId && empty($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    public function save()
    {
        $this->validate([
            'category_id' => ['required', 'exists:categories,id'],

            'translations.en.name' => ['required', 'string', 'max:190'],
            'translations.ar.name' => ['nullable', 'string', 'max:190'],
            'translations.nl.name' => ['nullable', 'string', 'max:190'],

            'translations.en.short_description' => ['nullable', 'string', 'max:500'],
            'translations.ar.short_description' => ['nullable', 'string', 'max:500'],
            'translations.nl.short_description' => ['nullable', 'string', 'max:500'],

            'translations.en.description' => ['nullable', 'string'],
            'translations.ar.description' => ['nullable', 'string'],
            'translations.nl.description' => ['nullable', 'string'],

            'slug' => ['required', 'string', 'max:190', 'unique:products,slug,' . $this->productId],
            'sku' => ['nullable', 'string', 'max:190', 'unique:products,sku,' . $this->productId],

            'newImage' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            'country_of_origin' => ['nullable', 'string', 'max:190'],
            'season' => ['nullable', 'string', 'max:190'],
            'packaging' => ['nullable', 'string', 'max:190'],
            'size' => ['nullable', 'string', 'max:190'],
            'grade' => ['nullable', 'string', 'max:190'],
            'availability' => ['nullable', 'string', 'max:190'],

            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],

            'seo_title' => ['nullable', 'string', 'max:190'],
            'seo_description' => ['nullable', 'string', 'max:500'],
        ]);

        if ($this->newImage) {
            $this->main_image = 'storage/' . $this->newImage->store('products', 'public');
        }

        $product = Product::updateOrCreate(
            ['id' => $this->productId],
            [
                'category_id' => $this->category_id,
                'slug' => $this->slug,
                'sku' => $this->sku,
                'main_image' => $this->main_image,

                'country_of_origin' => $this->country_of_origin,
                'season' => $this->season,
                'packaging' => $this->packaging,
                'size' => $this->size,
                'grade' => $this->grade,
                'availability' => $this->availability,

                'is_featured' => $this->is_featured,
                'is_active' => $this->is_active,
                'sort_order' => $this->sort_order,

                'seo_title' => $this->seo_title,
                'seo_description' => $this->seo_description,

                'en' => $this->translations['en'],
                'ar' => $this->translations['ar'],
                'nl' => $this->translations['nl'],
            ]
        );

        $this->productId = $product->id;
        $this->reset('newImage');

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        $categories = Category::query()
            ->with('translations')
            ->active()
            ->ordered()
            ->get();

        return view('livewire.admin.products.product-form', [
            'categories' => $categories,
        ]);
    }
}