<header class="site-navbar">
    <div class="container">
        <nav class="navbar navbar-expand-lg site-navbar-inner">
            <a class="navbar-brand site-brand" href="{{ route('site.home') }}">
                @if(setting('site_logo'))
                    <img src="{{ asset(setting('site_logo')) }}" alt="{{ setting('site_name', 'First Trade') }}">
                @else
                    <span>{{ setting('site_name', 'First Trade') }}</span>
                @endif
            </a>

            <button class="navbar-toggler site-navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteMainNavbar" aria-controls="siteMainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse" id="siteMainNavbar">
                <ul class="navbar-nav mx-auto site-nav-links">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('site.home') ? 'active' : '' }}" href="{{ route('site.home') }}">
                            {{ __('site.home') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('site.about') ? 'active' : '' }}" href="{{ route('site.about') }}">
                            {{ __('site.about') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('site.categories.*') ? 'active' : '' }}" href="{{ route('site.categories.index') }}">
                            {{ __('site.categories') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('site.products.*') ? 'active' : '' }}" href="{{ route('site.products.index') }}">
                            {{ __('site.products') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('site.contact') ? 'active' : '' }}" href="{{ route('site.contact') }}">
                            {{ __('site.contact') }}
                        </a>
                    </li>
                </ul>

                <div class="site-nav-actions">
                    <div class="dropdown">
                        <button class="btn site-lang-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            {{ strtoupper(app()->getLocale()) }}
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('locale.switch', 'en') }}">English</a></li>
                            <li><a class="dropdown-item" href="{{ route('locale.switch', 'ar') }}">العربية</a></li>
                            <li><a class="dropdown-item" href="{{ route('locale.switch', 'nl') }}">Dutch</a></li>
                        </ul>
                    </div>

                    <a href="{{ route('site.quote.create') }}" class="site-quote-btn">
                        {{ __('site.request_quote') }}
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>