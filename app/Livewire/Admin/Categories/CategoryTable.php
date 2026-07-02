<?php

namespace App\Livewire\Admin\Categories;

use App\Exports\CategoriesExport;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CategoryTable extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';
    public string $status = '';
    public string $type = '';
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

    public function updatingType(): void
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
        $this->reset(['search', 'status', 'type', 'selected', 'selectAll']);
        $this->resetPage();
    }

    public function toggleActive(int $id): void
    {
        $category = Category::findOrFail($id);

        $category->update([
            'is_active' => ! $category->is_active,
        ]);

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function confirmDelete(int $id): void
    {
        $this->dispatch('confirm-delete',
            callback: 'delete-category',
            payload: ['categoryId' => $id]
        );
    }

    #[On('delete-category')]
    public function deleteCategory(int $categoryId): void
    {
        $category = Category::withCount(['children', 'products'])->findOrFail($categoryId);

        if ($category->children_count > 0 || $category->products_count > 0) {
            $this->dispatch('toastr-error', message: 'Cannot delete category that has children or products.');
            return;
        }

        $category->delete();

        $this->dispatch('toastr-success', message: __('admin.deleted_successfully'));
    }

    public function confirmBulkDelete(): void
    {
        if (empty($this->selected)) {
            $this->dispatch('toastr-error', message: 'No records selected.');
            return;
        }

        $this->dispatch('confirm-delete',
            callback: 'bulk-delete-categories',
            payload: []
        );
    }

    #[On('bulk-delete-categories')]
    public function bulkDelete(): void
    {
        $categories = Category::withCount(['children', 'products'])
            ->whereIn('id', $this->selected)
            ->get();

        $deletableIds = $categories
            ->filter(fn ($category) => $category->children_count === 0 && $category->products_count === 0)
            ->pluck('id');

        if ($deletableIds->isEmpty()) {
            $this->dispatch('toastr-error', message: 'Selected categories cannot be deleted because they have children or products.');
            return;
        }

        Category::whereIn('id', $deletableIds)->delete();

        $this->reset(['selected', 'selectAll']);

        $this->dispatch('toastr-success', message: __('admin.deleted_successfully'));
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new CategoriesExport(), 'categories.xlsx');
    }

    private function query()
    {
        return Category::query()
            ->with(['translations', 'parent.translations'])
            ->when($this->search, function ($query) {
                $query->where('slug', 'like', '%' . $this->search . '%')
                    ->orWhereHas('translations', function ($translationQuery) {
                        $translationQuery
                            ->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('description', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->status !== '', function ($query) {
                $query->where('is_active', (bool) $this->status);
            })
            ->when($this->type === 'parent', function ($query) {
                $query->whereNull('parent_id');
            })
            ->when($this->type === 'child', function ($query) {
                $query->whereNotNull('parent_id');
            })
            ->ordered();
    }

    public function render()
    {
        return view('livewire.admin.categories.category-table', [
            'categories' => $this->query()->paginate($this->perPage),
        ]);
    }
}