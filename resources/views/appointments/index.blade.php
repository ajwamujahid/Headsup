@extends('layouts.app')

@section('content')
@php
$title = 'Appointments';
$subtitle = 'Manage and View all the appointmeents here';
@endphp
    
    <!-- Page Content -->
    <main class="flex-1 overflow-y-auto">
        <div class="py-6">
            <div class="max-w-full">
                <div class="py-6">
<div class="container mx-auto space-y-6 py-6 px-4">
<div class="flex items-center justify-end mb-4 px-6">
<a href="{{route('appointments.create')}}" class="text-white px-3 bg-gray-800 py-1.5 rounded"
   >
    Add Appointments
</a>
</div>

<div id="appointmentsTable">
<div class="overflow-x-auto rounded-lg shadow border border-gray-200">
    <table class="min-w-full bg-white divide-y divide-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border-b px-4 py-2 text-left">Customer</th>
                <th class="border-b px-4 py-2 text-left">Sale Person</th>
                <th class="border-b px-4 py-2 text-left">Schedule At</th>
                <th class="border-b px-4 py-2 text-left">Status</th>
                <th class="border-b px-4 py-2 text-left">Action</th>
            </tr>
        </thead>
       
        <tbody>
            @forelse ($appointments as $appointment)
            <tr>
                <td class="px-4 py-2">{{ $appointment->customer_name }}</td>
                <td class="px-4 py-2">{{ $appointment->salesperson->name ?? 'N/A' }}</td>
                <td class="px-4 py-2">
                    {{ \Carbon\Carbon::parse($appointment->created_at)->timezone('Asia/Karachi')->format('d M Y h:i A') }}
                </td>
                <td class="px-4 py-2">
                    <span class="inline-block px-2 py-1  mr-1 mb-1  font-semibold bg-gray-100 text-white-800 rounded">
                    {{ $appointment->status }}
                    </span>
                </td>

                <td class="px-4 py-2">
    @if($appointment->status === 'scheduled')
        <a href="{{ route('appointments.show', $appointment->id) }}" class="bg-gray-800 text-white  font-bold px-3 py-1.5 rounded">View</a>
        <a href="{{ route('appointments.edit', $appointment->id) }}" class="bg-gray-800 text-white font-bold px-3 py-1.5 rounded ">Edit</a>
        <a href="{{ route('appointments.customer_arrived', $appointment->id) }}" class="bg-gray-800 text-white font-bold px-3 py-1.5 rounded">Customer Arrived</a>
    
    @elseif($appointment->status === 'completed')
        <a href="{{ route('appointments.show', $appointment->id) }}" class="bg-gray-800 text-white font-bold px-3 py-1.5 rounded ">View</a>

    @elseif($appointment->status === 'cancelled')
        {{-- No buttons --}}
    @endif
</td>

              
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-2 text-center">No appointments found.</td>
            </tr>
            @endforelse
        </tbody>
        
    </table>

       <div class="mt-4 px-4 mb-2">
<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
<div class="flex justify-between flex-1 sm:hidden">
            <span class="relative inline-flex items-center px-4 py-2 font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
    &laquo; Previous
</span>

            <a href="#" class="relative inline-flex items-center px-4 py-2 ml-3  font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
    Next &raquo;
</a>
    </div>

<div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
<div>
<p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
    Showing
                            <span class="font-medium">1</span>
        to
        <span class="font-medium">10</span>
                        of
    <span class="font-medium">12</span>
    results
</p>
</div>

<div>
<span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
    
                            <span aria-disabled="true" aria-label="&amp;laquo; Previous">
            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </span>
        </span>
    
    
                            
        
        
                                                                                                        <span aria-current="page">
                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">1</span>
                    </span>
                                                                                                                <a href="#" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 2">
                        2
                    </a>
          <a href="#" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Next &amp;raquo;">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
        </a>
                    </span>
</div>
</div>
</nav>

</div>

</div>
</div>
</div>
</div>


<meta name="csrf-token" content="VpPXFAJnf0Rtjp5Ejpv93dNSNYGO6iMd3Ac8Ddnq">
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
@endsection
<!-- Additional Scripts -->
@push('scripts')
    

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
        const listener = new NotificationListener(1);
        
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
@endpush
