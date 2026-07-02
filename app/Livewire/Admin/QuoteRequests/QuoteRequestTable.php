<?php

namespace App\Livewire\Admin\QuoteRequests;

use App\Models\QuoteRequest;
use Livewire\Component;
use Livewire\WithPagination;

class QuoteRequestTable extends Component
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

    public function updateStatus(int $requestId, string $status): void
    {
        abort_unless(in_array($status, QuoteRequest::statuses(), true), 422);

        QuoteRequest::where('id', $requestId)->update([
            'status' => $status,
        ]);

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function deleteRequest(int $requestId): void
    {
        QuoteRequest::where('id', $requestId)->delete();

        $this->dispatch('toastr-success', message: __('admin.deleted_successfully'));
    }

    public function render()
    {
        $quoteRequests = QuoteRequest::query()
            ->with(['product.translations', 'category.translations'])
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('phone', 'like', '%' . $this->search . '%')
                        ->orWhere('company', 'like', '%' . $this->search . '%')
                        ->orWhere('country', 'like', '%' . $this->search . '%')
                        ->orWhere('product_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->latestFirst()
            ->paginate(15);

        return view('livewire.admin.quote-requests.quote-request-table', [
            'quoteRequests' => $quoteRequests,
            'statuses' => QuoteRequest::statuses(),
        ]);
    }
}