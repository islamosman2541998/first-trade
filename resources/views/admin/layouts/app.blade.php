<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('admin.dashboard')) - {{ setting('site_name', 'First Trade') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        :root {
            --admin-sidebar-color: {{ setting('admin_sidebar_color', '#24572E') }};
            --admin-topbar-color: {{ setting('admin_topbar_color', '#FFFFFF') }};
            --admin-primary-color: {{ setting('admin_primary_color', '#2F6E3B') }};
            --admin-background-color: {{ setting('admin_background_color', '#F6F7F9') }};
        }

        body {
            background: var(--admin-background-color);
            direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};
        }

        .admin-wrapper {
            min-height: 100vh;
            display: flex;
        }

        .admin-sidebar {
            width: 270px;
            background: var(--admin-sidebar-color);
            color: #fff;
            flex-shrink: 0;
        }

        .admin-sidebar a {
            color: rgba(255,255,255,.88);
            text-decoration: none;
            display: block;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .admin-sidebar a:hover,
        .admin-sidebar a.active {
            background: rgba(255,255,255,.13);
            color: #fff;
        }

        .admin-content {
            flex: 1;
            min-width: 0;
        }

        .admin-topbar {
            background: var(--admin-topbar-color);
            border-bottom: 1px solid #e5e7eb;
        }

        .admin-card {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .06);
        }

        .btn-admin-primary {
            background: var(--admin-primary-color);
            border-color: var(--admin-primary-color);
            color: #fff;
        }

        .btn-admin-primary:hover {
            opacity: .92;
            color: #fff;
        }

        [dir="rtl"] .me-2 {
            margin-left: .5rem !important;
            margin-right: 0 !important;
        }
    </style>
</head>
<body>
<div class="admin-wrapper">
    @include('admin.partials.sidebar')

    <div class="admin-content">
        @include('admin.partials.topbar')

        <main class="p-4">
            @yield('content')
        </main>
    </div>
</div>

@livewireScripts

@stack('scripts')

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('toastr-success', (event) => {
            toastr.success(event.message);
        });

        Livewire.on('toastr-error', (event) => {
            toastr.error(event.message);
        });

        Livewire.on('confirm-delete', (event) => {
            Swal.fire({
                title: event.title || @json(__('admin.are_you_sure')),
                text: event.text || @json(__('admin.confirm_delete')),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: event.confirmButtonText || @json(__('admin.yes_delete')),
                cancelButtonText: event.cancelButtonText || @json(__('admin.cancel')),
                confirmButtonColor: '#dc3545',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(event.callback, event.payload || {});
                }
            });
        });
    });

    @if(session('success'))
        toastr.success(@json(session('success')));
    @endif

    @if(session('error'))
        toastr.error(@json(session('error')));
    @endif
</script>
</body>
</html>