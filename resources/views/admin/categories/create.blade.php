@extends('admin.layouts.app')

@section('title', __('admin.add_category'))
@section('page_title', __('admin.add_category'))

@section('content')
    <livewire:admin.categories.category-form />
@endsection