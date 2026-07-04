@extends('admin.layouts.app')

@section('title', __('admin.about_page'))
@section('page_title', __('admin.about_page'))

@section('content')
    <livewire:admin.about-page.about-page-form />
@endsection