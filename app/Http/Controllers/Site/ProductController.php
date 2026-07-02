<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
{
    return view('site.products.index');
}

   public function show(Product $product): View
{
    abort_unless($product->is_active, 404);

    $product->load([
        'translations',
        'category.translations',
        'images',
    ]);

    $otherProducts = Product::query()
        ->with(['translations', 'category.translations'])
        ->where('is_active', true)
        ->where('id', '!=', $product->id)
        ->inRandomOrder()
        ->take(4)
        ->get();

    return view('site.products.show', compact('product', 'otherProducts'));
}
}