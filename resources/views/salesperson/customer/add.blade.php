
<!DOCTYPE html>
<html lang="en">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="XvsD5rk5Dwq2JSINbHWAV47VbtyKCn1UnEKEiKXP">

        <title>HeadsUp</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/css/intlTelInput.css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
<!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="https://headsup.trevinosauto.com/favicon.svg">
<!-- Scripts -->
        <link rel="preload" as="style" href="https://headsup.trevinosauto.com/build/assets/app-Crok822L.css" /><link rel="modulepreload" href="https://headsup.trevinosauto.com/build/assets/app-DeKemmCm.js" /><link rel="stylesheet" href="https://headsup.trevinosauto.com/build/assets/app-Crok822L.css" /><script type="module" src="https://headsup.trevinosauto.com/build/assets/app-DeKemmCm.js"></script>        
        <!-- Sortable.js for drag and drop functionality -->
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script src="//unpkg.com/alpinejs" defer></script>

            </head>


    <body class="font-sans antialiased">
        <div x-data="{ sidebarOpen: true }" class="min-h-screen bg-background">
            <div class="flex">
                <!-- Mobile sidebar backdrop -->
                <div 
                    x-show="sidebarOpen" 
                    @click="sidebarOpen = false" 
                    class="fixed inset-0 z-20 bg-black/50 backdrop-blur-sm transition-opacity lg:hidden">
                </div>

                <!-- Sidebar -->
                <div 
                    x-show="sidebarOpen" 
                    class="fixed inset-y-0 left-0 z-30 w-64 transform transition duration-300 lg:relative lg:translate-x-0" 
                    :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
                    <div x-data="{ open: true }" class="min-h-screen h-full flex flex-col flex-shrink-0 w-64 bg-white border-r border-gray-200">
    <!-- Sidebar header -->
    <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
        <a href="" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-600 block h-9 w-auto fill-current text-gray-800">
  <path d="M12 2C10.343 2 9 3.343 9 5v1.07C6.163 7.165 4 9.83 4 13v5l-1 1v1h18v-1l-1-1v-5c0-3.17-2.163-5.835-5-6.93V5c0-1.657-1.343-3-3-3zm0 20a2.5 2.5 0 0 0 2.45-2h-4.9a2.5 2.5 0 0 0 2.45 2z"/>
</svg>
            <span class="ml-2 text-lg font-medium font-bold">HeadsUp</span>
        </a>
        <button @click="open = !open" class="lg:hidden text-gray-500 hover:text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Sidebar content -->
    <div class="flex-1 overflow-y-auto p-4">
        <nav class="space-y-1">

            <!-- Dashboard -->
            
          <a href="{{route('salesperson.dashboard')}}"
                class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md">

                <svg class="text-gray-500 mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>

                Dashboard
            </a>


            <!-- Appoinment  -->
            
            <!-- appointment list -->
                        <div class="pt-2">

                <a href="{{route('appointments.index')}}" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="24" height="24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2zM9 14l2 2 4-4" />
                    </svg>
                    <span class="flex-1" style="margin-left: 5px;">Appointment</span>
                </a>
            </div>
            
            <!-- create Sale person -->
            
            <!-- Tokens History -->
            <div class="pt-2">

                <a href="https://headsup.trevinosauto.com/add/users" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6M9 3h6a2 2 0 012 2v1H7V5a2 2 0 012-2zm0 4h6M5 8h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10a2 2 0 012-2zm4 4h6m-6 4h6" />
                    </svg>
                    <span class="flex-1">Customers</span>
                </a>
            </div>

            <!-- T/O -->
                        <!-- Activity Records -->
                        <div class="pt-2">

                <a href="https://headsup.trevinosauto.com/activity-report" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" width="24" height="24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="flex-1" style="margin-left: 5px;">Activity Track</span>
                </a>
            </div>
                    </nav>
    </div>

    <!-- Sidebar footer -->
    <div class="border-t border-gray-200 p-4">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 rounded-full bg-gray-100 p-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">admin</p>
                <div class="flex mt-1 items-center">
                    <a href="https://headsup.trevinosauto.com/profile" class="text-xs font-medium text-gray-500 hover:text-gray-700">Profile</a>
                    <span class="mx-1 text-gray-500">|</span>
                    <form method="POST" action="https://headsup.trevinosauto.com/logout">
                        <input type="hidden" name="_token" value="XvsD5rk5Dwq2JSINbHWAV47VbtyKCn1UnEKEiKXP" autocomplete="off">                        <button type="submit" class="text-xs font-medium text-gray-500 hover:text-gray-700">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>                </div>

                <!-- Content -->
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
                                        <div class="md:col-span-2">
      <h3 class="text-2xl font-bold text-gray-800 leading-tight mb-0">Customer Sales Form</h3>
      <p class="text-gray-500 mt-0 leading-tight">Fill out the details below to log a customer sales interaction.</p>
    </div>
                                    </div>

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
                                                                ad
                                                            </span>
                                                        </div>
                                                        <div class="flex flex-col items-start">
                                                            <span class="text-sm font-medium">admin</span>
                                                            <span class="text-xs text-muted-foreground">Sales person</span>
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
                                                            <p class="text-sm font-medium text-foreground">admin@gmail.com</p>
                                                            <p class="text-xs text-muted-foreground mt-0.5">Joined Jul 2025</p>
                                                        </div>
                                                        
                                                        <div class="my-1 h-px bg-accent"></div>

                                                        <!-- Menu Items -->
                                                        <nav class="space-y-1">
                                                            <a class="block w-full px-4 py-2 text-sm leading-5 text-foreground transition duration-150 ease-in-out hover:bg-accent focus:outline-none focus:bg-accent flex items-center gap-2 px-2 py-1.5 hover:bg-accent rounded-md transition-colors" href="https://headsup.trevinosauto.com/profile">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                                                    <circle cx="12" cy="7" r="4"/>
                                                                </svg>
                                                                Profile
