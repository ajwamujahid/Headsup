@extends('layouts.saledashboard')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/css/intlTelInput.css" />
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @endpush

@section('content')
           
    
@php
$title = 'Create Appointment';
$subtitle = 'Schedule a new appointment by filling out the form below.';
@endphp
                    
                    <!-- Page Content -->
                    <main class="flex-1 overflow-y-auto">
                        <div class="py-6">
                            <div class="max-w-full">
                                <div class="py-6">
        <div class="container mx-auto space-y-6 py-6 px-4">

            
            
            <div class="mb-4 flex items-center px-6" style="display: flex; justify-content: end;">
                           <a href="{{ route('salesperson.customer.add') }}" class="bg-gray-800 text-white px-3 py-1.5 rounded">
                               Add Customer
                           </a>
                       </div>
             <div class="flex justify-between items-end space-x-6">
  <!-- Combined Filter Form -->
<form method="GET" action="{{ route('customer.index') }}" class="flex flex-wrap items-end gap-4 mb-6">
    <!-- Search by Name -->
    <div>
        <label for="search" class="block text-md font-medium mb-1 text-gray-700">Select Customer Name</label>
        <select id="search" name="search" class="border border-gray-300 rounded-md px-3 py-2 w-64 h-20 select2">
            <option value="">-- Select Customer --</option>
            @foreach($allCustomers as $customer)
                <option value="{{ $customer->name }}" {{ request('search') == $customer->name ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
    </div>
    

    <!-- From Date -->
    <div style="margin-left:390px; ">
        <label for="from" class="block text-sm font-medium text-gray-700">From Date</label>
        <input
            type="date"
            name="from_date"
            id="from"
            value="{{ request('from_date') }}"
            class="mt-1 block w-36 border-gray-300 rounded-md shadow-sm"
        >
    </div>

    <!-- To Date -->
    <div>
        <label for="to" class="block text-sm font-medium text-gray-700">To Date</label>
        <input
            type="date"
            name="to_date"
            id="to"
            value="{{ request('to_date') }}"
            class="mt-1 block w-36 border-gray-300 rounded-md shadow-sm"
        >
    </div>

    <!-- Submit -->
    <div class="pt-6">
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">
            Filter
        </button>
    </div>
</form>

</div>


            
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
                            @forelse($customers as $customer)
                                <tr class="hover:bg-gray-50">
                                    <td class="border-b px-4 py-2">{{ $customer->name }}</td>
                                    <td class="border-b px-4 py-2">{{ $customer->created_at->format('d M Y h:i A') }}</td>
                                    <td class="border-b px-4 py-2">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-white rounded mr-1 mb-1">
                                        @php
                                            $process = is_array($customer->process) 
                                                ? $customer->process 
                                                : json_decode($customer->process, true);
                                        @endphp
                                        @if ($process)
                                            <ul class="list-disc pl-4 text-sm text-gray-700">
                                                @foreach ($process as $step)
                                                    <li>{{ $step }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                        </
                                    </td>
                                    
                                    <td class="border-b px-4 py-2">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold bg-gray-800 text-white rounded mr-1 mb-1">{{ $customer->disposition ?? '-' }}
                                        </span>
                                        </td>
                                    <td class="border-b px-4 py-2">
                                        {{ $customer->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-gray-500 py-4">No customers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        
                    </table>

                                            <div class="mt-4 px-4 mb-2">
                            <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                    &laquo; Previous
                </span>
            
                            <a href="#" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
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
                    <span class="font-medium">90</span>
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
                                                                                                                                <a href="" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 2">
                                        2
                                    </a>
                                                                                                                                <a href="https://headsup.trevinosauto.com/add/users?page=3" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 3">
                                        3
                                    </a>
                                                                                                                                <a href="https://headsup.trevinosauto.com/add/users?page=4" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 4">
                                        4
                                    </a>
                                                                                                                                <a href="https://headsup.trevinosauto.com/add/users?page=5" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 5">
                                        5
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
        
      
        </div>
@endsection
@push('scripts')
        <!-- Additional Scripts -->
        <script>
            @if(session('no_data_found'))
                Swal.fire({
                    icon: 'info',
                    title: 'No Results',
                    text: '{{ session('no_data_found') }}',
                    confirmButtonText: 'Okay',
                 
                    color: '#0f172a', // Dark blue text
                    iconColor: '#3b82f6', // Custom icon color (blue)
                    confirmButtonColor: '#3b82f6', // Blue confirm button
                    customClass: {
                        popup: 'rounded-lg shadow-lg',
                        title: 'text-lg font-semibold',
                        confirmButton: 'bg-blue-600 text-white px-4 py-2 rounded'
                    }
                });
            @endif
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
       <!-- Before Closing Body -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select a customer",
            allowClear: true,
        });
    });
</script>
@endpush