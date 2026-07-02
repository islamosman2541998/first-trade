@extends('site.layouts.app')

@section('title', $category->name)

@section('content')
    <section class="category-show-hero-section">
        <div class="container">
            <div class="category-show-hero-card">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        @if($category->parent)
                            <span class="category-parent-pill">
                                {{ $category->parent->name }}
                            </span>
                        @else
                            <span class="category-parent-pill">
                                {{ __('site.main_category') }}
                            </span>
                        @endif

                        <h1>
                            {{ $category->name }}
                        </h1>

                        @if($category->description)
                            <p>
                                {{ $category->description }}
                            </p>
                        @endif

                        <div class="category-show-actions">
                            <a href="#category-products" class="btn btn-success px-4 py-3">
                                {{ __('site.view_products') }}
                            </a>

                            <a href="{{ route('site.categories.index') }}" class="btn btn-outline-success px-4 py-3">
                                {{ __('site.all_categories') }}
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="category-show-image">
                            @if($category->image)
                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                            @else
                                <div class="category-show-placeholder">
                                    <i class="bi bi-grid"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($category->activeChildren->count())
                <div class="category-child-filter-card">
                    <div class="category-child-filter-title">
                        {{ __('site.sub_categories') }}
                    </div>

                    <div class="category-child-filter-links">
                        @foreach($category->activeChildren as $child)
                            <a href="{{ route('site.categories.show', $child->slug) }}">
                                {{ $child->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="category-products-section" id="category-products">
        <div class="container">
            <div class="categories-section-header">
                <div>
                    <span class="section-kicker">{{ __('site.products') }}</span>
                    <h2 class="section-title mb-0">
                        {{ __('site.products_in_category') }}
                    </h2>
                </div>

                <span class="category-products-count">
                    {{ $products->total() }}
                    {{ __('site.products') }}
                </span>
            </div>

            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-md-6 col-xl-4">
                        <article class="premium-product-card">
                            <a href="{{ route('site.products.show', $product->slug) }}" class="premium-product-image">
                                <img
                                    src="{{ $product->main_image ? asset($product->main_image) : 'https://placehold.co/900x700?text=Product' }}"
                                    alt="{{ $product->name }}">

                                @if($product->is_featured)
                                    <span class="premium-product-badge">
                                        {{ __('site.featured') }}
                                    </span>
                                @endif
                            </a>

                            <div class="premium-product-body">
                                @if($product->category)
                                    <a href="{{ route('site.categories.show', $product->category->slug) }}" class="premium-product-category">
                                        {{ $product->category->name }}
                                    </a>
                                @endif

                                <h3>
                                    <a href="{{ route('site.products.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>

                                @if($product->short_description)
                                    <p>
                                        {{ \Illuminate\Support\Str::limit($product->short_description, 115) }}
                                    </p>
                                @endif

                                <div class="premium-product-meta">
                                    @if($product->country_of_origin)
                                        <span>
                                            <i class="bi bi-geo-alt"></i>
                                            {{ $product->country_of_origin }}
                                        </span>
                                    @endif

                                    @if($product->season)
                                        <span>
                                            <i class="bi bi-calendar3"></i>
                                            {{ $product->season }}
                                        </span>
                                    @endif
                                </div>

                                <div class="premium-product-footer">
                                    <a href="{{ route('site.products.show', $product->slug) }}" class="btn btn-success">
                                        {{ __('site.view_details') }}
                                    </a>

                                    <a href="{{ route('site.quote.create', ['product' => $product->slug]) }}" class="premium-quote-link">
                                        {{ __('site.request_quote') }}
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="products-empty-state">
                            <i class="bi bi-box-seam"></i>
                            <h3>{{ __('site.no_products_found') }}</h3>
                            <p>{{ __('site.no_products_in_category') }}</p>

                            <a href="{{ route('site.products.index') }}" class="btn btn-success">
                                {{ __('site.view_all_products') }}
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="products-pagination">
                {{ $products->links() }}
            </div>
        </div>
    </section>

    @if($otherCategories->count())
        <section class="other-categories-section">
            <div class="container">
                <div class="categories-section-header">
                    <div>
                        <span class="section-kicker">{{ __('site.first_trade') }}</span>
                        <h2 class="section-title mb-0">
                            {{ __('site.other_categories') }}
                        </h2>
                    </div>

                    <a href="{{ route('site.categories.index') }}" class="categories-view-products-link">
                        {{ __('site.view_all_categories') }}
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="row g-4">
                    @foreach($otherCategories as $item)
                        <div class="col-md-6 col-lg-3">
                            <article class="mini-category-card">
                                <a href="{{ route('site.categories.show', $item->slug) }}" class="mini-category-image">
                                    @if($item->image)
                                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                                    @else
                                        <div class="mini-category-placeholder">
                                            <i class="bi bi-grid"></i>
                                        </div>
                                    @endif
                                </a>

                                <div class="mini-category-body">
                                    <h3>
                                        <a href="{{ route('site.categories.show', $item->slug) }}">
                                            {{ $item->name }}
                                        </a>
                                    </h3>

                                    @if($item->description)
                                        <p>
                                            {{ \Illuminate\Support\Str::limit($item->description, 70) }}
                                        </p>
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection