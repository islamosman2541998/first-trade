@extends('admin.layouts.app')

@section('title', __('admin.sliders'))
@section('page_title', __('admin.sliders'))

@section('content')
    <livewire:admin.sliders.slider-table />
@endsection