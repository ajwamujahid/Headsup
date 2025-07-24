<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Top navigation -->
    <div class="bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60 border-b lg:hidden">
        <div class="flex items-center justify-between h-16 px-4">
            <button @click="sidebarOpen = true" class="text-muted-foreground hover:text-foreground focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <a href="https://headsup.trevinosauto.com/dashboard" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-600 block h-9 w-auto fill-current text-foreground">
<path d="M12 2C10.343 2 9 3.343 9 5v1.07C6.163 7.165 4 9.83 4 13v5l-1 1v1h18v-1l-1-1v-5c0-3.17-2.163-5.835-5-6.93V5c0-1.657-1.343-3-3-3zm0 20a2.5 2.5 0 0 0 2.45-2h-4.9a2.5 2.5 0 0 0 2.45 2z"/>
</svg>
                <span class="ml-2 text-lg font-medium text-foreground">TrevinosAuto</span>
            </a>
            <div></div> <!-- Empty div for flex spacing -->
        </div>
    </div>

    <!-- Page Heading -->
                            <header class="sticky top-0 z-50 w-full border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
            <div class="container mx-auto space-y-6 px-4">
                <div class="flex h-16 items-center justify-between">
                    <!-- Left side - Header Title -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-800 mb-1">
                            {{ $title ?? 'Dashboard' }}
                        </h2>
                        <p class="text-gray-500 text-sm">
                            {{ $subtitle ?? 'Overview & stats' }}
                        </p>
                    </div>
                    <p id="turn-status" class="text-sm text-gray-700 animate-pulse-text mt-1">
                        Checking status...
                    </p>
                    <input type="hidden" id="currentUserId" value="{{ session('salesperson_id') }}">
                


                    <!-- Right side - User Menu -->
                    <div class="flex items-center gap-4 pl-3">
                        <!-- Notifications Dropdown -->
                        <div class="ml-auto flex items-center gap-x-4">
                            <div class="relative">
                                <!-- <button type="button" class="relative rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2" id="notifications-menu-button">
                                    <span class="sr-only">View notifications</span>
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
</svg>                                                </button> -->

                                <!-- Notifications Dropdown Panel -->
                                <div class="hidden absolute right-0 z-10 mt-2 w-80 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" id="notifications-dropdown">
                                    <div class="px-4 py-2 border-b border-gray-100">
                                        <h3 class="text-sm font-semibold">Notifications</h3>
                                    </div>
                                    
                                  
                                </div>
                            </div>

                            <!-- User Dropdown -->
                            <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
<div @click="open = !open">
<button class="inline-flex items-center gap-3 px-2 py-1.5 rounded-md bg-background hover:bg-accent text-sm transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
                                        <!-- Avatar -->
                                        <div class="relative h-8 w-8 rounded-full bg-primary/10 flex items-center justify-center">
                                            <span class="text-sm font-medium text-primary">
                                                Ad
                                            </span>
                                        </div>
                                        <div class="flex flex-col items-start">
                                            <span class="font-medium text-gray-800">{{ session('sales_name') }}</span>
                                            <span class="text-xs text-gray-500">{{ session('sales_role') }}</span>
                                            
                                        </div>
                                        <svg class="h-4 w-4 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
</div>

<div x-show="open"
x-transition:enter="transition ease-out duration-200"
x-transition:enter-start="opacity-0 scale-95"
x-transition:enter-end="opacity-100 scale-100"
x-transition:leave="transition ease-in duration-75"
x-transition:leave-start="opacity-100 scale-100"
x-transition:leave-end="opacity-0 scale-95"
class="absolute z-50 mt-2 w-56 rounded-md shadow-lg origin-top-right right-0"
style="display: none;"
@click="open = false">
<div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-background">
            <div class="p-2">
                                                        <!-- User Info -->
                                                        <div class="px-2 py-1.5">
                                                            <p class="text-sm font-medium text-foreground">admin@admin.com</p>
                                                            <p class="text-xs text-muted-foreground mt-0.5">Joined Jul 2025</p>
                                                        </div>
                                                        
                                                        <div class="my-1 h-px bg-accent"></div>

                                                        <!-- Menu Items -->
                                                        <nav class="space-y-1">
                                                            <a class="block w-full px-4 py-2 text-sm leading-5 text-foreground transition duration-150 ease-in-out hover:bg-accent focus:outline-none focus:bg-accent flex items-center gap-2 px-2 py-1.5 hover:bg-accent rounded-md transition-colors" href="{{ route('profile') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                                                    <circle cx="12" cy="7" r="4"/>
                                                                </svg>
                                                                Profile
</a>

                                                            
                                                            <div class="my-1 h-px bg-accent"></div>

                                                            <!-- Logout -->
                                                            <form method="POST" action="{{ route('logout') }}">
                                                                @csrf
                                                               <a class="block w-full px-4 py-2 text-sm leading-5 text-foreground transition duration-150 ease-in-out hover:bg-accent focus:outline-none focus:bg-accent flex items-center gap-2 px-2 py-1.5 text-destructive hover:bg-destructive/10 rounded-md transition-colors" onclick="event.preventDefault(); this.closest('form').submit();" href="{{ route('logout') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                                                        <polyline points="16 17 21 12 16 7"/>
                                                                        <line x1="21" y1="12" x2="9" y2="12"/>
                                                                    </svg>
                                                                    Log Out
</a>
                                                            </form>
                                                        </nav>
                                                    </div>
        </div>
    </div>
</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </header>
                        