@extends('admin.layouts.app')

@section('title', __('admin.edit_product'))
@section('page_title', __('admin.edit_product'))

@section('content')
    <livewire:admin.products.product-form :product-id="$product->id" />

    <div class="mt-4">
        <livewire:admin.products.product-gallery :product-id="$product->id" />
    </div>
@endsection