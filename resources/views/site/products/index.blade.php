@extends('site.layouts.app')

@section('title', __('site.products'))

@section('content')
    <livewire:site.products.product-grid />
@endsection