<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\CategoryController as SiteCategoryController;
use App\Http\Controllers\Site\ProductController as SiteProductController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\QuoteRequestController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\QuoteRequestController as AdminQuoteRequestController;
use App\Http\Controllers\Admin\HomeSectionController;
use App\Http\Controllers\Admin\ContactMessageController;

use Illuminate\Support\Facades\Route;

Route::get('/locale/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['ar', 'en', 'nl']), 404);

    session()->put('locale', $locale);
    session()->save();

    return redirect()->back();
})->name('locale.switch');

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
*/
Route::get('/', HomeController::class)->name('site.home');

Route::get('/about', AboutController::class)->name('site.about');

Route::get('/categories', [SiteCategoryController::class, 'index'])->name('site.categories.index');
Route::get('/categories/{category:slug}', [SiteCategoryController::class, 'show'])->name('site.categories.show');

Route::get('/products', [SiteProductController::class, 'index'])->name('site.products.index');
Route::get('/products/{product:slug}', [SiteProductController::class, 'show'])->name('site.products.show');

Route::get('/contact', [ContactController::class, 'index'])->name('site.contact');

Route::get('/request-quote', [QuoteRequestController::class, 'create'])->name('site.quote.create');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');

        Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
        Route::get('/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
        Route::get('/sliders/{slider}/edit', [SliderController::class, 'edit'])->name('sliders.edit');

        Route::get('/home-sections', [HomeSectionController::class, 'index'])->name('home-sections.index');
        Route::get('/home-sections/{homeSection}/edit', [HomeSectionController::class, 'edit'])->name('home-sections.edit');

        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
        Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');

        Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
        Route::get('/quote-requests', [AdminQuoteRequestController::class, 'index'])->name('quote-requests.index');
Route::get('/quote-requests/{quoteRequest}', [AdminQuoteRequestController::class, 'show'])->name('quote-requests.show');
Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
Route::get('/contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
    });

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';