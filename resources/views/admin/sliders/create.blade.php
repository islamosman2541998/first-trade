@extends('admin.layouts.app')

@section('title', __('admin.add_slider'))
@section('page_title', __('admin.add_slider'))

@section('content')
    <livewire:admin.sliders.slider-form />
@endsection