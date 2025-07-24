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
class="bg-gray-100 text-gray-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md">

<svg class="text-gray-500 mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
     d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
</svg>

Dashboard
</a>


<!-- Appoinment  -->
     <div class="pt-2">


<a href="{{ route('salesperson.appointments.index') }}" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md">
 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="24" height="24">
     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
         d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2zM9 14l2 2 4-4" />
 </svg>
 <span class="flex-1 " style="margin-left: 5px;">Appointments</span>
</a>
</div>

<div class="pt-2">

    <a href="{{ route('salesperson.customer.activity-report') }}" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" width="24" height="24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="flex-1" style="margin-left: 5px;">Activity Track</span>
    </a>
</div>

<!-- Tokens History -->
<div class="pt-2">

<a href="{{ route('salesperson.customer.index') }}" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-3 py-2 text-sm font-medium rounded-md">
 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6M9 3h6a2 2 0 012 2v1H7V5a2 2 0 012-2zm0 4h6M5 8h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10a2 2 0 012-2zm4 4h6m-6 4h6" />
 </svg>
 <span class="flex-1">Customers</span>
</a>
</div>

<!--  -->
<!-- Activity Records -->
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
<p class="text-sm font-medium text-gray-900">Admin</p>
<div class="flex mt-1 items-center">
    <a href="{{ route('profile') }}" class="text-xs font-medium text-gray-500 hover:text-gray-700">Profile</a>
    <span class="mx-1 text-gray-500">|</span>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-xs font-medium text-gray-500 hover:text-gray-700">Logout</button>
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