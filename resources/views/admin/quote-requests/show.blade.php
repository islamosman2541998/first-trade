@extends('admin.layouts.app')

@section('title', __('admin.quote_request_details'))
@section('page_title', __('admin.quote_request_details'))

@section('content')
    <div class="card admin-card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center gap-3">
            <div>
                <strong>{{ __('admin.quote_request_details') }}</strong>
                <div class="small text-muted">#{{ $quoteRequest->id }}</div>
            </div>

            <a href="{{ route('admin.quote-requests.index') }}" class="btn btn-outline-secondary">
                {{ __('admin.back') }}
            </a>
        </div>

        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.customer_name') }}</span>
                        <strong>{{ $quoteRequest->name }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.company') }}</span>
                        <strong>{{ $quoteRequest->company ?: '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.phone') }}</span>
                        <strong>{{ $quoteRequest->phone }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.email') }}</span>
                        <strong>{{ $quoteRequest->email ?: '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.country') }}</span>
                        <strong>{{ $quoteRequest->country ?: '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.status') }}</span>
                        <strong>{{ __('admin.quote_status_' . $quoteRequest->status) }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.product') }}</span>
                        <strong>{{ $quoteRequest->product?->name ?: ($quoteRequest->product_name ?: '-') }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.category') }}</span>
                        <strong>{{ $quoteRequest->category?->name ?: '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.quantity') }}</span>
                        <strong>{{ $quoteRequest->quantity ?: '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.date') }}</span>
                        <strong>{{ $quoteRequest->created_at->format('Y-m-d H:i') }}</strong>
                    </div>
                </div>

                <div class="col-12">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.message') }}</span>
                        <p class="mb-0">{{ $quoteRequest->message ?: '-' }}</p>
                    </div>
                </div>

                @if($quoteRequest->attachment)
                    <div class="col-12">
                        <a href="{{ asset($quoteRequest->attachment) }}" target="_blank" class="btn btn-admin-primary">
                            <i class="bi bi-paperclip"></i>
                            {{ __('admin.view_attachment') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection