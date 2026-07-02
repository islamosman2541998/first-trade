@extends('admin.layouts.app')

@section('title', __('admin.quote_requests'))
@section('page_title', __('admin.quote_requests'))

@section('content')
    <livewire:admin.quote-requests.quote-request-table />
@endsection