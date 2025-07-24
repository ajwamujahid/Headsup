@extends('layouts.app')

@section('content')
                    
                    <!-- Page Content -->
                    <main class="flex-1 overflow-y-auto">
                        <div class="py-6">
                            <div class="max-w-full">
                                <div class="py-12">
        <div class="container mx-auto space-y-6 py-6 px-4">

            <!-- Stats Grid -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                <!-- Total Sales Person -->
                <div class="p-4 rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="mb-2 text-sm font-medium text-muted-foreground">Total Sales Persons</p>
                            <p class="text-lg font-semibold text-foreground">{{ $totalSalespersons }}</p>
                            
                        </div>
                    </div>
                </div>

                <!-- Total Customers -->
                <div class="p-4 rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="mb-2 text-sm font-medium text-muted-foreground">Total Customers</p>
                            <p class="text-lg font-semibold text-foreground">{{ $totalCustomers }}</p>
                                
                        </div>
                    </div>
                </div>

                <!-- Total Appointments -->
                <div class="p-4 rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="flex items-center">
                       <div class="p-3 rounded-full bg-primary/10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="mb-2 text-sm font-medium text-muted-foreground">Total Appointments</p>
                            <p class="text-lg font-semibold text-foreground">{{ $totalAppointments }}</p>
                                  
                        </div>
                    </div>
                </div>

                <!-- Sold Customers -->
                <div class="p-4 rounded-lg border bg-card text-card-foreground shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M18 8a6 6 0 00-12 0v2a3 3 0 003 3h1m6-5v5a2 2 0 002 2h1a3 3 0 003-3v-1a6 6 0 00-6-6zM8 14h.01M8 14a4 4 0 014-4h4a2 2 0 012 2v2a4 4 0 01-4 4h-4a4 4 0 01-4-4z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="mb-2 text-sm font-medium text-muted-foreground">Sold Customers</p>
                            <p class="text-lg font-semibold text-foreground">0</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Grid (without Sales Person Growth) -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-2">
                <div class="p-4 rounded-lg border bg-card text-card-foreground shadow-sm">
                    <h3 class="mb-4 text-lg font-semibold text-foreground">Customer Count Over Time</h3>
                    <div class="h-64" id="customerChart"></div>
                </div>

                <div class="p-4 rounded-lg border bg-card text-card-foreground shadow-sm">
                    <h3 class="mb-4 text-lg font-semibold text-foreground">Appointments Over Time</h3>
                    <div class="h-64" id="appointmentChart"></div>
                </div>

                <div class="p-4 rounded-lg border bg-card text-card-foreground shadow-sm">
                    <h3 class="mb-4 text-lg font-semibold text-foreground">Sold Customers Ratio</h3>
                    <div class="h-64" id="soldCustomerChart"></div>
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
                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            const monthLabels = ["Feb","Mar","Apr","May","Jun","Jul"];

            new ApexCharts(document.querySelector("#customerChart"), {
                series: [{
                    name: 'Customers',
                    data: [0,0,0,0,0,3]
                }],
                chart: {
                    type: 'line',
                    height: 250,
                    background: 'transparent',
                    foreColor: '#a1a1aa'
                },
                stroke: {
                    curve: 'smooth',
                    colors: ['#10b981']
                },
                xaxis: {
                    categories: monthLabels,
                    labels: { style: { colors: '#a1a1aa' } }
                },
                theme: { mode: 'dark' }
            }).render();

            new ApexCharts(document.querySelector("#appointmentChart"), {
                series: [{
                    name: 'Appointments',
                    data: [0,0,0,0,0,0]
                }],
                chart: {
                    type: 'area',
                    height: 250,
                    background: 'transparent',
                    foreColor: '#a1a1aa'
                },
                fill: {
                    gradient: { opacityFrom: 0.4, opacityTo: 0.1 }
                },
                stroke: {
                    curve: 'smooth',
                    colors: ['#8b5cf6']
                },
                xaxis: {
                    categories: monthLabels,
                    labels: { style: { colors: '#a1a1aa' } }
                },
                theme: { mode: 'dark' }
            }).render();

            new ApexCharts(document.querySelector("#soldCustomerChart"), {
                series: Object.values({"Sold":0,"Unsold":3}),
                chart: {
                    type: 'donut',
                    height: 250,
                    background: 'transparent',
                    foreColor: '#a1a1aa'
                },
                labels: Object.keys({"Sold":0,"Unsold":3}),
                colors: ['#22c55e', '#ef4444'],
                legend: {
                    position: 'bottom',
                    labels: { colors: '#a1a1aa' }
                },
                theme: { mode: 'dark' }
            }).render();
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