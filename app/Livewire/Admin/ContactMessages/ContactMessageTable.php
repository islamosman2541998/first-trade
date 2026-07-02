<?php

namespace App\Livewire\Admin\ContactMessages;

use App\Models\ContactMessage;
use Livewire\Component;
use Livewire\WithPagination;

class ContactMessageTable extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';
    public string $status = '';
    public string $method = '';
    public ?string $dateFrom = null;
    public ?string $dateTo = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function updatingMethod(): void
    {
        $this->resetPage();
    }

    public function updatingDateFrom(): void
    {
        $this->resetPage();
    }

    public function updatingDateTo(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset([
            'search',
            'status',
            'method',
            'dateFrom',
            'dateTo',
        ]);

        $this->resetPage();
    }

    public function updateStatus(int $messageId, string $status): void
    {
        abort_unless(in_array($status, ContactMessage::statuses(), true), 422);

        ContactMessage::where('id', $messageId)->update([
            'status' => $status,
            'read_at' => $status !== ContactMessage::STATUS_NEW ? now() : null,
        ]);

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function deleteMessage(int $messageId): void
    {
        ContactMessage::where('id', $messageId)->delete();

        $this->dispatch('toastr-success', message: __('admin.deleted_successfully'));
    }

    public function render()
    {
        $messages = ContactMessage::query()
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('phone', 'like', '%' . $this->search . '%')
                        ->orWhere('company', 'like', '%' . $this->search . '%')
                        ->orWhere('subject', 'like', '%' . $this->search . '%')
                        ->orWhere('message', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->method !== '', function ($query) {
                $query->where('preferred_contact_method', $this->method);
            })
            ->when($this->dateFrom, function ($query) {
                $query->whereDate('created_at', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function ($query) {
                $query->whereDate('created_at', '<=', $this->dateTo);
            })
            ->latestFirst()
            ->paginate(15);

        return view('livewire.admin.contact-messages.contact-message-table', [
            'messages' => $messages,
            'statuses' => ContactMessage::statuses(),
            'methods' => ContactMessage::contactMethods(),
        ]);
    }
}