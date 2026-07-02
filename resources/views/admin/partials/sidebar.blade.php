<aside class="admin-sidebar">
    <div class="admin-sidebar-inner">
        <div class="admin-brand-box">
            @php
                $adminLogo = setting('admin_logo');
                $siteLogo = setting('site_logo');
                $logo = $adminLogo ?: $siteLogo;
            @endphp

            <a href="{{ route('admin.dashboard') }}" class="admin-brand-link">
                @if ($logo)
                    <img src="{{ asset($logo) }}"
                         alt="{{ setting('site_name', 'First Trade') }}"
                         style="max-width: {{ setting('admin_logo_width', '120') }}px;">
                @else
                    <span>{{ setting('site_name', 'First Trade') }}</span>
                @endif
            </a>

            <small>{{ __('admin.admin_panel') }}</small>
        </div>

        <div class="admin-menu-label">Main Menu</div>

        <nav class="admin-sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="admin-nav-icon"><i class="bi bi-speedometer2"></i></span>
                <span>{{ __('admin.dashboard') }}</span>
            </a>

            <a href="{{ route('admin.sliders.index') }}" class="{{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                <span class="admin-nav-icon"><i class="bi bi-images"></i></span>
                <span>{{ __('admin.sliders') }}</span>
            </a>

            <a href="{{ route('admin.home-sections.index') }}" class="{{ request()->routeIs('admin.home-sections.*') ? 'active' : '' }}">
                <span class="admin-nav-icon"><i class="bi bi-house-gear"></i></span>
                <span>{{ __('site.home_sections') }}</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="admin-nav-icon"><i class="bi bi-grid"></i></span>
                <span>{{ __('admin.categories') }}</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <span class="admin-nav-icon"><i class="bi bi-box-seam"></i></span>
                <span>{{ __('admin.products') }}</span>
            </a>

            <a href="{{ route('admin.contact-messages.index') }}" class="{{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
    <span class="admin-nav-icon"><i class="bi bi-envelope"></i></span>
    <span>{{ __('admin.contact_messages') }}</span>
</a>

            <a href="{{ route('admin.quote-requests.index') }}" class="{{ request()->routeIs('admin.quote-requests.*') ? 'active' : '' }}">
    <span class="admin-nav-icon"><i class="bi bi-file-earmark-text"></i></span>
    <span>{{ __('admin.quote_requests') }}</span>
</a>

            <a href="#" class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                <span class="admin-nav-icon"><i class="bi bi-file-text"></i></span>
                <span>{{ __('admin.pages') }}</span>
            </a>

            <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <span class="admin-nav-icon"><i class="bi bi-gear"></i></span>
                <span>{{ __('admin.settings') }}</span>
            </a>
        </nav>

        <div class="admin-sidebar-footer">
            <a href="{{ route('site.home') }}" target="_blank">
                <i class="bi bi-box-arrow-up-right"></i>
                <span>{{ __('admin.view_website') }}</span>
            </a>
        </div>
    </div>
</aside>