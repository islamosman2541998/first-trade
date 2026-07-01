@extends('admin.layouts.app')

@section('title', __('admin.dashboard'))
@section('page_title', __('admin.dashboard'))

@section('content')
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card admin-card">
                <div class="card-body">
                    <small class="text-muted">{{ __('admin.categories') }}</small>
                    <h3>{{ $categoriesCount }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card admin-card">
                <div class="card-body">
                    <small class="text-muted">{{ __('admin.products') }}</small>
                    <h3>{{ $productsCount }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card admin-card">
                <div class="card-body">
                    <small class="text-muted">{{ __('admin.contact_messages') }}</small>
                    <h3>{{ $contactMessagesCount }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card admin-card">
                <div class="card-body">
                    <small class="text-muted">{{ __('admin.quote_requests') }}</small>
                    <h3>{{ $quoteRequestsCount }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection