@extends('admin.layouts.app')

@section('title', __('admin.contact_message_details'))
@section('page_title', __('admin.contact_message_details'))

@section('content')
    <div class="card admin-card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center gap-3">
            <div>
                <strong>{{ __('admin.contact_message_details') }}</strong>
                <div class="small text-muted">#{{ $contactMessage->id }}</div>
            </div>

            <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-secondary">
                {{ __('admin.back') }}
            </a>
        </div>

        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.customer_name') }}</span>
                        <strong>{{ $contactMessage->name }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.company') }}</span>
                        <strong>{{ $contactMessage->company ?: '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.phone') }}</span>
                        <strong>{{ $contactMessage->phone ?: '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.email') }}</span>
                        <strong>{{ $contactMessage->email ?: '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.subject') }}</span>
                        <strong>{{ $contactMessage->subject ?: '-' }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.method') }}</span>
                        <strong>
                            {{ $contactMessage->preferred_contact_method ? __('admin.contact_method_' . $contactMessage->preferred_contact_method) : '-' }}
                        </strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.status') }}</span>
                        <strong>{{ __('admin.contact_status_' . $contactMessage->status) }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.date') }}</span>
                        <strong>{{ $contactMessage->created_at->format('Y-m-d H:i') }}</strong>
                    </div>
                </div>

                <div class="col-12">
                    <div class="quote-detail-box">
                        <span>{{ __('admin.message') }}</span>
                        <p class="mb-0">{{ $contactMessage->message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection