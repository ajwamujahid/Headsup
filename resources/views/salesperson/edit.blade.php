@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/css/intlTelInput.css" />
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @endpush
@section('content')
@php
$title = 'Edit User';
$subtitle = 'Add a new Sale Person to the system.';
@endphp
 <!-- Page Content -->
 <main class="flex-1 overflow-y-auto">
    <div class="py-6">
        <div class="max-w-full">
            <style>
:root {
--swal2-confirm-button-background-color: #111827;
--swal2-confirm-button-color: #fff;
--swal2-confirm-button-border-radius: 0.25em;
--swal2-action-button-focus-box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.5);
--swal2-width: 32em;
--swal2-border-radius: 0.3125rem;
--swal2-background: #fff;
--swal2-color: #545454;
}

div.swal2-container button.swal2-styled:not([disabled]) {
cursor: pointer;
}

div.swal2-container button.swal2-confirm {
background-color: var(--swal2-confirm-button-background-color);
color: var(--swal2-confirm-button-color);
border-radius: var(--swal2-confirm-button-border-radius);
box-shadow: var(--swal2-confirm-button-box-shadow);
}

div.swal2-container button.swal2-styled {
margin: 0.3125em;
padding: 0.625em 1.1em;
border: none;
font-weight: 500;
transition: background-color 0.2s, box-shadow 0.2s;
}

div.swal2-container div.swal2-popup {
display: flex;
flex-direction: column;
box-sizing: border-box;
width: var(--swal2-width);
max-width: 100%;
padding: 1.25em;
background: var(--swal2-background);
color: var(--swal2-color);
border-radius: var(--swal2-border-radius);
}

</style>


<div class="px-6">

    <form id="updateUserForm" 
    method="POST" 
    action="{{ route('salesperson.update', $salesperson->id) }}"
    class="bg-white shadow rounded-lg p-6" 
    data-id="{{ $salesperson->id }}">
  @csrf
  @method('PUT')

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<!-- Name -->
<div class="relative">
<label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
         viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.121 17.804A9 9 0 1118.88 6.196 9 9 0 015.121 17.804z"/>
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
    </svg>
</span>
<input type="text" name="name" id="name"
    value="{{ old('name', $salesperson->name) }}"
    class="pl-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
    placeholder="Enter name" required />

</div>
</div>

<!-- Email -->
<div class="relative">
<label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
         viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0zM4 6h16M4 6v12h16V6M4 6l8 6 8-6"/>
    </svg>
</span>
<input type="email" name="email" id="email"
    value="{{ old('email', $salesperson->email) }}"
    class="pl-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
    placeholder="Enter email" required />

</div>
</div>

<!-- Password -->
<div class="relative">
<label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
         viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z"/>
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M19 21H5a2 2 0 01-2-2v-2a7 7 0 0114 0v2a2 2 0 01-2 2z"/>
    </svg>
</span>
<input type="password" name="password" id="password"
       class="pl-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
       placeholder="Enter password"   />
</div>
</div>

<!-- Confirm Password -->
<div class="relative">
<label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
         viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z"/>
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M19 21H5a2 2 0 01-2-2v-2a7 7 0 0114 0v2a2 2 0 01-2 2z"/>
    </svg>
</span>
<input type="password" name="password_confirmation" id="password_confirmation"
       class="pl-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
       placeholder="Confirm password"  />
</div>
</div>
<div class="relative">
<label for="role" class="block text-sm font-medium text-gray-700 mb-1">User Type</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round"
  d="M4 6h16M4 12h16M4 18h16" />
</svg>
</span>
<select name="role" id="role" required
    class="pl-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
    <option value="Sales Manager" {{ $salesperson->role === 'Sales Manager' ? 'selected' : '' }}>
        Sales Manager
    </option>
    <option value="Sales Person" {{ $salesperson->role === 'Sales Person' ? 'selected' : '' }}>
        Sales Person
    </option>
</select>


</div>
</div>


<!-- Phone Number -->
<div class="" >
<label for="phone"  class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
<input id="phone"  style="width:510px;" name="phone" type="tel" placeholder=""  class="pl-20 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" value="{{ old('phone', $salesperson->phone) }}" required style="width: 365px;" class="mt-1 block  rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
</div>

</div>



<!-- Submit Button -->
<div class="mt-6" style="display:flex; justify-content: end;">
<button type="submit" style="background-color: #111827;"
class="bg-gray-800 text-white px-3 py-1.5 rounded">
Update
</button>
</div>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

<script>
document.getElementById('updateUserForm').addEventListener('submit', async function (e) {
e.preventDefault();

const form = e.target;
const formData = new FormData(form);
const userId = form.getAttribute('data-id');
const actionUrl = form.getAttribute('action');


try {
const response = await fetch(actionUrl, {
method: 'POST',
headers: {
'Accept': 'application/json',
'X-CSRF-TOKEN': '{{ csrf_token() }}'
},
body: formData
});

const result = await response.json();

if (response.ok) {
Swal.fire({
icon: 'success',
title: 'Success',
text: result.message || 'User updated successfully.',
confirmButtonColor: '#111827'
}).then(() => {
    window.location.href = "{{ route('salesperson.index') }}";

});
} else {
let msg = result.message || 'Something went wrong.';
if (result.errors) {
msg =Object.values(result.errors).flat().join('\n');
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: msg,
                    confirmButtonColor: '#d33'
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: error.message || 'Unexpected error occurred.',
                confirmButtonColor: '#d33'
            });
        }
    });
</script>
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

  
    
      @endpush