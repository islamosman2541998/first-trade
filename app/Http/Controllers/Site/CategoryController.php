<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->with('activeChildren')
            ->parents()
            ->active()
            ->ordered()
            ->get();

        return view('site.categories.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        $category->load(['parent', 'activeChildren']);

        $categoryIds = collect([$category->id])
            ->merge($category->children()->pluck('id'))
            ->unique()
            ->values()
            ->toArray();

        $products = Product::query()
            ->with(['category.parent'])
            ->whereIn('category_id', $categoryIds)
            ->active()
            ->ordered()
            ->paginate(12);

        return view('site.categories.show', compact('category', 'products'));
    }
}