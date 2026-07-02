<?php

namespace App\Livewire\Admin\Products;

use App\Exports\ProductsExport;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProductTable extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';
    public string $status = '';
    public string $featured = '';
    public string $category = '';
    public int $perPage = 10;

    public array $selected = [];
    public bool $selectAll = false;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function updatingFeatured(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function updatedSelectAll(bool $value): void
    {
        if (! $value) {
            $this->selected = [];
            return;
        }

        $this->selected = $this->query()
            ->paginate($this->perPage)
            ->pluck('id')
            ->map(fn ($id) => (string) $id)
            ->toArray();
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'status', 'featured', 'category', 'selected', 'selectAll']);
        $this->resetPage();
    }

    public function toggleActive(int $id): void
    {
        $product = Product::findOrFail($id);

        $product->update([
            'is_active' => ! $product->is_active,
        ]);

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function toggleFeatured(int $id): void
    {
        $product = Product::findOrFail($id);

        $product->update([
            'is_featured' => ! $product->is_featured,
        ]);

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function confirmDelete(int $id): void
    {
        $this->dispatch('confirm-delete',
            callback: 'delete-product',
            payload: ['productId' => $id]
        );
    }

    #[On('delete-product')]
    public function deleteProduct(int $productId): void
    {
        Product::findOrFail($productId)->delete();

        $this->dispatch('toastr-success', message: __('admin.deleted_successfully'));
    }

    public function confirmBulkDelete(): void
    {
        if (empty($this->selected)) {
            $this->dispatch('toastr-error', message: 'No records selected.');
            return;
        }

        $this->dispatch('confirm-delete',
            callback: 'bulk-delete-products',
            payload: []
        );
    }

    #[On('bulk-delete-products')]
    public function bulkDelete(): void
    {
        Product::whereIn('id', $this->selected)->delete();

        $this->reset(['selected', 'selectAll']);

        $this->dispatch('toastr-success', message: __('admin.deleted_successfully'));
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new ProductsExport(), 'products.xlsx');
    }

    private function query()
    {
        return Product::query()
            ->with(['translations', 'category.translations'])
            ->when($this->search, function ($query) {
                $query->where('slug', 'like', '%' . $this->search . '%')
                    ->orWhere('sku', 'like', '%' . $this->search . '%')
                    ->orWhereHas('translations', function ($translationQuery) {
                        $translationQuery
                            ->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('short_description', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->status !== '', function ($query) {
                $query->where('is_active', (bool) $this->status);
            })
            ->when($this->featured !== '', function ($query) {
                $query->where('is_featured', (bool) $this->featured);
            })
            ->when($this->category !== '', function ($query) {
                $query->where('category_id', $this->category);
            })
            ->ordered();
    }

    public function render()
    {
        $categories = Category::query()
            ->with('translations')
            ->ordered()
            ->get();

        return view('livewire.admin.products.product-table', [
            'products' => $this->query()->paginate($this->perPage),
            'categories' => $categories,
        ]);
    }
}