<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\View\View;

class QuoteRequestController extends Controller
{
    public function index(): View
    {
        return view('admin.quote-requests.index');
    }

    public function show(QuoteRequest $quoteRequest): View
    {
        if ($quoteRequest->isUnread()) {
            $quoteRequest->update([
                'read_at' => now(),
            ]);
        }

        $quoteRequest->load([
            'product.translations',
            'category.translations',
        ]);

        return view('admin.quote-requests.show', compact('quoteRequest'));
    }
}