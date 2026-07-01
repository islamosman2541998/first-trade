@extends('site.layouts.app')

@section('title', 'Categories')

@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="mb-4">Categories</h1>

            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3>{{ $category->name }}</h3>
                                <p>{{ $category->description }}</p>

                                @foreach($category->activeChildren as $child)
                                    <a href="{{ route('site.categories.show', $child->slug) }}" class="badge bg-success text-decoration-none">
                                        {{ $child->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection