@extends('site.layouts.app')

@section('title', __('site.request_quote'))

@section('content')
    <section class="quote-page-section">
        <div class="container">
            {{-- <div class="quote-page-hero">
                <div>
                    <span class="section-kicker">{{ __('site.request_quote') }}</span>
                    <h1>{{ __('site.quote_page_title') }}</h1>
                    <p>{{ __('site.quote_page_subtitle') }}</p>
                </div>
            </div> --}}

            <div class="row g-5 align-items-start">
                <div class="col-lg-8">
                    <livewire:site.quote-requests.quote-request-form :selected-product-id="$selectedProduct?->id" />
                </div>

                <div class="col-lg-4">
                    <aside class="quote-side-card">
                        <h3>{{ __('site.quote_side_title') }}</h3>
                        <p>{{ __('site.quote_side_text') }}</p>

                        <div class="quote-side-list">
                            <div>
                                <i class="bi bi-check2-circle"></i>
                                <span>{{ __('site.quote_side_point_1') }}</span>
                            </div>

                            <div>
                                <i class="bi bi-check2-circle"></i>
                                <span>{{ __('site.quote_side_point_2') }}</span>
                            </div>

                            <div>
                                <i class="bi bi-check2-circle"></i>
                                <span>{{ __('site.quote_side_point_3') }}</span>
                            </div>
                        </div>

                        @if(setting('site_whatsapp'))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('site_whatsapp')) }}" target="_blank" class="quote-whatsapp-btn">
                                <i class="bi bi-whatsapp"></i>
                                {{ __('site.contact_whatsapp') }}
                            </a>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection