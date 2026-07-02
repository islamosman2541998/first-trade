@extends('site.layouts.app')

@section('title', __('site.contact'))

@section('content')
    <section class="contact-page-section">
        <div class="container">
            {{-- <div class="contact-page-hero">
                <div>
                    <span class="section-kicker">{{ __('site.contact') }}</span>
                    <h1>{{ __('site.contact_page_title') }}</h1>
                    <p>{{ __('site.contact_page_subtitle') }}</p>
                </div>
            </div> --}}

            <div class="row g-5 align-items-start">
                <div class="col-lg-8">
                    <livewire:site.contact-messages.contact-form />
                </div>

                <div class="col-lg-4">
                    <aside class="contact-side-card">
                        <h3>{{ __('site.contact_info') }}</h3>
                        <p>{{ __('site.contact_side_text') }}</p>

                        <div class="contact-info-list">
                            @if(setting('site_email'))
                                <a href="mailto:{{ setting('site_email') }}">
                                    <span><i class="bi bi-envelope"></i></span>
                                    <div>
                                        <small>{{ __('site.contact_email') }}</small>
                                        <strong>{{ setting('site_email') }}</strong>
                                    </div>
                                </a>
                            @endif

                            @if(setting('site_phone'))
                                <a href="tel:{{ setting('site_phone') }}">
                                    <span><i class="bi bi-telephone"></i></span>
                                    <div>
                                        <small>{{ __('site.contact_phone') }}</small>
                                        <strong>{{ setting('site_phone') }}</strong>
                                    </div>
                                </a>
                            @endif

                            @if(setting('site_whatsapp'))
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('site_whatsapp')) }}" target="_blank">
                                    <span><i class="bi bi-whatsapp"></i></span>
                                    <div>
                                        <small>WhatsApp</small>
                                        <strong>{{ setting('site_whatsapp') }}</strong>
                                    </div>
                                </a>
                            @endif

                            @php
                                $address = setting('site_address_' . app()->getLocale(), setting('site_address_en'));
                            @endphp

                            @if($address)
                                <div class="contact-info-address">
                                    <span><i class="bi bi-geo-alt"></i></span>
                                    <div>
                                        <small>{{ __('site.address') }}</small>
                                        <strong>{{ $address }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="contact-social-box">
                            <h4>{{ __('site.follow_us') }}</h4>

                            <div class="contact-social-links">
                                @if(setting('facebook_url'))
                                    <a href="{{ setting('facebook_url') }}" target="_blank"><i class="bi bi-facebook"></i></a>
                                @endif

                                @if(setting('instagram_url'))
                                    <a href="{{ setting('instagram_url') }}" target="_blank"><i class="bi bi-instagram"></i></a>
                                @endif

                                @if(setting('linkedin_url'))
                                    <a href="{{ setting('linkedin_url') }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                                @endif

                                @if(setting('youtube_url'))
                                    <a href="{{ setting('youtube_url') }}" target="_blank"><i class="bi bi-youtube"></i></a>
                                @endif

                                @if(setting('tiktok_url'))
                                    <a href="{{ setting('tiktok_url') }}" target="_blank"><i class="bi bi-tiktok"></i></a>
                                @endif
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection