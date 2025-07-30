@extends('layouts.appointment')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/css/intlTelInput.css" />
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @endpush
@section('content')

@php
$title = 'Update Appointment';
$subtitle = 'Update appointment details and status using the form below. ';
@endphp
    
    <!-- Page Content -->
    <main class="flex-1 overflow-y-auto">
        <div class="py-6">
            <div class="max-w-full">
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


<div class="">
<div class="max-w-full mx-auto sm:px-6 lg:px-8">
<div class="bg-white shadow rounded-lg p-6">

    <form method="POST" action="{{ route('appointments.update', $appointment->id) }}" id="updateForm">

@csrf
@method('PUT')
   
    <!-- Customer Information -->
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Customer Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <label class="block text-sm font-medium text-gray-700">Customer Name</label>
            <input name="customer_name" value="{{ $appointment->customer_name }}"

                required
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input name="customer_phone" id="phone" name="phone" type="tel" placeholder="" required style="width: 500px;" class="mt-1 block  rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            value="{{ $appointment->phone }}" required
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>
    </div>

    <!-- Appointment Schedule -->
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Appointment Schedule</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <label class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" name="date" value="{{ $appointment->date }}"  required
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Time</label>
            <input type="time" name="time" value="{{ $appointment->time }}"  required
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>
    </div>
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Salesperson</h3>
    <div class="mb-8">
        <label class="block text-sm font-medium text-gray-700">Select Salesperson</label>
    
        @if($loggedInSalesperson)
        <select disabled class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                <option value="{{ $loggedInSalesperson->id }}" selected>
                    {{ $loggedInSalesperson->name }}
                </option>
            </select>
            <input type="hidden" name="salesperson_id" value="{{ $loggedInSalesperson->id }}">
        @else
            <p class="text-red-500">No salesperson logged in.</p>
        @endif
    </div>
    


    <!-- Notes -->
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Additional Notes</h3>
    <div class="mb-8">
        <label class="block text-sm font-medium text-gray-700">Notes</label>
        <textarea name="notes"
            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $appointment->notes }}</textarea>
    </div>

    <!-- Status -->
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Appointment Status</h3>
    <div class="mb-8">
        <label class="block text-sm font-medium text-gray-700">Select Status</label>
        <select name="status" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="scheduled" {{ $appointment->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
            <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="canceled" {{ $appointment->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
        </select>
    </div>

    <!-- Submit -->
    <div class="flex justify-end">
        <button type="submit"
            class="bg-gray-800 text-white px-3 py-1.5 rounded ">
            Update Appointment
        </button>
    </div>
</form>

</div>
</div>
</div>

    

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('updateForm').addEventListener('submit', function (e) {
e.preventDefault(); // Prevent normal form submit

const form = e.target;
const formData = new FormData(form);
const actionUrl = form.action;
fetch(actionUrl, {
  method: 'POST',
  headers: {
    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
    'Accept': 'application/json',
  },
  body: formData,
})
.then(async response => {
  if (!response.ok) {
    const errorText = await response.text();
    throw new Error(errorText); // This will go to .catch()
  }

  return response.json();
})
.then(data => {
  if (data.status === 'success') {
    Swal.fire({
      icon: 'success',
      title: 'Updated!',
      text: data.message,
      confirmButtonColor: '#111827',
    }).then(() => {
      window.location.href = data.redirect;
    });
  } else {
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: data.message || 'Something went wrong!',
    });
  }
})
.catch(error => {
  console.error("Error occurred:", error);
  Swal.fire({
    icon: 'error',
    title: 'Validation Error',
    text: 'Please check your input and try again. See console for details.',
  });
});

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

    const form = document.querySelector("#updateForm");
    form.addEventListener("submit", function () {
        input.value = iti.getNumber(); // sets hidden full number
    });
});

</script>
@endpush