<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductImage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductGallery extends Component
{
    use WithFileUploads;

    public int $productId;

    public $images = [];

    public function mount(int $productId): void
    {
        $this->productId = $productId;
    }

    public function uploadImages(): void
    {
        $this->validate([
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $lastSortOrder = ProductImage::where('product_id', $this->productId)
            ->max('sort_order') ?? 0;

        foreach ($this->images as $image) {
            $path = 'storage/' . $image->store('products/gallery', 'public');

            ProductImage::create([
                'product_id' => $this->productId,
                'image' => $path,
                'sort_order' => ++$lastSortOrder,
            ]);
        }

        $this->reset('images');

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function deleteImage(int $imageId): void
    {
        $image = ProductImage::where('product_id', $this->productId)
            ->findOrFail($imageId);

        $image->delete();

        $this->dispatch('toastr-success', message: __('admin.deleted_successfully'));
    }

    public function updateSortOrder(int $imageId, int $sortOrder): void
    {
        ProductImage::where('product_id', $this->productId)
            ->where('id', $imageId)
            ->update([
                'sort_order' => max(0, $sortOrder),
            ]);

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function setAsMainImage(int $imageId): void
    {
        $galleryImage = ProductImage::where('product_id', $this->productId)
            ->findOrFail($imageId);

        Product::where('id', $this->productId)->update([
            'main_image' => $galleryImage->image,
        ]);

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    public function render()
    {
        $galleryImages = ProductImage::query()
            ->where('product_id', $this->productId)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $product = Product::findOrFail($this->productId);

        return view('livewire.admin.products.product-gallery', [
            'galleryImages' => $galleryImages,
            'product' => $product,
        ]);
    }
}