</a>

                                                            
                                                            <div class="my-1 h-px bg-accent"></div>

                                                            <!-- Logout -->
                                                            <form method="POST" action="https://headsup.trevinosauto.com/logout">
                                                                <input type="hidden" name="_token" value="XvsD5rk5Dwq2JSINbHWAV47VbtyKCn1UnEKEiKXP" autocomplete="off">                                                                <a class="block w-full px-4 py-2 text-sm leading-5 text-foreground transition duration-150 ease-in-out hover:bg-accent focus:outline-none focus:bg-accent flex items-center gap-2 px-2 py-1.5 text-destructive hover:bg-destructive/10 rounded-md transition-colors" onclick="event.preventDefault(); this.closest('form').submit();" href="https://headsup.trevinosauto.com/logout">
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
                    
                    <!-- Page Content -->
                    <main class="flex-1 overflow-y-auto">
                        <div class="py-6">
                            <div class="max-w-full">
                                <!-- Tailwind CSS CDN (v3) -->
<script src="https://cdn.tailwindcss.com"></script>
    <style>
.swal2-confirm {
  background-color: #111827 !important;
  color: #fff !important;
}
.swal2-confirm:hover,
.swal2-confirm:focus,
.swal2-confirm:active {
  background-color: #111827 !important;
}
</style>
   
  <div class="px-4">
     <div id="formContainer">
      <form id="salesForm" method="POST" action="{{ route('customers.store') }}"
        class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white rounded-2xl border border-gray-200 p-8 shadow-lg">
       @csrf
        <div class="md:col-span-2">
          <h3 class="text-2xl font-bold text-gray-800 leading-tight mb-0">Customer Sales Form</h3>
          <p class="text-gray-500 mt-0 leading-tight">Fill out the details below to log a customer sales interaction.</p>
        </div>

        <!-- Customer Info -->
        <div class="space-y-4">
                    <div>
            <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">Name</label>
            <input
              id="nameInput"
              name="name"
              type="text"
              class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"
            />
          </div>
                    <div>
            <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">Email</label>
            <input
              id="emailInput"
              name="email"
              type="email"
              class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"
            />
          </div>
                    <div>
                      <label for="phone" class="block  text-sm font-medium text-gray-700">Phone Number</label>
                      
                    
                         
                          <input  class="pl-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" style="width:530px;" id="phone" name="phone" type="tel" placeholder="" required style="width: 500px;" class="mt-1 block  rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                   
          </div>
                    <div>
            <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">Interest</label>
            <input
              id="interestInput"
              name="interest"
              type="text"
              class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"
            />
          </div>
                  </div>

        <!-- Sales Details -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
            <textarea name="notes" rows="6" class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"></textarea>
          </div>

          <fieldset class="border border-gray-300 rounded-xl p-4">
            <legend class="text-sm font-semibold text-gray-700 mb-3">Sales Process</legend>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                            <label class="flex items-center space-x-2">
                <input type="checkbox" name="process[]" value="Investigating"
                  
                  class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 text-sm">Investigating</span>
              </label>
                            <label class="flex items-center space-x-2">
                <input type="checkbox" name="process[]" value="Test Driving"
                  
                  class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 text-sm">Test Driving</span>
              </label>
                            <label class="flex items-center space-x-2">
                <input type="checkbox" name="process[]" value="Desking"
                  
                  class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 text-sm">Desking</span>
              </label>
                            <label class="flex items-center space-x-2">
                <input type="checkbox" name="process[]" value="Credit Application"
                  
                  class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 text-sm">Credit Application</span>
              </label>
                            <label class="flex items-center space-x-2">
                <input type="checkbox" name="process[]" value="Penciling"
                  
                  class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 text-sm">Penciling</span>
              </label>
                            <label class="flex items-center space-x-2">
                <input type="checkbox" name="process[]" value="F&amp;I"
                  
                  class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 text-sm">F&amp;I</span>
              </label>
                          </div>
          </fieldset>

          <!-- Disposition Modal -->
          <div id="customerModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white p-6 rounded-xl w-full max-w-2xl relative">
              <button type="button" id="closeModalBtn" class="absolute top-3 right-3 text-gray-500 hover:text-black text-xl font-bold">&times;</button>
              <fieldset class="border border-gray-300 rounded-xl p-4">
                <legend class="text-sm font-semibold text-gray-700 mb-3">Disposition</legend>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Sold!"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Sold!</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Walked Away"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Walked Away</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Challenged Credit"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Challenged Credit</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Didn&#039;t Like Vehicle"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Didn&#039;t Like Vehicle</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Didn&#039;t Like Price"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Didn&#039;t Like Price</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Didn&#039;t Like Finance Terms"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Didn&#039;t Like Finance Terms</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Insurance Expensive"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Insurance Expensive</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Wants to keep looking"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Wants to keep looking</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Wants to think about it"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Wants to think about it</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Needs Co-Signer"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Needs Co-Signer</span>
                  </label>
                                  </div>
              </fieldset>
              <div class="text-right mt-4">
                <button type="submit" class="bg-gray-800 text-white px-3 py-1.5 rounded">Save</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Triggers -->
        <div class="md:col-span-2 text-right mt-4">
          <button id="openModalBtn" type="button" class="bg-gray-800 text-white px-3 py-1.5 rounded">Close</button>
          <button type="button" id="toBtn" class="relative bg-gray-800 text-white px-4 py-1.5 rounded">
            <span class="btn-label">T/O</span>
            <div class="toSpinner hidden absolute inset-0 bg-black/50 flex items-center justify-center z-10 rounded">
              <div class="w-6 h-6 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
            </div>
          </button>
        </div>
      </form>
    </div>
  </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
        
        <!-- Sound initialization elements -->
        <!-- <div id="sound-init-container" class="fixed bottom-4 right-4 z-50 flex flex-col gap-2" style="display: none;">
            <button id="init-sound-btn" class="bg-primary text-white p-2 rounded-full shadow-lg hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                <span class="sr-only">Initialize Sound</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15.465a5 5 0 001.06-7.89l5.415-5.415a1 1 0 00-1.414-1.414L6.464 9.88a7 7 0 002.12 11.382l.293.16a1 1 0 001.414-1.414l-3.879-3.89a3 3 0 01-.626-3.314L4.21 14.216a1 1 0 101.414 1.414l-.04-.04z" />
                </svg>
            </button> -->
            
            
        </div>

        <!-- Additional Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('customerModal');
    const salesForm = document.getElementById('salesForm');

    // Modal toggle
    openModalBtn?.addEventListener('click', () => modal.classList.remove('hidden'));
    closeModalBtn?.addEventListener('click', () => modal.classList.add('hidden'));
    window.addEventListener('click', (e) => {
      if (e.target === modal) modal.classList.add('hidden');
    });

    // ✅ AJAX form submit with Swal
    salesForm?.addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(this);
      const url = this.action;

      fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        },
        body: formData,
      })
      .then(res => res.json())
      .then(data => {
      if (data.status === 'success') {
  Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                confirmButtonColor: '#111827',
            }).then(() => {
                window.location.href = data.redirect;
            });

  modal.classList.add('hidden');
  salesForm.reset();
}
 else {
          Swal.fire('Error', 'Something went wrong!', 'error');
        }
      })
      .catch(err => {
        Swal.fire('Error', 'Request failed!', 'error');
        console.error(err);
      });
    });
  });
