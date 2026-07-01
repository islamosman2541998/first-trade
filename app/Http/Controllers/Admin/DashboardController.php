<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'categoriesCount' => Schema::hasTable('categories') ? Category::count() : 0,
            'productsCount' => Schema::hasTable('products') ? Product::count() : 0,
            'contactMessagesCount' => Schema::hasTable('contact_messages') ? \App\Models\ContactMessage::count() : 0,
            'quoteRequestsCount' => Schema::hasTable('quote_requests') ? \App\Models\QuoteRequest::count() : 0,
        ]);
    }
}