<?php

namespace App\Livewire\Site\QuoteRequests;

use App\Models\Category;
use App\Models\Product;
use App\Models\QuoteRequest;
use Livewire\Component;
use Livewire\WithFileUploads;

class QuoteRequestForm extends Component
{
    use WithFileUploads;

    public ?int $selectedProductId = null;

    public ?int $product_id = null;
    public ?int $category_id = null;

    public string $name = '';
    public ?string $email = null;
    public string $phone = '';
    public ?string $company = null;
    public ?string $country = null;

    public ?string $product_name = null;
    public ?string $quantity = null;
    public ?string $message = null;

    public $attachment = null;

    public bool $submitted = false;

    public function mount(?int $selectedProductId = null): void
    {
        $this->selectedProductId = $selectedProductId;

        if ($selectedProductId) {
            $product = Product::query()
                ->with(['category'])
                ->active()
                ->find($selectedProductId);

            if ($product) {
                $this->product_id = $product->id;
                $this->category_id = $product->category_id;
                $this->product_name = $product->name;
            }
        }
    }

    public function updatedProductId($value): void
    {
        if (! $value) {
            return;
        }

        $product = Product::query()
            ->with('category')
            ->active()
            ->find($value);

        if ($product) {
            $this->category_id = $product->category_id;
            $this->product_name = $product->name;
        }
    }

    public function submit(): void
    {
        $this->validate([
            'product_id' => ['nullable', 'exists:products,id'],
            'category_id' => ['nullable', 'exists:categories,id'],

            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],

            'product_name' => ['nullable', 'string', 'max:255'],
            'quantity' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string'],

            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,webp', 'max:5120'],
        ], [], [
            'name' => __('site.quote_name'),
            'email' => __('site.quote_email'),
            'phone' => __('site.quote_phone'),
            'company' => __('site.quote_company'),
            'country' => __('site.quote_country'),
            'product_id' => __('site.quote_product'),
            'category_id' => __('site.quote_category'),
            'quantity' => __('site.quote_quantity'),
            'message' => __('site.quote_message'),
            'attachment' => __('site.quote_attachment'),
        ]);

        $attachmentPath = null;

        if ($this->attachment) {
            $attachmentPath = 'storage/' . $this->attachment->store('quote-requests', 'public');
        }

        QuoteRequest::create([
            'product_id' => $this->product_id ?: null,
            'category_id' => $this->category_id ?: null,

            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'country' => $this->country,

            'product_name' => $this->product_name,
            'quantity' => $this->quantity,
            'message' => $this->message,
            'attachment' => $attachmentPath,

            'status' => QuoteRequest::STATUS_NEW,
        ]);

        $this->reset([
            'product_id',
            'category_id',
            'name',
            'email',
            'phone',
            'company',
            'country',
            'product_name',
            'quantity',
            'message',
            'attachment',
        ]);

        $this->submitted = true;
    }

    public function render()
    {
        $categories = Category::query()
            ->with(['translations'])
            ->active()
            ->ordered()
            ->get();

        $products = Product::query()
            ->with(['translations', 'category.translations'])
            ->active()
            ->ordered()
            ->get();

        return view('livewire.site.quote-requests.quote-request-form', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}