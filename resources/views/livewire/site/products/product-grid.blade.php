<div>
    <section class="products-list-section">
        <div class="container">
            <div class="products-filter-card">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-4">
                        <label class="form-label">{{ __('site.search_products') }}</label>

                        <div class="products-search-box">
                            <i class="bi bi-search"></i>

                            <input
                                type="text"
                                wire:model.live.debounce.450ms="search"
                                class="form-control"
                                placeholder="{{ __('site.search_products_placeholder') }}">
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <label class="form-label">{{ __('site.category') }}</label>

                        <select wire:model.live="category" class="form-select">
                            <option value="">{{ __('site.all_categories') }}</option>

                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">
                                    {{ $cat->parent ? $cat->parent->name . ' / ' : '' }}{{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <label class="form-label">{{ __('site.featured') }}</label>

                        <select wire:model.live="featured" class="form-select">
                            <option value="">{{ __('site.all_products') }}</option>
                            <option value="1">{{ __('site.featured') }}</option>
                            <option value="0">{{ __('site.not_featured') }}</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <label class="form-label">{{ __('site.sort_by') }}</label>

                        <select wire:model.live="sort" class="form-select">
                            <option value="latest">{{ __('site.latest') }}</option>
                            <option value="oldest">{{ __('site.oldest') }}</option>
                            <option value="name_asc">{{ __('site.name_az') }}</option>
                            <option value="featured">{{ __('site.featured_first') }}</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <button wire:click="resetFilters" class="btn btn-outline-success w-100 products-reset-btn">
                            {{ __('site.reset_filters') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="products-results-header">
                <div>
                    <span>
                        {{ __('site.showing') }}
                        {{ $products->firstItem() ?? 0 }}
                        -
                        {{ $products->lastItem() ?? 0 }}
                        {{ __('site.of') }}
                        {{ $products->total() }}
                        {{ __('site.products') }}
                    </span>
                </div>

                <div wire:loading class="products-loading">
                    <i class="bi bi-arrow-repeat"></i>
                    {{ __('site.loading') }}
                </div>
            </div>

            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-md-6 col-xl-4" wire:key="site-product-{{ $product->id }}">
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

                            <p>{{ __('site.try_change_filters') }}</p>

                            <button wire:click="resetFilters" class="btn btn-success">
                                {{ __('site.reset_filters') }}
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="products-pagination">
                {{ $products->links() }}
            </div>
        </div>
    </section>
</div>