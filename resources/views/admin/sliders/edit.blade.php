@extends('admin.layouts.app')

@section('title', __('admin.edit_slider'))
@section('page_title', __('admin.edit_slider'))

@section('content')
    <livewire:admin.sliders.slider-form :slider-id="$slider->id" />
@endsection