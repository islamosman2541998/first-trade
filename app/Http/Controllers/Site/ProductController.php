<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::query()
            ->with('activeChildren')
            ->parents()
            ->active()
            ->ordered()
            ->get();

        $products = Product::query()
            ->with(['category.parent'])
            ->active()
            ->when($request->filled('category'), function ($query) use ($request) {
                $category = Category::query()
                    ->where('slug', $request->string('category'))
                    ->first();

                if ($category) {
                    $categoryIds = collect([$category->id])
                        ->merge($category->children()->pluck('id'))
                        ->unique()
                        ->values()
                        ->toArray();

                    $query->whereIn('category_id', $categoryIds);
                }
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->whereHas('translations', function ($translationQuery) use ($search) {
                    $translationQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%");
                });
            })
            ->ordered()
            ->paginate(12)
            ->withQueryString();

        return view('site.products.index', compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        abort_if(!$product->is_active, 404);

        $product->load(['category.parent', 'images']);

        $relatedProducts = Product::query()
            ->with(['category'])
            ->active()
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->ordered()
            ->limit(4)
            ->get();

        return view('site.products.show', compact('product', 'relatedProducts'));
    }
}