@extends('site.layouts.app')

@section('title', setting('site_name', 'First Trade'))
@section('body_class', 'home-page')

@section('content')
    @include('site.partials.slider')

    @php
        $aboutSection = $homeSections->get('about');
        $statsSection = $homeSections->get('stats');
        $categoriesSection = $homeSections->get('categories');
        $featuredProductsSection = $homeSections->get('featured_products');
        $latestProductsSection = $homeSections->get('latest_products');
        $whySection = $homeSections->get('why_choose_us');
        $processSection = $homeSections->get('export_process');
        $ctaSection = $homeSections->get('cta');
    @endphp

    @if($aboutSection)
        @php
            $aboutImage = $aboutSection->image
                ? asset($aboutSection->image)
                : ($featuredProducts->first()?->main_image
                    ? asset($featuredProducts->first()->main_image)
                    : 'https://placehold.co/900x700?text=Fresh+Produce');
        @endphp

        <section class="home-about-section">
            <div class="container">
                <div class="home-about-card">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6">
                            @if($aboutSection->subtitle())
                                <span class="section-kicker">{{ $aboutSection->subtitle() }}</span>
                            @endif

                            @if($aboutSection->title())
                                <h2 class="home-section-title">
                                    {{ $aboutSection->title() }}
                                </h2>
                            @endif

                            @if($aboutSection->description())
                                <p class="home-section-text">
                                    {{ $aboutSection->description() }}
                                </p>
                            @endif

                            <div class="d-flex flex-wrap gap-3 mt-4">
                                @if($aboutSection->button_link && $aboutSection->buttonText())
                                    <a href="{{ url($aboutSection->button_link) }}" target="{{ $aboutSection->button_target }}" class="btn btn-success px-4 py-3">
                                        {{ $aboutSection->buttonText() }}
                                    </a>
                                @endif

                                <a href="{{ route('site.quote.create') }}" class="btn btn-outline-success px-4 py-3">
                                    {{ __('site.request_quote') }}
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="home-about-visual">
                                <div class="home-about-image main">
                                    <img src="{{ $aboutImage }}" alt="{{ setting('site_name', 'First Trade') }}">
                                </div>

                                <div class="home-about-stat">
                                    <strong>{{ $parentCategories->count() }}+</strong>
                                    <span>{{ __('site.categories') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($statsSection && $statsSection->activeItems->count())
                        <div class="home-stats-grid">
                            @foreach($statsSection->activeItems as $item)
                                <div class="home-stat-card">
                                    <strong>{{ $item->title() }}</strong>
                                    <span>{{ $item->description() }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

   @if($categoriesSection)
    <section class="home-categories-section">
        <div class="container">
            <div class="home-section-header">
                <div>
                    @if($categoriesSection->subtitle())
                        <span class="section-kicker">{{ $categoriesSection->subtitle() }}</span>
                    @endif

                    @if($categoriesSection->title())
                        <h2 class="home-section-title mb-0">{{ $categoriesSection->title() }}</h2>
                    @endif

                    @if($categoriesSection->description())
                        <p class="home-section-text mb-0">{{ $categoriesSection->description() }}</p>
                    @endif
                </div>

                <div class="home-section-actions">
                    @if($categoriesSection->button_link && $categoriesSection->buttonText())
                        <a href="{{ url($categoriesSection->button_link) }}" target="{{ $categoriesSection->button_target }}" class="home-section-link">
                            {{ $categoriesSection->buttonText() }}
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    @endif

                    <div class="home-swiper-arrows">
                        <button type="button" class="home-swiper-btn home-categories-prev">
                            <i class="bi bi-arrow-left"></i>
                        </button>

                        <button type="button" class="home-swiper-btn home-categories-next">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            @if($parentCategories->count())
                <div class="swiper home-categories-swiper">
                    <div class="swiper-wrapper">
                        @foreach($parentCategories as $category)
                            <div class="swiper-slide">
                                <article class="home-category-card">
                                    <a href="{{ route('site.categories.show', $category->slug) }}" class="home-category-image">
                                        @if($category->image)
                                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                                        @else
                                            <div class="home-category-placeholder">
                                                <i class="bi bi-grid"></i>
                                            </div>
                                        @endif

                                        <span>
                                            {{ $category->activeChildren->count() }}
                                            {{ __('site.sub_categories') }}
                                        </span>
                                    </a>

                                    <div class="home-category-body">
                                        <h3>
                                            <a href="{{ route('site.categories.show', $category->slug) }}">
                                                {{ $category->name }}
                                            </a>
                                        </h3>

                                        @if($category->description)
                                            <p>{{ \Illuminate\Support\Str::limit($category->description, 85) }}</p>
                                        @endif
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>

                    <div class="swiper-pagination home-categories-pagination"></div>
                </div>
            @else
                <div class="products-empty-state">
                    <h3>{{ __('site.no_categories_found') }}</h3>
                </div>
            @endif
        </div>
    </section>
@endif

   @if($featuredProductsSection)
    <section class="home-products-section">
        <div class="container">
            <div class="home-section-header">
                <div>
                    @if($featuredProductsSection->subtitle())
                        <span class="section-kicker">{{ $featuredProductsSection->subtitle() }}</span>
                    @endif

                    @if($featuredProductsSection->title())
                        <h2 class="home-section-title mb-0">{{ $featuredProductsSection->title() }}</h2>
                    @endif

                    @if($featuredProductsSection->description())
                        <p class="home-section-text mb-0">{{ $featuredProductsSection->description() }}</p>
                    @endif
                </div>

                <div class="home-section-actions">
                    @if($featuredProductsSection->button_link && $featuredProductsSection->buttonText())
                        <a href="{{ url($featuredProductsSection->button_link) }}" target="{{ $featuredProductsSection->button_target }}" class="home-section-link">
                            {{ $featuredProductsSection->buttonText() }}
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    @endif

                    <div class="home-swiper-arrows">
                        <button type="button" class="home-swiper-btn home-products-prev">
                            <i class="bi bi-arrow-left"></i>
                        </button>

                        <button type="button" class="home-swiper-btn home-products-next">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            @if($featuredProducts->count())
                <div class="swiper home-products-swiper">
                    <div class="swiper-wrapper">
                        @foreach($featuredProducts as $product)
                            <div class="swiper-slide">
                                <article class="premium-product-card">
                                    <a href="{{ route('site.products.show', $product->slug) }}" class="premium-product-image">
                                        <img
                                            src="{{ $product->main_image ? asset($product->main_image) : 'https://placehold.co/900x700?text=Product' }}"
                                            alt="{{ $product->name }}">

                                        <span class="premium-product-badge">
                                            {{ __('site.featured') }}
                                        </span>
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
                                            <p>{{ \Illuminate\Support\Str::limit($product->short_description, 110) }}</p>
                                        @endif

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
                        @endforeach
                    </div>

                    <div class="swiper-pagination home-products-pagination"></div>
                </div>
            @else
                <div class="products-empty-state">
                    <h3>{{ __('site.no_products_found') }}</h3>
                </div>
            @endif
        </div>
    </section>
@endif

    @if($latestProductsSection && $latestProducts->count())
        <section class="home-latest-section">
            <div class="container">
                <div class="home-section-header">
                    <div>
                        @if($latestProductsSection->subtitle())
                            <span class="section-kicker">{{ $latestProductsSection->subtitle() }}</span>
                        @endif

                        @if($latestProductsSection->title())
                            <h2 class="home-section-title mb-0">{{ $latestProductsSection->title() }}</h2>
                        @endif

                        @if($latestProductsSection->description())
                            <p class="home-section-text mb-0">{{ $latestProductsSection->description() }}</p>
                        @endif
                    </div>
                </div>

                <div class="home-latest-grid">
                    @foreach($latestProducts as $product)
                        <article class="home-latest-card">
                            <a href="{{ route('site.products.show', $product->slug) }}" class="home-latest-image">
                                <img
                                    src="{{ $product->main_image ? asset($product->main_image) : 'https://placehold.co/500x500?text=Product' }}"
                                    alt="{{ $product->name }}">
                            </a>

                            <div class="home-latest-body">
                                @if($product->category)
                                    <span>{{ $product->category->name }}</span>
                                @endif

                                <h3>
                                    <a href="{{ route('site.products.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>

                                <a href="{{ route('site.products.show', $product->slug) }}">
                                    {{ __('site.view_details') }}
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($whySection)
        <section class="home-why-section">
            <div class="container">
                <div class="text-center mx-auto home-why-heading">
                    @if($whySection->subtitle())
                        <span class="section-kicker">{{ $whySection->subtitle() }}</span>
                    @endif

                    @if($whySection->title())
                        <h2 class="home-section-title">{{ $whySection->title() }}</h2>
                    @endif
                </div>

                <div class="row g-4">
                    @foreach($whySection->activeItems as $item)
                        <div class="col-md-4">
                            <div class="home-why-card">
                                @if($item->icon)
                                    <div class="home-why-icon">
                                        <i class="{{ $item->icon }}"></i>
                                    </div>
                                @endif

                                <h3>{{ $item->title() }}</h3>
                                <p>{{ $item->description() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($processSection)
        <section class="home-process-section">
            <div class="container">
                <div class="home-process-card">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-5">
                            @if($processSection->subtitle())
                                <span class="section-kicker">{{ $processSection->subtitle() }}</span>
                            @endif

                            @if($processSection->title())
                                <h2 class="home-section-title">{{ $processSection->title() }}</h2>
                            @endif
                        </div>

                        <div class="col-lg-7">
                            <div class="home-process-steps">
                                @foreach($processSection->activeItems as $item)
                                    <div class="home-process-step">
                                        <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                        <div>
                                            <h3>{{ $item->title() }}</h3>
                                            <p>{{ $item->description() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </section>
    @endif

    @if($ctaSection)
        <section class="home-cta-section">
            <div class="container">
                <div class="home-cta-card">
                    @if($ctaSection->title())
                        <h2>{{ $ctaSection->title() }}</h2>
                    @endif

                    @if($ctaSection->description())
                        <p>{{ $ctaSection->description() }}</p>
                    @endif

                    @if($ctaSection->button_link && $ctaSection->buttonText())
                        <a href="{{ url($ctaSection->button_link) }}" target="{{ $ctaSection->button_target }}" class="btn btn-success px-4 py-3">
                            {{ $ctaSection->buttonText() }}
                        </a>
                    @endif
                </div>
            </div>
        </section>
    @endif
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof window.Swiper === 'undefined') {
                return;
            }

            const swiperModules = [
                window.SwiperModules.Navigation,
                window.SwiperModules.Pagination,
                window.SwiperModules.Autoplay,
                window.SwiperModules.FreeMode,
            ].filter(Boolean);

            if (document.querySelector('.home-categories-swiper')) {
                new window.Swiper('.home-categories-swiper', {
                    modules: swiperModules,
                    loop: true,
                    speed: 800,
                    grabCursor: true,
                    spaceBetween: 24,
                    autoplay: {
                        delay: 2600,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    navigation: {
                        nextEl: '.home-categories-next',
                        prevEl: '.home-categories-prev',
                    },
                    pagination: {
                        el: '.home-categories-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1,
                            spaceBetween: 16,
                        },
                        576: {
                            slidesPerView: 1,
                            spaceBetween: 18,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        992: {
                            slidesPerView: 3,
                            spaceBetween: 22,
                        },
                        1200: {
                            slidesPerView: 4,
                            spaceBetween: 24,
                        },
                    },
                });
            }

            if (document.querySelector('.home-products-swiper')) {
                new window.Swiper('.home-products-swiper', {
                    modules: swiperModules,
                    loop: true,
                    speed: 850,
                    grabCursor: true,
                    spaceBetween: 24,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    navigation: {
                        nextEl: '.home-products-next',
                        prevEl: '.home-products-prev',
                    },
                    pagination: {
                        el: '.home-products-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1,
                            spaceBetween: 16,
                        },
                        576: {
                            slidesPerView: 1,
                            spaceBetween: 18,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        992: {
                            slidesPerView: 3,
                            spaceBetween: 22,
                        },
                        1200: {
                            slidesPerView: 3,
                            spaceBetween: 24,
                        },
                    },
                });
            }
        });
    </script>
@endpush
@endsection