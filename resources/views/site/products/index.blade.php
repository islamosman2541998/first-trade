@extends('site.layouts.app')

@section('title', 'Products')

@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="mb-4">Products</h1>

            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-5">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search products">
                </div>

                <div class="col-md-5">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>

                        @foreach($categories as $parent)
                            <option value="{{ $parent->slug }}" @selected(request('category') === $parent->slug)>
                                {{ $parent->name }}
                            </option>

                            @foreach($parent->activeChildren as $child)
                                <option value="{{ $child->slug }}" @selected(request('category') === $child->slug)>
                                    — {{ $child->name }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-success w-100">
                        Filter
                    </button>
                </div>
            </form>

            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <small class="text-muted">
                                    {{ $product->category?->parent?->name }}
                                    @if($product->category?->parent)
                                        /
                                    @endif
                                    {{ $product->category?->name }}
                                </small>

                                <h4>{{ $product->name }}</h4>
                                <p>{{ $product->short_description }}</p>

                                <a href="{{ route('site.products.show', $product->slug) }}" class="btn btn-sm btn-success">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No products found.</p>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection