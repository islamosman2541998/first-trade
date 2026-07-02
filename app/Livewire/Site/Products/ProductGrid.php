<?php

namespace App\Livewire\Site\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductGrid extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';
    public string $category = '';
    public string $featured = '';
    public string $sort = 'latest';
    public int $perPage = 9;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function updatingFeatured(): void
    {
        $this->resetPage();
    }

    public function updatingSort(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset([
            'search',
            'category',
            'featured',
            'sort',
        ]);

        $this->sort = 'latest';
        $this->resetPage();
    }

    private function productsQuery()
    {
        return Product::query()
            ->with(['translations', 'category.translations'])
            ->where('is_active', true)
            ->when($this->search, function ($query) {
                $query->where('slug', 'like', '%' . $this->search . '%')
                    ->orWhere('sku', 'like', '%' . $this->search . '%')
                    ->orWhereHas('translations', function ($translationQuery) {
                        $translationQuery
                            ->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('short_description', 'like', '%' . $this->search . '%')
                            ->orWhere('description', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->category !== '', function ($query) {
                $query->where('category_id', $this->category);
            })
            ->when($this->featured !== '', function ($query) {
                $query->where('is_featured', (bool) $this->featured);
            })
            ->when($this->sort === 'latest', function ($query) {
                $query->latest();
            })
            ->when($this->sort === 'oldest', function ($query) {
                $query->oldest();
            })
            ->when($this->sort === 'name_asc', function ($query) {
                $query->join('product_translations', function ($join) {
                    $join->on('products.id', '=', 'product_translations.product_id')
                        ->where('product_translations.locale', app()->getLocale());
                })
                ->select('products.*')
                ->orderBy('product_translations.name');
            })
            ->when($this->sort === 'featured', function ($query) {
                $query->orderByDesc('is_featured')->ordered();
            });
    }

    public function render()
    {
        $categories = Category::query()
            ->with('translations')
            ->whereNotNull('parent_id')
            ->active()
            ->ordered()
            ->get();

        $products = $this->productsQuery()
            ->paginate($this->perPage);

        return view('livewire.site.products.product-grid', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}