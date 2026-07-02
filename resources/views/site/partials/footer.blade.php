<footer class="site-footer">
    <div class="site-footer-main">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-brand-block">
                        @php
                            $siteLogo = setting('site_logo');
                        @endphp

                        <a href="{{ route('site.home') }}" class="footer-logo">
                            @if($siteLogo)
                                <img src="{{ asset($siteLogo) }}" alt="{{ setting('site_name', 'First Trade') }}">
                            @else
                                <span>{{ setting('site_name', 'First Trade') }}</span>
                            @endif
                        </a>

                        <p>
{{ setting('footer_about_' . app()->getLocale(), __('site.footer_about_text')) }}                        </p>

                        <div class="footer-social-links">
                            @if(setting('facebook_url'))
                                <a href="{{ setting('facebook_url') }}" target="_blank" aria-label="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            @endif

                            @if(setting('instagram_url'))
                                <a href="{{ setting('instagram_url') }}" target="_blank" aria-label="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            @endif

                            @if(setting('linkedin_url'))
                                <a href="{{ setting('linkedin_url') }}" target="_blank" aria-label="LinkedIn">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            @endif

                            @if(setting('whatsapp_url') || setting('site_whatsapp'))
                                <a href="{{ setting('whatsapp_url') ?: 'https://wa.me/' . preg_replace('/[^0-9]/', '', setting('site_whatsapp')) }}" target="_blank" aria-label="WhatsApp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-2">
                    <div class="footer-widget">
                        <h3>{{ __('site.quick_links') }}</h3>

                        <ul>
                            <li>
                                <a href="{{ route('site.home') }}">{{ __('site.home') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('site.about') }}">{{ __('site.about') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('site.categories.index') }}">{{ __('site.categories') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('site.products.index') }}">{{ __('site.products') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('site.contact') }}">{{ __('site.contact') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-6 col-lg-2">
                    <div class="footer-widget">
                        <h3>{{ __('site.trade_links') }}</h3>

                        <ul>
                            <li>
                                <a href="{{ route('site.products.index') }}">{{ __('site.all_products') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('site.categories.index') }}">{{ __('site.all_categories') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('site.quote.create') }}">{{ __('site.request_quote') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('site.products.index') }}">{{ __('site.export_products') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="footer-widget footer-contact-widget">
                        <h3>{{ __('site.contact_info') }}</h3>

                        <ul class="footer-contact-list">
                            @if(setting('site_email'))
                                <li>
                                    <span><i class="bi bi-envelope"></i></span>
                                    <a href="mailto:{{ setting('site_email') }}">
                                        {{ setting('site_email') }}
                                    </a>
                                </li>
                            @endif

                            @if(setting('site_phone'))
                                <li>
                                    <span><i class="bi bi-telephone"></i></span>
                                    <a href="tel:{{ setting('site_phone') }}">
                                        {{ setting('site_phone') }}
                                    </a>
                                </li>
                            @endif

                            @if(setting('site_whatsapp'))
                                <li>
                                    <span><i class="bi bi-whatsapp"></i></span>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('site_whatsapp')) }}" target="_blank">
                                        {{ setting('site_whatsapp') }}
                                    </a>
                                </li>
                            @endif

                            @php
                                $address = setting('site_address_' . app()->getLocale(), setting('site_address_en'));
                            @endphp

                            @if($address)
                                <li>
                                    <span><i class="bi bi-geo-alt"></i></span>
                                    <p>{{ $address }}</p>
                                </li>
                            @endif
                        </ul>

                        <a href="{{ route('site.quote.create') }}" class="footer-cta-btn">
                            {{ __('site.request_quote') }}
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-divider"></div>

            <div class="footer-bottom">
                <p>
                    © {{ date('Y') }} {{ setting('site_name', 'First Trade') }}.
                    {{ __('site.all_rights_reserved') }}
                </p>

                <div class="footer-bottom-links">
                    <a href="{{ route('site.products.index') }}">{{ __('site.products') }}</a>
                    <a href="{{ route('site.categories.index') }}">{{ __('site.categories') }}</a>
                    <a href="{{ route('site.contact') }}">{{ __('site.contact') }}</a>
                </div>
            </div>
        </div>
    </div>
</footer>