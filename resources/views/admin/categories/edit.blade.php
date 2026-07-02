@extends('admin.layouts.app')

@section('title', __('admin.edit_category'))
@section('page_title', __('admin.edit_category'))

@section('content')
    <livewire:admin.categories.category-form :category-id="$category->id" />
@endsection