<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'First Trade')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="@yield('body_class')">
    @include('site.partials.header')

    <main>
        @yield('content')
    </main>

    @include('site.partials.footer')

    @livewireScripts
    @stack('scripts')

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.querySelector('.site-navbar');
        const collapse = document.querySelector('#siteMainNavbar');

        if (!navbar) return;

        function handleNavbarScroll() {
            if (window.scrollY > 60) {
                navbar.classList.add('is-scrolled');
            } else {
                navbar.classList.remove('is-scrolled');
            }
        }

        if (collapse) {
            collapse.addEventListener('show.bs.collapse', function () {
                navbar.classList.add('menu-open');
            });

            collapse.addEventListener('hidden.bs.collapse', function () {
                navbar.classList.remove('menu-open');
            });
        }

        handleNavbarScroll();
        window.addEventListener('scroll', handleNavbarScroll);
    });
</script>
</body>

</html>
