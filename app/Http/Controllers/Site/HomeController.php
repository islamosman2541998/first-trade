<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeSection;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $sliders = Slider::query()
            ->with('translations')
            ->active()
            ->ordered()
            ->get();

        $homeSections = HomeSection::query()
            ->with(['activeItems'])
            ->active()
            ->ordered()
            ->get()
            ->keyBy('key');

        $parentCategories = Category::query()
            ->with(['translations', 'activeChildren.translations'])
            ->active()
            ->ordered()
            
            ->get();

        $featuredProducts = Product::query()
            ->with(['translations', 'category.translations'])
            ->active()
            ->featured()
            ->ordered()
            
            ->get();

        $latestProducts = Product::query()
            ->with(['translations', 'category.translations'])
            ->active()
            ->latest()
            ->take(3)
            ->get();

        return view('site.home', compact(
            'sliders',
            'homeSections',
            'parentCategories',
            'featuredProducts',
            'latestProducts'
        ));
    }
}