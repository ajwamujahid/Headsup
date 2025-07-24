@extends('layouts.app')

@section('content')
                    
                    <!-- Page Content -->
                    <main class="flex-1 overflow-y-auto">
                        <div class="py-6">
                            <div class="max-w-full">
                                <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Profile Information
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Update your account&#039;s profile information and email address.
        </p>
    </header>

    {{-- <form id="send-verification" method="post" action="https://headsup.trevinosauto.com/email/verification-notification"> --}}
        <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('PATCH')
        
        <input type="hidden" name="_token" value="5Pf3DBc0qYGIaqtTzDl7oaaqLx72Xbjp1qqCKoIt" autocomplete="off">        <input type="hidden" name="_method" value="patch">
        <div>
            <label class="block font-medium text-sm text-gray-700" for="name">
    Name
</label>
            <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="name" name="name" type="text" value="Admin" required="required" autofocus="autofocus" autocomplete="name">
                    </div>

        <div>
            <label class="block font-medium text-sm text-gray-700" for="email">
    Email
</label>
            <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="email" name="email" type="email" value="admin@admin.com" required="required" autocomplete="username">
            
                    </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
    Save
</button>

                    </div>
    </form>
</section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Update Password
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')
    
   
       <div>
            <label class="block font-medium text-sm text-gray-700" for="update_password_current_password">
    Current Password
</label>
            <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="update_password_current_password" name="current_password" type="password" autocomplete="current-password">
                    </div>

        <div>
            <label class="block font-medium text-sm text-gray-700" for="update_password_password">
    New Password
</label>
            <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="update_password_password" name="password" type="password" autocomplete="new-password">
                    </div>

        <div>
            <label class="block font-medium text-sm text-gray-700" for="update_password_password_confirmation">
    Confirm Password
</label>
            <input  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                    </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
    Save
</button>

                    </div>
    </form>
</section>
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