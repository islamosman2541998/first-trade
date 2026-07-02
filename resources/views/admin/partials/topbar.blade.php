<header class="admin-topbar">
    <div class="admin-topbar-title">
        <span class="admin-page-eyebrow">{{ __('admin.admin_panel') }}</span>
        <strong>@yield('page_title', __('admin.dashboard'))</strong>
    </div>

    <div class="admin-topbar-actions">
        <a href="{{ route('site.home') }}" target="_blank" class="admin-topbar-btn view-site-btn">
            <i class="bi bi-box-arrow-up-right"></i>
            <span>{{ __('admin.view_website') }}</span>
        </a>

        <div class="dropdown">
            <button class="admin-topbar-btn dropdown-toggle" data-bs-toggle="dropdown">
                <i class="bi bi-translate"></i>
                <span>{{ strtoupper(app()->getLocale()) }}</span>
            </button>

            <ul class="dropdown-menu dropdown-menu-end admin-dropdown">
                <li><a class="dropdown-item" href="{{ route('locale.switch', 'en') }}">English</a></li>
                <li><a class="dropdown-item" href="{{ route('locale.switch', 'ar') }}">العربية</a></li>
                <li><a class="dropdown-item" href="{{ route('locale.switch', 'nl') }}">Dutch</a></li>
            </ul>
        </div>

        <div class="dropdown">
            <button class="admin-user-btn dropdown-toggle" data-bs-toggle="dropdown">
                <span class="admin-user-avatar">
                    {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                </span>

                <span class="admin-user-info">
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>{{ auth()->user()->roles->first()?->name ?? 'Admin' }}</small>
                </span>
            </button>

            <ul class="dropdown-menu dropdown-menu-end admin-dropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person me-2"></i>
                        {{ __('admin.profile') }}
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            {{ __('admin.logout') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>