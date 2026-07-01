@extends('admin.layouts.app')

@section('title', __('admin.settings'))
@section('page_title', __('admin.settings'))

@section('content')
    <livewire:admin.settings.settings-form />
@endsection