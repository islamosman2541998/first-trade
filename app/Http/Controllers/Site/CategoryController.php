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
            ->with(['translations', 'activeChildren.translations'])
            // ->parents()
            ->active()
            ->ordered()
            ->get();

        return view('site.categories.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        abort_unless($category->is_active, 404);

        $category->load([
            'translations',
            'parent.translations',
            'activeChildren.translations',
        ]);

        $categoryIds = collect([$category->id])
            ->merge($category->children()->active()->pluck('id'))
            ->unique()
            ->values()
            ->toArray();

        $products = Product::query()
            ->with(['translations', 'category.translations'])
            ->whereIn('category_id', $categoryIds)
            ->active()
            ->ordered()
            ->paginate(12);

        $otherCategories = Category::query()
            ->with(['translations'])
            ->parents()
            ->active()
            ->where('id', '!=', $category->id)
            ->ordered()
            ->take(4)
            ->get();

        return view('site.categories.show', compact(
            'category',
            'products',
            'otherCategories'
        ));
    }
}