</script>
                <script>
            // Initialize notification listener
            document.addEventListener('DOMContentLoaded', function() {
                // Only initialize for authenticated users
                                try {
                    // Initialize sound system first to ensure it's ready
                    if (window.VehicleImportNotification && typeof window.VehicleImportNotification.initAudio === 'function') {
                        console.log('Attempting to initialize audio context');
                    }
                    
                    // Show sound initialization button immediately for better UX
                    const soundInitContainer = document.getElementById('sound-init-container');
                    if (soundInitContainer) {
                        soundInitContainer.style.display = 'flex';
                    }
                    
                    // Initialize notification listener
                    if (window.NotificationListener) {
                        console.log('Initializing NotificationListener');
                        const listener = new NotificationListener(11);
                        
                        // Store the listener instance globally for debugging
                        window.notificationListenerInstance = listener;
                    } else {
                        console.warn('NotificationListener is not available on the window object');
                    }
                } catch (error) {
                    console.error('Error initializing NotificationListener:', error);
                }
                
                // Toggle notifications dropdown
                const notificationsButton = document.getElementById('notifications-menu-button');
                const notificationsDropdown = document.getElementById('notifications-dropdown');
                if (notificationsButton && notificationsDropdown) {
                    notificationsButton.addEventListener('click', () => {
                        notificationsDropdown.classList.toggle('hidden');
                    });
                }

                // Toggle user dropdown
                const userButton = document.getElementById('user-menu-button');
                const userDropdown = document.getElementById('user-dropdown');
                if (userButton && userDropdown) {
                    userButton.addEventListener('click', () => {
                        userDropdown.classList.toggle('hidden');
                    });
                }

                // Initialize sound buttons
                const soundInitContainer = document.getElementById('sound-init-container');
                const initSoundBtn = document.getElementById('init-sound-btn');
                const testSoundBtn = document.getElementById('test-sound-btn');
                
                // Initialize sound on click
                if (initSoundBtn) {
                    initSoundBtn.addEventListener('click', function() {
                        // Try to initialize audio context
                        if (window.VehicleImportNotification && window.VehicleImportNotification.initAudio) {
                            window.VehicleImportNotification.initAudio();
                        }
                        
                        // Test the sound
                        if (window.testVehicleNotificationSound) {
                            window.testVehicleNotificationSound();
                            
                            // Don't hide button to allow multiple initializations if needed
                            // soundInitContainer.style.display = 'none';
                            
                            // Add data attribute to track that it was initialized
                            initSoundBtn.setAttribute('data-initialized', 'true');
                            
                            // Change color to indicate it's been initialized
                            initSoundBtn.classList.remove('bg-primary');
                            initSoundBtn.classList.add('bg-green-500');
                        }
                    });
                }
                
                // Test sound button for admins
                if (testSoundBtn) {
                    testSoundBtn.addEventListener('click', function() {
                        if (window.testVehicleNotificationSound) {
                            window.testVehicleNotificationSound();
                        }
                    });
                }

                // Pre-load notification sound on any user interaction
                const preloadSound = function() {
                    if (window.VehicleImportNotification && window.VehicleImportNotification.initAudio) {
                        window.VehicleImportNotification.initAudio();
                        console.log('Audio context initialized via user interaction');
                    }
                    
                    // Remove this event listener after first user interaction
                    document.removeEventListener('click', preloadSound);
                    document.removeEventListener('touchstart', preloadSound);
                };
                
                // Add event listeners for first user interaction
                document.addEventListener('click', preloadSound);
                document.addEventListener('touchstart', preloadSound);

                // Close dropdowns when clicking outside
                document.addEventListener('click', (event) => {
                    if (!notificationsButton?.contains(event.target)) {
                        notificationsDropdown?.classList.add('hidden');
                    }
                    if (!userButton?.contains(event.target)) {
                        userDropdown?.classList.add('hidden');
                    }
                });
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/js/intlTelInput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/js/utils.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const input = document.querySelector("#phone");
        
                const iti = window.intlTelInput(input, {
                    initialCountry: "pk",
                    separateDialCode: true,
                    preferredCountries: ['pk', 'us', 'gb'],
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/js/utils.js"
                });
        
                document.querySelector("#appointment-form").addEventListener("submit", function () {
                    input.value = iti.getNumber(); // This will convert to +923001234567
                });
            });
        </script>
    </body>
</html>
