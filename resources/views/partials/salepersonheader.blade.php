<!-- Page Heading -->
<header class="sticky top-0 z-50 w-full border-b bg-white/90 backdrop-blur supports-[backdrop-filter]:bg-white/60">
    <div class="container mx-auto px-4 py-3 flex flex-col lg:flex-row items-center justify-between space-y-3 lg:space-y-0">

        <!-- Left: Title & Subtitle -->
        <div class="text-left flex-1">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">
                {{ $title ?? 'Dashboard' }}
            </h2>
            <p class="text-gray-500 text-sm">
                {{ $subtitle ?? 'Overview & stats' }}
            </p>
        </div>

        <!-- Center: Welcome & Status -->
        <div class="text-center">
            <h1 class="text-md font-semibold text-gray-800">
                Welcome, {{ session('salesperson_name') }}
            </h1>
            <p id="turn-status" class="text-sm text-gray-700 animate-pulse-text">
                Checking status...
            </p>
            <input type="hidden" id="currentUserId" value="{{ session('salesperson_id') }}">
        </div>

        <!-- Right: User Dropdown -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false" class="flex items-center gap-4">
            <div @click="open = !open">
                <button class="inline-flex items-center gap-3 px-3 py-2 rounded-md bg-gray-100 hover:bg-gray-200 text-sm transition-colors">
                    <div class="h-8 w-8 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-sm font-medium text-gray-700">Ad</span>
                    </div>
                    <div class="flex flex-col items-start">
                        <span class="font-medium text-gray-800">{{ session('salesperson_name') }}</span>
                        <span class="text-xs text-gray-500">{{ session('salesperson_role') }}</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 
                              1.414l-4 4a1 1 0 01-1.414 0L5.293 8.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>

            <!-- Dropdown -->
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute z-50 mt-2 w-56 rounded-md shadow-lg origin-top-right right-0 bg-white ring-1 ring-black ring-opacity-5 py-1"
                 style="display: none;">
                <div class="p-3 border-b">
                    <p class="text-sm font-medium text-gray-800">admin@admin.com</p>
                    <p class="text-xs text-gray-500">Joined Jul 2025</p>
                </div>
                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</header>
