<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\QuoteRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;

Route::get('/locale/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['ar', 'en', 'nl']), 404);

    session()->put('locale', $locale);
    session()->save();

    return redirect()->back();
})->name('locale.switch');
Route::get('/', HomeController::class)->name('site.home');

Route::get('/about', AboutController::class)->name('site.about');

Route::get('/categories', [CategoryController::class, 'index'])->name('site.categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('site.categories.show');

Route::get('/products', [ProductController::class, 'index'])->name('site.products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('site.products.show');

Route::get('/contact', [ContactController::class, 'index'])->name('site.contact');

Route::get('/request-quote', [QuoteRequestController::class, 'create'])->name('site.quote.create');



Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
    Route::get('/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
    Route::get('/sliders/{slider}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
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
