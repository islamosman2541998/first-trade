<header class="admin-topbar px-4 py-3 d-flex align-items-center justify-content-between">
    <div>
        <strong>@yield('page_title', __('admin.dashboard'))</strong>
    </div>

    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('site.home') }}" target="_blank" class="btn btn-sm btn-outline-success">
            {{ __('admin.view_website') }}
        </a>

        <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                {{ strtoupper(app()->getLocale()) }}
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('locale.switch', 'en') }}">English</a></li>
                <li><a class="dropdown-item" href="{{ route('locale.switch', 'ar') }}">العربية</a></li>
                <li><a class="dropdown-item" href="{{ route('locale.switch', 'nl') }}">Dutch</a></li>
            </ul>
        </div>

        <div class="dropdown">
            <button class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">
                {{ auth()->user()->name }}
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        {{ __('admin.profile') }}
                    </a>
                </li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item">
                            {{ __('admin.logout') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>