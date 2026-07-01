@extends('site.layouts.app')

@section('title', $category->name)

@section('content')
    <section class="py-5">
        <div class="container">
            <h1>{{ $category->name }}</h1>
            <p>{{ $category->description }}</p>

            @if($category->activeChildren->count())
                <div class="mb-4 d-flex flex-wrap gap-2">
                    @foreach($category->activeChildren as $child)
                        <a href="{{ route('site.categories.show', $child->slug) }}" class="btn btn-sm btn-outline-success">
                            {{ $child->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <h2 class="h4 mb-3">Products</h2>

            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <small class="text-muted">{{ $product->category?->name }}</small>
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