@extends('admin.layouts.app')

@section('title', __('admin.add_product'))
@section('page_title', __('admin.add_product'))

@section('content')
    <livewire:admin.products.product-form />
@endsection