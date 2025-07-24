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
                <style>
.swal2-confirm {
background-color: #111827 !important;
color: #fff !important;
box-shadow: none !important;
}

.swal2-confirm:hover,
.swal2-confirm:focus,
.swal2-confirm:active {
background-color: #111827 !important;
color: #fff !important;
box-shadow: none !important;
}

</style>

<div class="">
<!-- Page Heading -->
<div class="max-w-full mx-auto sm:px-6 lg:px-8">
<div class="bg-white shadow rounded-lg p-6">
<form id="appointment-form" action="{{ route('salesperson.appointments.store') }}">
   @csrf
    <!-- Section: Customer Information -->
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Customer Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <label class="block text-sm font-medium text-gray-700">Customer Name</label>
            <input name="customer_name" placeholder="Customer Name" required
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label for="phone" class="block  text-sm font-medium text-gray-700">Phone Number</label>
            <input id="phone" name="phone" type="tel" placeholder="" required style="width: 500px;" class="mt-1 block  rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>
        
    </div>

    <!-- Section: Appointment Schedule -->
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Appointment Schedule</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <label class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" name="date" id="date" required
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Time</label>
            <input type="time" name="time" id="time" required
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>
    </div>

                            <!-- Section: Salesperson -->
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Salesperson</h3>
        <div class="mb-8">
            <label class="block text-sm font-medium text-gray-700">Select Salesperson</label>
            <select name="salesperson_id"  class="select2 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value=""> Select Salesperson</option>
                @foreach($salespersons as $salesperson)
                    <option value="{{ $salesperson->id }}">{{ $salesperson->name }}</option>
                @endforeach
            </select>
        </div>
        

    <!-- Section: Notes -->
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Additional Notes</h3>
    <div class="mb-8">
        <label class="block text-sm font-medium text-gray-700">Notes</label>
        <textarea name="notes" placeholder="Notes"
            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
    </div>

    <!-- Submit Button -->
    <div style="display: flex; justify-content:end;">
        <button type="submit" style="margin-top: auto;"
            class="text-white px-3 py-1.5 rounded bg-gray-800">
            Book Appointment
        </button>
    </div>

</form>
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
<!-- Additional Scripts -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('appointment-form');
    
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(form);
    
            fetch("{{ route('salesperson.appointments.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) return response.json().then(err => Promise.reject(err));
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    html: data.message,
                    timer: 2000,
                    showConfirmButton: false
                });
                setTimeout(() => {
                    window.location.href = data.redirect ?? window.location.href;
                }, 2000);
            })
            .catch(error => {
                console.error('Request error:', error); // for debugging
    
                let errorMsg = "Something went wrong.";
                if (error?.errors) {
                    errorMsg = Object.values(error.errors).flat().join("<br>");
                } else if (error?.error) {
                    errorMsg = error.error;
                }
    
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: errorMsg
                });
            });
        });
    });
    </script>
    
    

<script>
window.onload = function () {
const now = new Date();
const year = now.getFullYear();
const month = String(now.getMonth() + 1).padStart(2, '0');
const day = String(now.getDate()).padStart(2, '0');
const today = `${year}-${month}-${day}`;

const dateInput = document.getElementById('date');
dateInput.setAttribute('min', today);
};
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Select saleperson",
            allowClear: true,
            width: '100%'
        });
    });
</script>

@endpush