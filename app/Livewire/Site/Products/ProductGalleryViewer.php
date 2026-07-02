<?php

namespace App\Livewire\Site\Products;

use App\Models\Product;
use Livewire\Component;

class ProductGalleryViewer extends Component
{
    public Product $product;

    public function mount(Product $product): void
    {
        $this->product = $product->load(['images']);
    }

    public function render()
    {
        $galleryItems = collect();

        if ($this->product->main_image) {
            $galleryItems->push([
                'image' => $this->product->main_image,
                'title' => $this->product->name,
                'label' => __('site.main_image'),
            ]);
        }

        foreach ($this->product->images as $index => $image) {
            if ($image->image !== $this->product->main_image) {
                $galleryItems->push([
                    'image' => $image->image,
                    'title' => $this->product->name,
                    'label' => __('site.gallery_image') . ' ' . ($index + 1),
                ]);
            }
        }

        return view('livewire.site.products.product-gallery-viewer', [
            'galleryItems' => $galleryItems,
        ]);
    }
}