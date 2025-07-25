@extends('layouts.saledashboard')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/css/intlTelInput.css" />
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @endpush
@section('content')
@php
$title = 'Check-In Activity Report';
$subtitle = 'Overview and detailed breakdown of employee check-in and check-out activities.';
@endphp
                    
                    <!-- Page Content -->
                    <main class="flex-1 overflow-y-auto">
                        <div class="py-6">
                            <div class="max-w-full">
                                <div class="px-6 py-2 space-y-10">




        <!-- ✅ Summary Section -->
        <section>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Activity Records</h3>

                        <p class="text-sm text-gray-600 mb-6">
                Showing all records
            </p>
                    </section>




        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-md">
                <p class="text-sm text-gray-500 mb-1">Total Check-ins</p>
                <h4 class="text-2xl font-semibold text-gray-800">{{ $totalCheckIns }}</h4>

            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-md">
                <p class="text-sm text-gray-500 mb-1">Total Check-outs</p>
                <h4 class="text-2xl font-semibold text-emerald-600">{{ $totalCheckOuts }}</h4>
               
                
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-md">
                <p class="text-sm text-gray-500 mb-1">Total Duration</p>
                <h4 class="text-2xl font-semibold text-rose-600">
                    {{ $hours }} hrs {{ $minutes }} mins
                </h4>
            </div>
        </div>
        </section>

        <!-- ✅ Date Filter Form -->
  <div class="mt-6" style="display: flex; justify-content:end;">
    <form method="GET"  action="{{ route('salesperson.customer.activity-report') }}" class="mb-6">
       @csrf
        <div class="flex items-center space-x-4">
            <div>
                <label for="from" class="block text-sm font-medium text-gray-700">From Date</label>
                <input type="date" name="from" id="from"
    class="mt-1 block w-34 border-gray-300 rounded-md shadow-sm"
    value="{{ request('from') }}">

            </div>
            <div>
                <label for="to" class="block text-sm font-medium text-gray-700">To Date</label>
                <input type="date" name="to" id="to"
                class="mt-1 block w-34 border-gray-300 rounded-md shadow-sm"
                value="{{ request('to') }}">
            
            </div>
            <div class="pt-6">
                <button type="submit"
                    class="bg-gray-800 text-white px-4 py-2 rounded">
                    Filter
                </button>
            </div>
        </div>
    </form>
</div>

<p class="text-sm text-gray-600 mb-6">
    @if(request('from') && request('to'))
        Showing records from <strong>{{ request('from') }}</strong> to <strong>{{ request('to') }}</strong>
    @else
        Showing all records
    @endif
</p>

        <!-- ✅ Detailed Report Section -->
        <section>
            <div class="overflow-x-auto rounded-lg shadow border border-gray-200 mt-5">
                <table class="min-w-full bg-white divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border-b px-4 py-2 text-left">Check-In Time</th>
                            <th class="border-b px-4 py-2 text-left">Check-Out Time</th>
                            <th class="border-b px-4 py-2 text-left">Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activities as $activity)
<tr>
    <td class="border-b px-4 py-2">
        {{ \Carbon\Carbon::parse($activity->check_in_time)->format('d M Y h:i A') }}
    </td>
    <td class="border-b px-4 py-2">
        {{ $activity->check_out_time ? \Carbon\Carbon::parse($activity->check_out_time)->format('d M Y h:i A') : 'N/A' }}
    </td>
    <td class="border-b px-4 py-2">
        @if ($activity->check_in_time && $activity->check_out_time)
            {{ \Carbon\Carbon::parse($activity->check_in_time)->diffInMinutes(\Carbon\Carbon::parse($activity->check_out_time)) }} min
        @else
            N/A
        @endif
    </td>
</tr>
@empty

    <tr>
        <td colspan="3" class="px-6 py-6 text-center text-gray-500">
            No records found for selected date range.
        </td>
    </tr>
    

@endforelse

                                            </tbody>
                </table>
            </div>
        </section>

    </div>
    <!-- SweetAlert Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        const listener = new NotificationListener(14);
                        
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