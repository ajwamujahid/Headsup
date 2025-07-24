<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HeadsUp</title>

    <!-- Fonts & Favicon -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="https://headsup.trevinosauto.com/favicon.svg">

    <!-- Styles -->
    <link rel="stylesheet" href="https://headsup.trevinosauto.com/build/assets/app-Crok822L.css">

    <!-- Scripts -->
    <script type="module" src="https://headsup.trevinosauto.com/build/assets/app-DeKemmCm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('styles')
    @stack('head')
</head>
<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: true }" class="min-h-screen bg-background">
        <div class="flex">
            {{-- Include Sidebar --}}
            @include('partials.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">
                {{-- Include Top Navigation --}}
                @include('partials.header3')

                {{-- Main Content --}}
                <main class="flex-1 overflow-y-auto">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    {{-- Charts, Notification, or Custom Scripts --}}
    @stack('scripts')
</body>
</html>
