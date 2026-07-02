@extends('admin.layouts.app')

@section('title', __('admin.products'))
@section('page_title', __('admin.products'))

@section('content')
    <livewire:admin.products.product-table />
@endsection