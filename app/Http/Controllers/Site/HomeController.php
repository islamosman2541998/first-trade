<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

        $parentCategories = Category::query()
            ->with('activeChildren')
            ->parents()
            ->active()
            ->ordered()
            ->get();

        $featuredProducts = Product::query()
            ->with(['category.parent'])
            ->active()
            ->featured()
            ->ordered()
            ->limit(6)
            ->get();

        return view('site.home', compact(
            'sliders',
            'parentCategories',
            'featuredProducts'
        ));
    }
}