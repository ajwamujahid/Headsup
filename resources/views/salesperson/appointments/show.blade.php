@extends('layouts.appointment')

@section('content')
@php
$title = 'Appointments';
$subtitle = 'View the record of Appointment.';
@endphp
    <!-- Page Content -->
    <main class="flex-1 overflow-y-auto">
        <div class="py-6">
            <div class="max-w-full">
                <div class="py-6">
<div class="container mx-auto space-y-6 py-6 px-4">

<div>
<div class="overflow-x-auto rounded-lg shadow border border-gray-200">
    <table class="min-w-full bg-white divide-y divide-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border-b px-4 py-2 text-left">Customer Name</th>
                <th class="border-b px-4 py-2 text-left">Assigned At</th>
                <th class="border-b px-4 py-2 text-left">Activities</th>
                <th class="border-b px-4 py-2 text-left">Disposition</th>
                <th class="border-b px-4 py-2 text-left">Duration</th>
            </tr>
        </thead>
      
        <tbody>
            @forelse($appointments as $appointment)
                @if($appointment->status === 'completed')
                <tr>
                    <td class="border-b px-4 py-3">
                        <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">
                            {{ $appointment->customer_name ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="border-b px-4 py-3">
                        <span class="inline-block px-2 py-1 text-xs font-semibold bg-gray-800 text-white rounded">
                            {{ $appointment->created_at->format('d M Y h:i A') }}
                        </span>
                    </td>
                    <td class="border-b px-4 py-3">
                        {{ $appointment->activities ?? 'N/A' }}
                    </td>
                    <td class="border-b px-4 py-3">
                        {{ $appointment->disposition ?? 'N/A' }}
                    </td>
                    <td class="border-b px-4 py-3">
                        {{ $appointment->duration ?? 'N/A' }}
                    </td>
                </tr>
                @endif
            @empty
                <tr>
                    <td colspan="5" class="text-center text-sm text-gray-500 py-4">
                        No appointments found.
                    </td>
                </tr>
            @endforelse
        </tbody>
        
    </table>

                    </div>
</div>
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
@endsection
@push('scripts')
    

<!-- Additional Scripts -->
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