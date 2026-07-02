@extends('site.layouts.app')

@section('title', __('site.categories'))

@section('content')
    {{-- <section class="categories-hero-section">
        <div class="container">
            <div class="categories-hero-card">
                <span class="categories-kicker">
                    {{ __('site.categories_page_kicker') }}
                </span>

                <h1>
                    {{ __('site.categories_page_title') }}
                </h1>

                <p>
                    {{ __('site.categories_page_subtitle') }}
                </p>
            </div>
        </div>
    </section> --}}

    <section class="categories-list-section">
        <div class="container">
            <div class="categories-section-header">
                <div>
                    <span class="section-kicker">{{ __('site.first_trade') }}</span>
                    <h2 class="section-title mb-0">{{ __('site.browse_categories') }}</h2>
                </div>

                <a href="{{ route('site.products.index') }}" class="categories-view-products-link">
                    {{ __('site.view_all_products') }}
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="row g-4">
                @forelse($categories as $category)
                    <div class="col-md-4">
                        <article class="premium-category-card">
                            <a href="{{ route('site.categories.show', $category->slug) }}" class="premium-category-image">
                                @if($category->image)
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                                @else
                                    <div class="premium-category-placeholder">
                                        <i class="bi bi-grid"></i>
                                    </div>
                                @endif

                                <span class="premium-category-count">
                                    {{ $category->activeChildren->count() }}
                                    {{ __('site.sub_categories') }}
                                </span>
                            </a>

                            <div class="premium-category-body">
                                <h3>
                                    <a href="{{ route('site.categories.show', $category->slug) }}">
                                        {{ $category->name }}
                                    </a>
                                </h3>

                                @if($category->description)
                                    <p>
                                        {{ \Illuminate\Support\Str::limit($category->description, 150) }}
                                    </p>
                                @endif

                                @if($category->activeChildren->count())
                                    <div class="premium-category-children">
                                        @foreach($category->activeChildren as $child)
                                            <a href="{{ route('site.categories.show', $child->slug) }}">
                                                {{ $child->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="premium-category-footer">
                                    <a href="{{ route('site.categories.show', $category->slug) }}" class="btn btn-success">
                                        {{ __('site.view_category') }}
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="categories-empty-state">
                            <i class="bi bi-grid"></i>
                            <h3>{{ __('site.no_categories_found') }}</h3>
                            <p>{{ __('site.no_categories_found_text') }}</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection