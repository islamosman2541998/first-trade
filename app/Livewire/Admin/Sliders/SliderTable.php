<?php

namespace App\Livewire\Admin\Sliders;

use App\Exports\SlidersExport;
use App\Models\Slider;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SliderTable extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';
    public string $status = '';
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
        $this->reset(['search', 'status', 'selected', 'selectAll']);
        $this->resetPage();
    }

    public function toggleActive(int $id): void
    {
        $slider = Slider::findOrFail($id);

        $slider->update([
            'is_active' => ! $slider->is_active,
        ]);

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function confirmDelete(int $id): void
    {
        $this->dispatch('confirm-delete',
            callback: 'delete-slider',
            payload: ['sliderId' => $id]
        );
    }

    #[On('delete-slider')]
    public function deleteSlider(int $sliderId): void
    {
        Slider::findOrFail($sliderId)->delete();

        $this->dispatch('toastr-success', message: __('admin.deleted_successfully'));
    }

    public function confirmBulkDelete(): void
    {
        if (empty($this->selected)) {
            $this->dispatch('toastr-error', message: 'No records selected.');
            return;
        }

        $this->dispatch('confirm-delete',
            callback: 'bulk-delete-sliders',
            payload: []
        );
    }

    #[On('bulk-delete-sliders')]
    public function bulkDelete(): void
    {
        Slider::whereIn('id', $this->selected)->delete();

        $this->reset(['selected', 'selectAll']);

        $this->dispatch('toastr-success', message: __('admin.deleted_successfully'));
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new SlidersExport(), 'sliders.xlsx');
    }

    private function query()
    {
        return Slider::query()
            ->with('translations')
            ->when($this->search, function ($query) {
                $query->whereHas('translations', function ($translationQuery) {
                    $translationQuery
                        ->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status !== '', function ($query) {
                $query->where('is_active', (bool) $this->status);
            })
            ->ordered();
    }

    public function render()
    {
        return view('livewire.admin.sliders.slider-table', [
            'sliders' => $this->query()->paginate($this->perPage),
        ]);
    }
}