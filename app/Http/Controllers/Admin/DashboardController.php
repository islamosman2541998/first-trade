<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $hasCategories = Schema::hasTable('categories');
        $hasProducts = Schema::hasTable('products');
        $hasContactMessages = Schema::hasTable('contact_messages');
        $hasQuoteRequests = Schema::hasTable('quote_requests');

        $months = collect(range(5, 0))->map(function ($monthsAgo) {
            $date = now()->subMonths($monthsAgo)->startOfMonth();

            return [
                'key' => $date->format('Y-m'),
                'label' => $date->translatedFormat('M Y'),
                'year' => $date->year,
                'month' => $date->month,
            ];
        });

        $contactMessagesMonthly = $months->map(function ($month) use ($hasContactMessages) {
            if (! $hasContactMessages) {
                return 0;
            }

            return ContactMessage::query()
                ->whereYear('created_at', $month['year'])
                ->whereMonth('created_at', $month['month'])
                ->count();
        })->values();

        $quoteRequestsMonthly = $months->map(function ($month) use ($hasQuoteRequests) {
            if (! $hasQuoteRequests) {
                return 0;
            }

            return QuoteRequest::query()
                ->whereYear('created_at', $month['year'])
                ->whereMonth('created_at', $month['month'])
                ->count();
        })->values();

        $categoryProductLabels = collect();
        $categoryProductData = collect();

        if ($hasCategories && $hasProducts) {
            $categoryProducts = Category::query()
                ->withCount('products')
                ->having('products_count', '>', 0)
                ->orderByDesc('products_count')
                ->take(8)
                ->get();

            $categoryProductLabels = $categoryProducts->map(fn($category) => $category->name);
            $categoryProductData = $categoryProducts->map(fn($category) => $category->products_count);
        }

        return view('admin.dashboard', [
            'categoriesCount' => $hasCategories ? Category::count() : 0,
            'parentCategoriesCount' => $hasCategories ? Category::whereNull('parent_id')->count() : 0,
            'productsCount' => $hasProducts ? Product::count() : 0,
            'activeProductsCount' => $hasProducts ? Product::where('is_active', true)->count() : 0,
            'featuredProductsCount' => $hasProducts ? Product::where('is_featured', true)->count() : 0,

            'contactMessagesCount' => $hasContactMessages ? ContactMessage::count() : 0,
            'newContactMessagesCount' => $hasContactMessages ? ContactMessage::where('status', ContactMessage::STATUS_NEW)->count() : 0,

            'quoteRequestsCount' => $hasQuoteRequests ? QuoteRequest::count() : 0,
            'newQuoteRequestsCount' => $hasQuoteRequests ? QuoteRequest::where('status', QuoteRequest::STATUS_NEW)->count() : 0,

            'latestContactMessages' => $hasContactMessages
                ? ContactMessage::latest()->take(5)->get()
                : collect(),

            'latestQuoteRequests' => $hasQuoteRequests
                ? QuoteRequest::with(['product.translations'])->latest()->take(5)->get()
                : collect(),

            'chartMonths' => $months->pluck('label')->values(),
            'contactMessagesMonthly' => $contactMessagesMonthly,
            'quoteRequestsMonthly' => $quoteRequestsMonthly,

            'categoryProductLabels' => $categoryProductLabels->values(),
            'categoryProductData' => $categoryProductData->values(),
        ]);
    }
}