@extends('admin.layouts.app')

@section('title', __('admin.categories'))
@section('page_title', __('admin.categories'))

@section('content')
    <livewire:admin.categories.category-table />
@endsection