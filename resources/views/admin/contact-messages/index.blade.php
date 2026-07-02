@extends('admin.layouts.app')

@section('title', __('admin.contact_messages'))
@section('page_title', __('admin.contact_messages'))

@section('content')
    <livewire:admin.contact-messages.contact-message-table />
@endsection