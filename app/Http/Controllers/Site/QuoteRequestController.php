<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuoteRequestController extends Controller
{
    public function create(Request $request): View
    {
        $selectedProduct = null;

        if ($request->filled('product')) {
            $selectedProduct = Product::query()
                ->with(['translations', 'category.translations'])
                ->where('slug', $request->query('product'))
                ->active()
                ->first();
        }

        return view('site.quote-requests.create', compact('selectedProduct'));
    }
}