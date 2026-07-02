@extends('site.layouts.app')

@section('title', $product->name)

@section('content')
    <section class="product-show-section">
        <div class="container">
            <div class="product-show-card">
                <div class="row g-5 align-items-start">
                    <div class="col-lg-6">
                        <livewire:site.products.product-gallery-viewer :product="$product" />
                    </div>

                    <div class="col-lg-6">
                        <div class="product-details-panel">
                            @if($product->category)
                                <span class="product-category-pill">
                                    {{ $product->category->name }}
                                </span>
                            @endif

                            <h1 class="product-show-title">
                                {{ $product->name }}
                            </h1>

                            @if($product->short_description)
                                <p class="product-show-lead">
                                    {{ $product->short_description }}
                                </p>
                            @endif

                            @if($product->description)
                                <div class="product-show-description">
                                    {!! nl2br(e($product->description)) !!}
                                </div>
                            @endif

                            <div class="product-specs-grid">
                                <div class="product-spec-card">
                                    <span>{{ __('site.country_of_origin') }}</span>
                                    <strong>{{ $product->country_of_origin ?: '-' }}</strong>
                                </div>

                                <div class="product-spec-card">
                                    <span>{{ __('site.season') }}</span>
                                    <strong>{{ $product->season ?: '-' }}</strong>
                                </div>

                                <div class="product-spec-card">
                                    <span>{{ __('site.packaging') }}</span>
                                    <strong>{{ $product->packaging ?: '-' }}</strong>
                                </div>

                                <div class="product-spec-card">
                                    <span>{{ __('site.size') }}</span>
                                    <strong>{{ $product->size ?: '-' }}</strong>
                                </div>

                                <div class="product-spec-card">
                                    <span>{{ __('site.grade') }}</span>
                                    <strong>{{ $product->grade ?: '-' }}</strong>
                                </div>

                                <div class="product-spec-card">
                                    <span>{{ __('site.availability') }}</span>
                                    <strong>{{ $product->availability ?: '-' }}</strong>
                                </div>
                            </div>

                            <div class="product-actions">
                                <a href="{{ route('site.quote.create', ['product' => $product->slug]) }}" class="btn btn-success px-4 py-3">
                                    {{ __('site.request_quote') }}
                                </a>

                                <a href="{{ route('site.products.index') }}" class="btn btn-outline-success px-4 py-3">
                                    {{ __('site.products') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($otherProducts->count())
        <section class="other-products-section">
            <div class="container">
                <div class="other-products-header">
                    <div>
                        <span class="section-kicker">{{ __('site.first_trade') }}</span>
                        <h2 class="section-title mb-0">
                            {{ __('site.other_products') }}
                        </h2>
                    </div>

                    <a href="{{ route('site.products.index') }}" class="other-products-link">
                        {{ __('site.view_all_products') }}
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="row g-4">
                    @foreach($otherProducts as $item)
                        <div class="col-md-6 col-lg-3">
                            <article class="other-product-card">
                                <a href="{{ route('site.products.show', $item->slug) }}" class="other-product-image">
                                    <img
                                        src="{{ $item->main_image ? asset($item->main_image) : 'https://placehold.co/700x600?text=Product' }}"
                                        alt="{{ $item->name }}">

                                    @if($item->is_featured)
                                        <span class="other-product-badge">
                                            {{ __('site.featured') }}
                                        </span>
                                    @endif
                                </a>

                                <div class="other-product-body">
                                    @if($item->category)
                                        <span class="other-product-category">
                                            {{ $item->category->name }}
                                        </span>
                                    @endif

                                    <h3>
                                        <a href="{{ route('site.products.show', $item->slug) }}">
                                            {{ $item->name }}
                                        </a>
                                    </h3>

                                    @if($item->short_description)
                                        <p>
                                            {{ \Illuminate\Support\Str::limit($item->short_description, 75) }}
                                        </p>
                                    @endif

                                    <a href="{{ route('site.products.show', $item->slug) }}" class="btn btn-sm btn-success">
                                        {{ __('site.view_details') }}
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection