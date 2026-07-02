@extends('admin.layouts.app')

@section('title', __('site.home_sections'))
@section('page_title', __('site.home_sections'))

@section('content')
    <livewire:admin.home-sections.home-section-table />
@endsection