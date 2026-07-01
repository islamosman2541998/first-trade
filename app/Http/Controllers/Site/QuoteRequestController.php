<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class QuoteRequestController extends Controller
{
    public function create(): View
    {
        $products = Product::query()
            ->active()
            ->ordered()
            ->get();

        return view('site.quote-request', compact('products'));
    }
}