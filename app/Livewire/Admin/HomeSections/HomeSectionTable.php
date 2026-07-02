<?php

namespace App\Livewire\Admin\HomeSections;

use App\Models\HomeSection;
use Livewire\Component;
use Livewire\WithPagination;

class HomeSectionTable extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';
    public string $status = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function toggleStatus(int $sectionId): void
    {
        $section = HomeSection::findOrFail($sectionId);

        $section->update([
            'is_active' => ! $section->is_active,
        ]);

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function updateSortOrder(int $sectionId, int $sortOrder): void
    {
        HomeSection::where('id', $sectionId)->update([
            'sort_order' => max(0, $sortOrder),
        ]);

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function render()
    {
        $sections = HomeSection::query()
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('key', 'like', '%' . $this->search . '%')
                        ->orWhere('title_en', 'like', '%' . $this->search . '%')
                        ->orWhere('title_ar', 'like', '%' . $this->search . '%')
                        ->orWhere('title_nl', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status !== '', function ($query) {
                $query->where('is_active', (bool) $this->status);
            })
            ->ordered()
            ->paginate(15);

        return view('livewire.admin.home-sections.home-section-table', [
            'sections' => $sections,
        ]);
    }
}