@extends('admin.layouts.app')

@section('title', __('site.edit_home_section'))
@section('page_title', __('site.edit_home_section'))

@section('content')
    <livewire:admin.home-sections.home-section-form :section-id="$homeSection->id" />

    <div class="mt-4">
        <livewire:admin.home-sections.home-section-items :section-id="$homeSection->id" />
    </div>
@endsection