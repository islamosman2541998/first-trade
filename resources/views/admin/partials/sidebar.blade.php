<aside class="admin-sidebar p-3">
    <div class="text-center mb-4">
        @php
            $adminLogo = setting('admin_logo');
            $siteLogo = setting('site_logo');
            $logo = $adminLogo ?: $siteLogo;
        @endphp

        @if ($logo)
            <img src="{{ asset($logo) }}" alt="{{ setting('site_name', 'First Trade') }}"
                style="max-width: {{ setting('admin_logo_width', '120') }}px; max-height: 90px; object-fit: contain;">
        @else
            <h5 class="mb-0">{{ setting('site_name', 'First Trade') }}</h5>
        @endif

        <small class="opacity-75 d-block mt-2">{{ __('admin.admin_panel') }}</small>
    </div>

    <nav>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> {{ __('admin.dashboard') }}
        </a>
        <a href="{{ route('admin.sliders.index') }}"
            class="{{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
            <i class="bi bi-images me-2"></i> {{ __('admin.sliders') }}
        </a>

        <a href="#" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="bi bi-grid me-2"></i> {{ __('admin.categories') }}
        </a>

        <a href="#" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam me-2"></i> {{ __('admin.products') }}
        </a>

        <a href="#" class="{{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
            <i class="bi bi-envelope me-2"></i> {{ __('admin.contact_messages') }}
        </a>

        <a href="#" class="{{ request()->routeIs('admin.quote-requests.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text me-2"></i> {{ __('admin.quote_requests') }}
        </a>

        <a href="#" class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
            <i class="bi bi-file-text me-2"></i> {{ __('admin.pages') }}
        </a>

        <a href="{{ route('admin.settings.index') }}"
            class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear me-2"></i> {{ __('admin.settings') }}
        </a>
    </nav>
</aside>
