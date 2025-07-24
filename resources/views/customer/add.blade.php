@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/css/intlTelInput.css" />
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @endpush

@section('content')
@php
$title = 'Customer Sales Form';
$subtitle = 'Fill out the details below to log a customer sales interaction.';
@endphp
        
    
                    
                    <!-- Page Content -->
                    <main class="flex-1 overflow-y-auto">
                        <div class="py-6">
                            <div class="max-w-full">
                                <!-- Tailwind CSS CDN (v3) -->
<script src="https://cdn.tailwindcss.com"></script>
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
   
  <div class="px-4">
     <div id="formContainer">
      <form id="salesForm" method="POST" action="{{ route('customers.store') }}"
        class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white rounded-2xl border border-gray-200 p-8 shadow-lg">
       @csrf
        <div class="md:col-span-2">
          <h3 class="text-2xl font-bold text-gray-800 leading-tight mb-0">Customer Sales Form</h3>
          {{-- <p class="text-gray-500 mt-0 leading-tight">Fill out the details below to log a customer sales interaction.</p> --}}
        </div>

        <!-- Customer Info -->
        <div class="space-y-4">
                    <div>
            <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">Name</label>
            <input
              id="nameInput"
              name="name"
              type="text"
              class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"
            />
          </div>
                    <div>
            <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">Email</label>
            <input
              id="emailInput"
              name="email"
              type="email"
              class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"
            />
          </div>
                    <div>
                      <label for="phone" class="block  text-sm font-medium text-gray-700">Phone Number</label>
                      
                    
                         
                          <input  class="pl-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" style="width:530px;" id="phone" name="phone" type="tel" placeholder="" required style="width: 500px;" class="mt-1 block  rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                   
          </div>
                    <div>
            <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">Interest</label>
            <input
              id="interestInput"
              name="interest"
              type="text"
              class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"
            />
          </div>
                  </div>

        <!-- Sales Details -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
            <textarea name="notes" rows="6" class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"></textarea>
          </div>

          <fieldset class="border border-gray-300 rounded-xl p-4">
            <legend class="text-sm font-semibold text-gray-700 mb-3">Sales Process</legend>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                            <label class="flex items-center space-x-2">
                <input type="checkbox" name="process[]" value="Investigating"
                  
                  class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 text-sm">Investigating</span>
              </label>
                            <label class="flex items-center space-x-2">
                <input type="checkbox" name="process[]" value="Test Driving"
                  
                  class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 text-sm">Test Driving</span>
              </label>
                            <label class="flex items-center space-x-2">
                <input type="checkbox" name="process[]" value="Desking"
                  
                  class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 text-sm">Desking</span>
              </label>
                            <label class="flex items-center space-x-2">
                <input type="checkbox" name="process[]" value="Credit Application"
                  
                  class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 text-sm">Credit Application</span>
              </label>
                            <label class="flex items-center space-x-2">
                <input type="checkbox" name="process[]" value="Penciling"
                  
                  class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 text-sm">Penciling</span>
              </label>
                            <label class="flex items-center space-x-2">
                <input type="checkbox" name="process[]" value="F&amp;I"
                  
                  class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 text-sm">F&amp;I</span>
              </label>
                          </div>
          </fieldset>

          <!-- Disposition Modal -->
          <div id="customerModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white p-6 rounded-xl w-full max-w-2xl relative">
              <button type="button" id="closeModalBtn" class="absolute top-3 right-3 text-gray-500 hover:text-black text-xl font-bold">&times;</button>
              <fieldset class="border border-gray-300 rounded-xl p-4">
                <legend class="text-sm font-semibold text-gray-700 mb-3">Disposition</legend>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Sold!"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Sold!</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Walked Away"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Walked Away</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Challenged Credit"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Challenged Credit</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Didn&#039;t Like Vehicle"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Didn&#039;t Like Vehicle</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Didn&#039;t Like Price"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Didn&#039;t Like Price</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Didn&#039;t Like Finance Terms"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Didn&#039;t Like Finance Terms</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Insurance Expensive"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Insurance Expensive</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Wants to keep looking"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Wants to keep looking</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Wants to think about it"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Wants to think about it</span>
                  </label>
                                    <label class="flex items-center space-x-2">
                    <input type="radio" name="disposition" value="Needs Co-Signer"
                      
                      class="form-radio h-5 w-5 text-indigo-600">
                    <span class="text-gray-700 text-sm">Needs Co-Signer</span>
                  </label>
                                  </div>
              </fieldset>
              <div class="text-right mt-4">
                <button type="submit" class="bg-gray-800 text-white px-3 py-1.5 rounded">Save</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Triggers -->
        <div class="md:col-span-2 text-right mt-4">
          <button id="openModalBtn" type="button" class="bg-gray-800 text-white px-3 py-1.5 rounded">Close</button>
          <button type="button" id="toBtn" class="relative bg-gray-800 text-white px-4 py-1.5 rounded">
            <span class="btn-label">T/O</span>
            <div class="toSpinner hidden absolute inset-0 bg-black/50 flex items-center justify-center z-10 rounded">
              <div class="w-6 h-6 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
            </div>
          </button>
        </div>
      </form>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('customerModal');
    const salesForm = document.getElementById('salesForm');

    // Modal toggle
    openModalBtn?.addEventListener('click', () => modal.classList.remove('hidden'));
    closeModalBtn?.addEventListener('click', () => modal.classList.add('hidden'));
    window.addEventListener('click', (e) => {
      if (e.target === modal) modal.classList.add('hidden');
    });

    // ✅ AJAX form submit with Swal
    salesForm?.addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(this);
      const url = this.action;

      fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        },
        body: formData,
      })
      .then(res => res.json())
      .then(data => {
      if (data.status === 'success') {
  Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                confirmButtonColor: '#111827',
            }).then(() => {
                window.location.href = data.redirect;
            });

  modal.classList.add('hidden');
  salesForm.reset();
}
 else {
          Swal.fire('Error', 'Something went wrong!', 'error');
        }
      })
      .catch(err => {
        Swal.fire('Error', 'Request failed!', 'error');
        console.error(err);
      });
    });
  });
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