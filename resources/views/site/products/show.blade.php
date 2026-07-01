@extends('site.layouts.app')

@section('title', $product->name)

@section('content')
    <section class="py-5">
        <div class="container">
            <small class="text-muted">
                {{ $product->category?->parent?->name }}
                @if($product->category?->parent)
                    /
                @endif
                {{ $product->category?->name }}
            </small>

            <h1>{{ $product->name }}</h1>
            <p class="lead">{{ $product->short_description }}</p>

            <div class="row g-4 mt-3">
                <div class="col-md-7">
                    <p>{{ $product->description }}</p>
                </div>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h5>Product Information</h5>

                            <ul class="list-unstyled mb-0">
                                <li><strong>Origin:</strong> {{ $product->country_of_origin ?: '-' }}</li>
                                <li><strong>Season:</strong> {{ $product->season ?: '-' }}</li>
                                <li><strong>Packaging:</strong> {{ $product->packaging ?: '-' }}</li>
                                <li><strong>Size:</strong> {{ $product->size ?: '-' }}</li>
                                <li><strong>Grade:</strong> {{ $product->grade ?: '-' }}</li>
                                <li><strong>Availability:</strong> {{ $product->availability ?: '-' }}</li>
                            </ul>

                            <a href="{{ route('site.quote.create', ['product' => $product->id]) }}" class="btn btn-success w-100 mt-3">
                                Request Quote
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if($relatedProducts->count())
                <hr class="my-5">

                <h2 class="h4 mb-4">Related Products</h2>

                <div class="row g-4">
                    @foreach($relatedProducts as $related)
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5>{{ $related->name }}</h5>
                                    <p>{{ $related->short_description }}</p>

                                    <a href="{{ route('site.products.show', $related->slug) }}" class="btn btn-sm btn-outline-success">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection