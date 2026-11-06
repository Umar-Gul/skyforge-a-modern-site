<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Skyforge Aviation')</title>
    <meta name="description" content="@yield('description', 'Skyforge Aviation builds next-generation aircraft for the missions that move the world forward.')">
    <meta name="theme-color" content="#0a1220">
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Cpath d='M3 18 29 5 21 27l-5-8-13-1Z' fill='%23ff5a1f'/%3E%3C/svg%3E">
    <script>document.documentElement.classList.add('js')</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    {{-- Critical CSS: keeps overlays hidden until app.css has loaded, so they never flash on page load --}}
    <style>
        #search-overlay, #mobile-menu, .menu-backdrop, .mega-panel { visibility: hidden; opacity: 0; }
        #mobile-menu { transform: translateX(100%); }
        #search-overlay.is-open, #mobile-menu.is-open, .mega-panel.is-open { visibility: visible; opacity: 1; }
        #mobile-menu.is-open { transform: none; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <a href="#main" class="skip-link">Skip to content</a>
    @include('partials.navbar')

    <main id="main">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
