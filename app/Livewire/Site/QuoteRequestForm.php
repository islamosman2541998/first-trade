<?php

namespace App\Livewire\Site;

use App\Models\Product;
use App\Models\QuoteRequest;
use Livewire\Component;

class QuoteRequestForm extends Component
{
    public ?int $product_id = null;

    public string $name = '';
    public ?string $company = null;
    public ?string $country = null;
    public string $email = '';
    public string $phone = '';
    public ?string $quantity = null;
    public ?string $message = null;

    public function mount(?int $product = null): void
    {
        $this->product_id = $product;
    }

    public function submit(): void
    {
        $validated = $this->validate([
            'product_id' => ['nullable', 'exists:products,id'],
            'name' => ['required', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:190'],
            'country' => ['nullable', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:50'],
            'quantity' => ['nullable', 'string', 'max:120'],
            'message' => ['nullable', 'string', 'max:3000'],
        ]);

        QuoteRequest::create($validated);

        $this->reset([
            'product_id',
            'name',
            'company',
            'country',
            'email',
            'phone',
            'quantity',
            'message',
        ]);

        $this->dispatch('toastr-success', message: 'Your quote request has been sent successfully.');
    }

    public function render()
    {
        return view('livewire.site.quote-request-form', [
            'products' => Product::query()
                ->active()
                ->with('translations')
                ->ordered()
                ->get(),
        ]);
    }
}