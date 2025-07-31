@extends('layouts.saledashboard')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/css/intlTelInput.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
<style>
 .custom-cancel-btn {
    background-color: #d1d5db !important;
    color: #111827 !important;
    font-weight: normal;
    padding: 8px 20px;
    font-size: 15px;
    border-radius: 5px;
}

  .custom-transfer-btn {
    background-color: black !important;
    color: #fff !important;
    border-radius: 6px;
    padding: 8px 20px;
    font-size: 15px;
}
.customer-card {
  transition: all 0.3s ease;
}

.customer-card:hover {
  animation: pulseActive 1s infinite;
  border-color: #6366f1;
  box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
}

@keyframes pulseActive {
  0% { box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.5); }
  70% { box-shadow: 0 0 0 10px rgba(99, 102, 241, 0); }
  100% { box-shadow: 0 0 0 0 rgba(99, 102, 241, 0); }
}
</style>


   @section('content')
     <!-- Page Content -->
     {{-- <p style="color:red">Your ID: {{ session('sales_id') }}</p>
     <p id="isMyTurnText" style="color:blue">Is It Your Turn? <span id="isMyTurnValue">{{ $isMyTurn ? 'true' : 'false' }}</span></p> --}}

     {{-- @if ($checkin && $checkin->pending_customers_count > 0)
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        ⚠️ You have {{ $checkin->pending_customers_count }} pending customers. Please transfer them before checkout.
    </div>
@endif --}}


                    <main class="flex-1 overflow-y-auto">
                        <div class="py-6">
                            <div class="max-w-full">
                                <div class="w-full grid grid-cols-1 xl:grid-cols-4 gap-6 px-4 mt-4">
    <!-- LEFT SIDE: Customer Form -->
   <div class="xl:col-span-3  overflow-visible">
  <div id="formContainer">
    <form id="salesForm" method="POST" action="{{ route('sales.store.customer') }}" class=" grid grid-cols-1 md:grid-cols-2 gap-8 bg-white rounded-2xl border border-gray-200 p-8 shadow-lg">
     @csrf
<div class="md:col-span-2">
  <h3 class="text-2xl font-bold text-gray-800 leading-tight mb-0">Customer Sales Form</h3>
  <p class="text-gray-500 mt-0 leading-tight">Fill out the details below to log a customer sales interaction.</p>
</div>
  <!-- Customer Info -->
<div class="space-y-4">
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">Name</label>
      <input id="nameInput" name="name" type="text" class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full" />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">Email</label>
       <input id="emailInput" name="email" type="email" class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full" />
    </div>
    <div>
      
        <label for="phone" class="block  text-sm font-medium text-gray-700">Phone Number</label>
        <input id="phone" name="phone" type="tel" placeholder="" required style="width: 365px;" class="mt-1 block  rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
    </div>
    
      {{-- <label for="phone" class="block text-sm font-medium text-gray-700 mb-1 capitalize">Phone</label>
      <input id="phoneInput" name="phone" type="tel" class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full" />
    </div> --}}
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1 capitalize"> Interest </label>
      <input id="interestInput" name="interest" type="text" class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full" />
    </div>
  </div>
      <!-- Sales Details -->
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
          <textarea name="notes" rows="6"
            class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"></textarea>
        </div>
        <fieldset class="border border-gray-300 rounded-xl p-4">
          <legend class="text-sm font-semibold text-gray-700 mb-3">Sales Process</legend>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
            <label class="flex items-center space-x-2">
              <input type="checkbox" name="process[]" value="Investigating" class="form-checkbox h-5 w-5 text-indigo-600">
              <span class="text-gray-700 text-sm">Investigating</span>
            </label>
              <label class="flex items-center space-x-2">
              <input type="checkbox" name="process[]" value="Test Driving" class="form-checkbox h-5 w-5 text-indigo-600">
              <span class="text-gray-700 text-sm">Test Driving</span>
            </label>
            <label class="flex items-center space-x-2">
              <input type="checkbox" name="process[]" value="Desking" class="form-checkbox h-5 w-5 text-indigo-600">
              <span class="text-gray-700 text-sm">Desking</span>
            </label>
              <label class="flex items-center space-x-2">
              <input type="checkbox" name="process[]" value="Credit Application" class="form-checkbox h-5 w-5 text-indigo-600">
              <span class="text-gray-700 text-sm">Credit Application</span>
            </label>
             <label class="flex items-center space-x-2">
              <input type="checkbox" name="process[]" value="Penciling" class="form-checkbox h-5 w-5 text-indigo-600">
              <span class="text-gray-700 text-sm">Penciling</span>
            </label>
             <label class="flex items-center space-x-2">
              <input type="checkbox" name="process[]" value="F&amp;I" class="form-checkbox h-5 w-5 text-indigo-600">
              <span class="text-gray-700 text-sm">F&amp;I</span> </label>
              </div>
        </fieldset>

        <!-- Disposition Modal -->
        <div id="customerModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
          <div class="bg-white p-6 rounded-xl w-200 relative">
            <button type="button" id="closeModalBtn"
              class="absolute top-3 right-3 text-gray-500 hover:text-black text-xl font-bold">&times;</button>

            <fieldset class="border border-gray-300 rounded-xl p-4">
              <legend class="text-sm font-semibold text-gray-700 mb-3">Disposition</legend>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                <label class="flex items-center space-x-2">
                  <input type="radio" name="disposition" value="Sold!"
                    
                    class="form-radio h-5 w-5 text-indigo-600">
                  <span class="text-gray-700 text-sm">Sold!</span>
                </label>
                  <label class="flex items-center space-x-2">
                  <input type="radio" name="disposition" value="Walked Away" class="form-radio h-5 w-5 text-indigo-600">
                  <span class="text-gray-700 text-sm">Walked Away</span>
                </label>
                  <label class="flex items-center space-x-2">
                  <input type="radio" name="disposition" value="Challenged Credit" class="form-radio h-5 w-5 text-indigo-600">
                  <span class="text-gray-700 text-sm">Challenged Credit</span>
                </label>
               <label class="flex items-center space-x-2">
                  <input type="radio" name="disposition" value="Didn&#039;t Like Vehicle" class="form-radio h-5 w-5 text-indigo-600">
                  <span class="text-gray-700 text-sm">Didn&#039;t Like Vehicle</span>
                </label>
                  <label class="flex items-center space-x-2">
                  <input type="radio" name="disposition" value="Didn&#039;t Like Price" class="form-radio h-5 w-5 text-indigo-600">
                  <span class="text-gray-700 text-sm">Didn&#039;t Like Price</span>
                </label>
                 <label class="flex items-center space-x-2">
                  <input type="radio" name="disposition" value="Didn&#039;t Like Finance Terms" class="form-radio h-5 w-5 text-indigo-600">
                  <span class="text-gray-700 text-sm">Didn&#039;t Like Finance Terms</span>
                </label>
                <label class="flex items-center space-x-2">
                  <input type="radio" name="disposition" value="Insurance Expensive" class="form-radio h-5 w-5 text-indigo-600">
                  <span class="text-gray-700 text-sm">Insurance Expensive</span>
                </label>
                  <label class="flex items-center space-x-2">
                  <input type="radio" name="disposition" value="Wants to keep looking" class="form-radio h-5 w-5 text-indigo-600">
                  <span class="text-gray-700 text-sm">Wants to keep looking</span>
                </label>
                  <label class="flex items-center space-x-2">
                  <input type="radio" name="disposition" value="Wants to think about it" class="form-radio h-5 w-5 text-indigo-600">
                  <span class="text-gray-700 text-sm">Wants to think about it</span>
                </label>
                 <label class="flex items-center space-x-2">
                  <input type="radio" name="disposition" value="Needs Co-Signer" class="form-radio h-5 w-5 text-indigo-600">
                  <span class="text-gray-700 text-sm">Needs Co-Signer</span>
                </label>
              </div>
            </fieldset>

            <div class="text-right mt-4" id="modal">
              <button type="button" id="modalSaveBtn" class="bg-gray-800 text-white px-3 py-1.5 rounded">Save</button>

            </div> 
          </div>
        </div>
      </div>

      <!-- Modal Trigger -->
      <div class="md:col-span-2 text-right mt-4">
       <button id="openModalBtn"  type="button" class="bg-gray-800 text-white px-3 py-1.5 rounded"> Close </button>
<!-- Hidden Input to Hold Customer ID -->
@foreach ($customers as $customer)
<input type="hidden" id="currentCustomerId" value="{{ $customer->id }}">
@endforeach
<!-- T/O Button -->
<button id="toBtn" type="button"
    class="bg-gray-800 text-white px-4 py-1.5 rounded">
    T/O
</button>



      </div>
    </form>
  </div>
</div>

<!-- RIGHT SIDE -->
<div class="xl:col-span-1 flex flex-col h-[calc(100vh-10rem)]">
  <div class="bg-white rounded-xl shadow p-3 w-full max-w-md mx-auto space-y-4 border mb-4">
    <!-- Status + Button -->
    <div class="flex items-center justify-between">
     <span class="status-text text-sm font-semibold px-3 py-1.5 rounded-md flex items-center gap-2 bg-red-100 text-red-700">
<!-- X Icon -->
<svg class="w-4 h-4 text-red-700" fill="none" stroke="currentColor" stroke-width="2"
     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
</svg>
Checked Out
</span>


      <form id="checkToggleForm" action="{{ route('sales.check.toggle') }}" method="POST">
      @csrf
         <button type="submit"
          id="checkToggleButton" 
          class="check-toggle-btn px-4 py-1.5 text-sm mt-4 font-semibold flex items-center gap-2 rounded-md text-white 
          bg-green-500">
          <span class="btn-text">Check In</span>
         
            <circle class="opacity-25" cx="12" cy="12" r="10"
              stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
              d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 010 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z" />
          </svg>
        </button>
      </form>
    </div>

   <!-- Time Info -->
<div class="text-left space-y-1">
  <p class="text-xs text-gray-600"><strong>Check In:</strong> <span id="check-in-time">N/A</span></p>
  <p class="text-xs text-gray-600"><strong>Check Out:</strong> <span id="check-out-time">N/A</span></p>
  <p class="text-xs text-gray-600" id="duration-wrapper"><strong>Duration:</strong> <span id="duration">0 min</span></p>
</div>


    <div>
      
     <input type="hidden" id="currentUserId" value="{{ session('sales_id') }}">
     <button id="takeCustomerBtn"  type="button" data-checked-in="false" class="w-full bg-gray-800 text-white font-semibold px-6 py-2  rounded mb-4 flex   gap-2" style="text-align: center;" data-checked-in="{{ $checkedIn ? 'true' : 'false' }}">
    
      <span id="turn-status" class="text-sm text-gray-500"></span>
      <span class="btn-text" class= "w-full bg-gray-800 text-white  px-6 py-2  rounded mb-4  flex items-center justify-center gap-2" style="margin-left: 25px; ">Take Customer</span>
  </button>
  
  
<button id="addCustomerBtn" type="button"  class="w-full bg-gray-800 text-white  px-6 py-2 rounded mb-4 hidden"> Add Customer </button>
    </div>
  </div>
  <!-- Scrollable Customers -->
  <div class="flex-1 overflow-y-auto pr-2 max-h-[80vh]" id="customerCards">
    @php
    $lastCustomer = $customers->filter(fn($c) => $c->salesperson_id == session('sales_id'))->last();
    @endphp

<div id="customer-list">
  @foreach ($customers as $c)
  <div class="customer-card bg-white border rounded-lg p-4 shadow-sm space-y-1 mt-3
  {{ $c->salesperson_id == session('sales_id') ? 'cursor-pointer' : 'opacity-50 pointer-events-none' }}
  {{ $lastCustomer && $c->id === $lastCustomer->id ? 'last-active' : '' }}" data-name="{{ $c->name }}" data-email="{{ $c->email }}" data-phone="{{ $c->phone }}" data-interest="{{ $c->interest }}" data-notes="{{ $c->notes }}" data-process='@json($c->process)' data-disposition="{{ $c->disposition }}">
      <h3 class="font-semibold text-indigo-600 text-sm uppercase tracking-wide">Customer Info</h3>
      <p class="text-sm bg-indigo-100 text-gray-700"><strong>Sales Person:</strong> {{ $c->salesperson->name ?? 'N/A' }}</p>
      <p class="text-sm text-gray-700"><strong>Name:</strong> {{ $c->name ?? '-' }}</p>
      <p class="text-sm text-gray-700"><strong>Email:</strong> {{ $c->email ?? '-' }}</p>
      <p class="text-sm text-gray-700"><strong>Phone:</strong> {{ $c->phone ?? '-' }}</p>
      <p class="text-sm text-gray-700"><strong>Process:</strong> 
        {{ is_array($c->process) ? implode(', ', $c->process) : (is_string($c->process) ? implode(', ', json_decode($c->process, true)) : 'N/A') }}
      </p>
      
      <p class="text-sm text-gray-700"><strong>Disposition:</strong> {{ $c->disposition ?? 'N/A' }}</p>
      <div class="pt-2">
        <button 
          class="w-full bg-gray-800 text-white px-6 py-2 rounded mb-4 transfer-btn" 
          data-id="{{ $c->id }}" 
          data-name="{{ $c->name }}">
          Transfer
        </button>
      </div>
    </div>
<div id="transferred-customers" class="space-y-3"></div>

  @endforeach
</div>

</div>
<div id="appointment-wrapper">
  
  </div>
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
        
       
            
        </div>
@endsection
@push('scripts')
<script>
  
  document.getElementById('toBtn').addEventListener('click', function() {
      const customerIdInput = document.getElementById('currentCustomerId');
      const customerId = customerIdInput ? customerIdInput.value : null;
  
      if (customerId) {
          // Save trigger in localStorage
          localStorage.setItem('highlightCustomerTrigger', JSON.stringify({ customerId }));
         alert('T/O Request Sent!');
      } else {
          alert('No Customer ID Found!');
      }
  });
  </script>
{{--   
<script>
  document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('toBtn').addEventListener('click', function() {
          const customerId = document.getElementById('currentCustomerId').value;

          if (customerId) {
              // Store Customer ID for highlighting
              localStorage.setItem('highlightCustomerTrigger', JSON.stringify({ customerId }));

              // Speak "T/O Request Contain"
              const msg = new SpeechSynthesisUtterance("T/O Request Contain");
              msg.lang = 'en-US';
              msg.rate = 1; // Adjust speed (1 is normal)
              speechSynthesis.speak(msg);

              // Optional Alert (Disabled)
              // alert('Customer Highlight Triggered to Queue Page!');
          } else {
              alert('No Customer ID Found!');
          }
      });
  });
</script> --}}
<script>
  document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('toBtn').addEventListener('click', function() {
          const customerId = document.getElementById('currentCustomerId').value;

          if (customerId) {
              localStorage.setItem('highlightCustomerTrigger', JSON.stringify({ customerId }));
             // alert('Customer Highlight Triggered to Queue Page!');
          } else {
              alert('No Customer ID Found!');
          }
      });
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.toBtn').forEach(button => {
          button.addEventListener('click', function () {
              const customerId = this.dataset.customerId;
  
              // Trigger LocalStorage event
              localStorage.setItem('highlightCustomerTrigger', JSON.stringify({
                  customerId: customerId,
                  timestamp: new Date().getTime() // To force storage event to fire every time
              }));
          });
      });
    });
</script>
<script>
  document.getElementById('toBtn').addEventListener('click', function() {
      const customerCard = document.querySelector('.last-active'); // Get the active customer card
      if (!customerCard) return;
  
      const customerId = customerCard.getAttribute('data-id') || customerCard.getAttribute('data-customer-id');
      if (!customerId) return;
  
      // Call API to trigger highlight
      fetch('/takeover-highlight', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ customer_id: customerId })
      })
      .then(response => response.json())
      .then(data => {
          if (data.status === 'success') {
              window.location.href = '/queues'; // Redirect to queues page
          }
      });
  });
  
  </script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/js/utils.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pusher-js@7.2.0/dist/web/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const toBtns = document.querySelectorAll('.toBtn');
      const checkinInfo = document.getElementById('checkin-info');

      toBtns.forEach(btn => {
          btn.addEventListener('click', function () {
              const salesperson = this.dataset.salesperson;
              const customer = this.dataset.customer;
              const time = this.dataset.time;
              const salespersonId = this.dataset.salespersonId;

              // Fill right-side Check-In panel
              document.getElementById('checkin-salesperson').textContent = salesperson;
              document.getElementById('checkin-customer').textContent = customer;
              document.getElementById('checkin-time').textContent = time;
              checkinInfo.classList.remove('hidden');

              // Hide all forms
              document.querySelectorAll('.sales-form').forEach(form => form.classList.add('hidden'));

              // Show the matching form
              const currentForm = document.querySelector(`.sales-form[data-salesperson-id="${salespersonId}"]`);
              if (currentForm) {
                  currentForm.classList.remove('hidden');
              }
          });
      });
  });
</script>

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
window.salespersons = @json($salesperson); // comes from controller

</script>
<script>
  document.getElementById('modalSaveBtn').addEventListener('click', function () {
      document.getElementById('salesForm').submit();
  });
  
</script>


<!-- Pass PHP data to JS safely -->
<script>
    const salespeopleOptions = @json($salespeople->pluck('name', 'id'));
    
</script>
<script>
  axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
  axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
      let isMyTurn = @json($isMyTurn);
      const salespersonName = @json(optional(Auth::user())->name);
      const takeCustomerBtn = document.getElementById("takeCustomerBtn");
      const turnStatus = document.getElementById("turn-status");
      const customerForm = document.getElementById("customerFormModal");

      if (isMyTurn) {
          turnStatus.textContent = "It's your turn!";
          turnStatus.classList.add("text-gray-600", "font-semibold");
          takeCustomerBtn?.removeAttribute("disabled");
          takeCustomerBtn?.classList.remove("opacity-50", "cursor-not-allowed");
      } else {
          takeCustomerBtn?.setAttribute("disabled", "true");
          takeCustomerBtn?.classList.add("opacity-50", "cursor-not-allowed");
          turnStatus.textContent = "Please check in to activate your turn queue.";
      }

      takeCustomerBtn?.addEventListener("click", function (e) {
          e.preventDefault();

          if (isMyTurn) {
              // ✅ Show SweetAlert directly (no speech)
              Swal.fire({
                  title: 'Customer Assigned!',
                  text: "You may now fill the customer form.",
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.isConfirmed) {
                      customerForm?.classList.remove("hidden");
                      if (turnStatus) {
                          turnStatus.textContent = "It's your turn!";
                          turnStatus.classList.add("text-gray-600", "font-semibold");
                      }
                  }
              });

          } else {
              Swal.fire({
                  icon: 'info',
                  title: 'Not your turn!',
                  text: 'Please wait until it\'s your turn to take a customer.'
              });
          }
      });
  });
</script>


<script>
  
  let isMyTurn = @json($isMyTurn); 
  if (!isMyTurn) {
      document.getElementById("newCustomerBtn")?.setAttribute("disabled", "true");
      document.getElementById("newCustomerBtn")?.classList.add("opacity-50", "cursor-not-allowed");
  }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    document.querySelectorAll('.transfer-btn').forEach(button => {
        button.addEventListener('click', function () {
            const customerId = this.getAttribute('data-id');
            const customerName = this.getAttribute('data-name');
            const cardEl = this.closest('.customer-card');

            Swal.fire({
                title: 'Transfer Customer',
                html: `
                    <p style="margin-bottom:10px;"><strong>Transfer to another salesperson.</strong></p>
                    <select id="salespersonSelect" class="swal2-select2" style="width:100%;">
                        <option value="">-- Select Salesperson --</option>
                        ${Object.entries(salespeopleOptions).map(([id, name]) => `<option value="${id}">${name}</option>`).join('')}
                    </select>
                `,
                didOpen: () => {
                    $('#salespersonSelect').select2({
                        dropdownParent: $('.swal2-popup'),
                        placeholder: "-- Select Salesperson --",
                        width: '100%'
                    });
                },
                showCancelButton: true,
                confirmButtonText: 'Transfer',
                cancelButtonText: 'Cancel',
                focusConfirm: false,
                customClass: {
                    confirmButton: 'custom-transfer-btn',
                    cancelButton: 'custom-cancel-btn'
                },
                preConfirm: () => {
                    const selected = document.getElementById('salespersonSelect').value;
                    if (!selected) {
                        Swal.showValidationMessage('You must select a salesperson!');
                    }
                    return selected;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const newSalespersonId = result.value;

                    axios.post('/sales/transfer', {
                        customer_id: customerId,
                        new_salesperson_id: newSalespersonId
                    })
                    .then((res) => {
                        Swal.fire('✅ Transferred!', 'Customer has been transferred.', 'success');

                        const newName = res.data.salesperson_name || 'N/A';
                        const paragraphs = cardEl.querySelectorAll("p");
                        paragraphs.forEach(p => {
                            if (p.innerText.startsWith("Sales Person:")) {
                                p.innerHTML = `<strong>Sales Person:</strong> ${newName}`;
                            }
                        });

                        // Animate then remove card
                        cardEl.style.transition = 'opacity 0.4s ease';
                        cardEl.style.opacity = '0';
                        setTimeout(() => cardEl.remove(), 400);
                    })
                    // .catch(() => {
                    //     Swal.fire('❌ Error!', 'Transfer failed. Try again.', 'error');
                    // });
                }
            });
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  let pendingCustomersCount = {{ $checkin->pending_customers_count ?? 0 }};
</script>

<script>
  const salespeopleOptions = @json($salespeople->pluck('name', 'id'));
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
      // Elements
      const salesForm = document.getElementById("salesForm");
      const customerModal = document.getElementById("customerModal");
      const openModalBtn = document.getElementById("openModalBtn");
      const closeModalBtn = document.getElementById("closeModalBtn");
      const customerList = document.getElementById("customer-list");
      const checkForm = document.getElementById("checkToggleForm");
      const checkBtn = document.getElementById("checkToggleButton");
      const checkText = checkBtn?.querySelector(".btn-text");
      const checkSpinner = checkBtn?.querySelector(".btn-spinner");
      const statusText = document.querySelector(".status-text");
      const checkInTimeEl = document.getElementById("check-in-time");
      const checkOutTimeEl = document.getElementById("check-out-time");
      const durationEl = document.getElementById("duration");
      const durationWrapper = document.getElementById("duration-wrapper");
      const turnStatus = document.getElementById("turn-status") || { textContent: "" };
      const newCustomerBtn = document.getElementById("newCustomerBtn");
      const addCustomerBtn = document.getElementById("addCustomerBtn");
      const takeCustomerBtn = document.getElementById("takeCustomerBtn");
  
      let isMyTurn = @json($isMyTurn);
  
      // 🧠 Restore state from localStorage
      const storedStatus = localStorage.getItem('checkStatus');
      const storedCheckIn = localStorage.getItem('checkInTimestamp');
      let isCheckedIn = false;
      let checkInTimestamp = null;
      let durationInterval = null;
  
      if (storedStatus === 'checked_in' && storedCheckIn) {
          checkInTimestamp = new Date(storedCheckIn);
  
          if (checkInTimestamp > new Date()) {
              console.warn("Future timestamp detected. Clearing state.");
              localStorage.removeItem('checkStatus');
              localStorage.removeItem('checkInTimestamp');
              checkInTimestamp = null;
              isCheckedIn = false;
              return;
          }
  
          isCheckedIn = true;
          checkText.textContent = "Check Out";
          checkBtn?.classList.replace("bg-green-500", "bg-red-500");
  
          checkInTimeEl.textContent = formatDateTime(checkInTimestamp);
          durationWrapper?.classList.remove("hidden");
          updateDuration();
          durationInterval = setInterval(updateDuration, 1000);
  
          statusText.innerHTML = `✅ Checked In`;
          statusText.classList.replace("bg-red-100", "bg-green-100");
          statusText.classList.replace("text-red-700", "text-green-700");
          turnStatus.textContent = "⏳ Waiting for your turn...";
          newCustomerBtn?.classList.remove("hidden");
          addCustomerBtn?.classList.remove("hidden");
      }
  
      const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");
      if (csrf) axios.defaults.headers.common["X-CSRF-TOKEN"] = csrf;
  
      function formatDateTime(date) {
          return date.toLocaleDateString('en-GB') + ', ' + date.toLocaleTimeString();
      }
  
      function updateDuration() {
          if (!checkInTimestamp) return;
          const now = new Date();
          let diff = Math.floor((now - checkInTimestamp) / 1000);
          if (diff < 0) diff = 0;
  
          const min = Math.floor(diff / 60);
          const sec = diff % 60;
          durationEl.textContent = `${min}m ${sec}s`;
      }
  
      checkForm?.addEventListener("submit", function (e) {
    e.preventDefault();
    // 🚨 NEW ADDITION: Check pending customers before sending request
    if (pendingCustomersCount > 0) {
        Swal.fire({
            icon: 'error',
            title: 'Pending Customers!',
            text: `⚠️ You have ${pendingCustomersCount} pending customers. Please transfer them before checkout.`
        });
        return; // 🛑 STOP HERE, don't send API call!
    }
    checkSpinner?.classList.remove("hidden");
    checkBtn?.classList.add("hidden");

    axios.post(this.action, new FormData(this)).then((response) => {
        const res = response.data;

        if (res.status === 'checked_out') {
            localStorage.removeItem('checkStatus');
            localStorage.removeItem('checkInTimestamp');
            clearInterval(durationInterval);

            statusText.innerHTML = "❌ Checked Out";
            statusText.classList.replace("bg-grey-100", "bg-red-100");
            statusText.classList.replace("text-grey-700", "text-red-700");

            checkText.textContent = "Check In";
            checkBtn?.classList.replace("bg-red-500", "bg-green-500");
            checkOutTimeEl.textContent = formatDateTime(new Date());
            turnStatus.textContent = "Not in queue";
            newCustomerBtn?.classList.add("hidden");
            addCustomerBtn?.classList.add("hidden");
            durationWrapper?.classList.add("hidden");

            Swal.fire({
                icon: 'info',
                title: 'Checked Out!',
                text: `You were checked in for ${res.formatted_duration}.`
            });

          } else if (res.status === 'checked_in') {
    checkInTimestamp = new Date(res.check_in_time); // ✅ Reassign outer variable

            localStorage.setItem('checkStatus', 'checked_in');
            localStorage.setItem('checkInTimestamp', checkInTimestamp.toISOString());

            checkInTimeEl.textContent = formatDateTime(checkInTimestamp);
            checkOutTimeEl.textContent = "N/A";
            checkText.textContent = "Check Out";
            checkBtn?.classList.replace("bg-green-500", "bg-red-500");
            statusText.innerHTML = `✅ Checked In`;
            statusText.classList.replace("bg-red-100", "bg-green-100");
            statusText.classList.replace("text-red-700", "text-green-700");
            turnStatus.textContent = "Waiting for your turn...";
            newCustomerBtn?.classList.remove("hidden");
            addCustomerBtn?.classList.remove("hidden");
            durationWrapper?.classList.remove("hidden");

            updateDuration();
            durationInterval = setInterval(updateDuration, 1000);

            Swal.fire({
                icon: 'success',
                title: 'Checked In!',
                html: `<p><strong>Salesperson:</strong> ${res.salesperson}</p><p><strong>Check-In Time:</strong> ${res.check_in_time}</p>`
            });

            // ✅ GET is-my-turn status and update UI
            axios.get('/sales/is-my-turn').then(({ data }) => {
                isMyTurn = data.is_my_turn;

                // Update the blue paragraph
                const isMyTurnPara = document.querySelector('p[style*="color:blue"]');
                if (isMyTurnPara) {
                    isMyTurnPara.textContent = `Is It Your Turn? ${isMyTurn}`;
                    isMyTurnPara.style.color = isMyTurn ? "grey" : "red";
                }

                if (isMyTurn) {
                    takeCustomerBtn?.removeAttribute("disabled");
                    takeCustomerBtn?.classList.remove("opacity-50", "cursor-not-allowed");

                    if (turnStatus) {
                        turnStatus.textContent = "It's your turn!";
                        turnStatus.classList.add("text-grey-600", "font-semibold");
                    }
                } else {
                    takeCustomerBtn?.setAttribute("disabled", "true");
                    takeCustomerBtn?.classList.add("opacity-50", "cursor-not-allowed");

                    if (turnStatus) {
                        turnStatus.textContent = "Please check in to activate your turn queue.";
                        turnStatus.classList.remove("text-green-600", "font-semibold");
                    }
                }
            });
        }
    }).catch(() => {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to toggle check status.' });
    }).finally(() => {
        checkSpinner?.classList.add("hidden");
        checkBtn?.classList.remove("hidden");
    });
});

  
      // Modal logic
      openModalBtn?.addEventListener("click", () => customerModal?.classList.remove("hidden"));
      closeModalBtn?.addEventListener("click", () => customerModal?.classList.add("hidden"));
  
      newCustomerBtn?.addEventListener("click", function () {
    const isAllowed = this.getAttribute("data-checked-in") === "true";
    if (!isAllowed) {
        return Swal.fire({
            icon: 'warning',
            title: 'Action Not Allowed!',
            text: 'Please check in before taking a customer.'
        });
    }

    if (!isMyTurn) {
        return Swal.fire({
            icon: 'info',
            title: 'Not your turn!',
            text: '⏳ Please wait. Another salesperson is currently active.'
        });
    }

    axios.post('/sales/take-customer')
        .then(res => {
            // ✅ ✅ ✅ SUCCESS HANDLING HERE
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                html: `<p><strong>${res.data.message}</strong></p><p>You can now fill out the customer form below.</p>`,
                timer: 2500,
                showConfirmButton: false
            });

            // 👇 Show the form
            const formContainer = document.getElementById("formContainer");
            const nameInput = document.getElementById("nameInput");

            if (formContainer) {
                formContainer.classList.remove("hidden"); // Just in case it's hidden initially
                formContainer.scrollIntoView({ behavior: "smooth" });
            }

            nameInput?.focus();
        })
        .catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Not Your Turn!',
                text: err.response?.data?.error || 'Please wait for your turn.'
            });
        });
});

  
      // Listen to Pusher for turn assignment
      window.Pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
          cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
          encrypted: true
      });
  
      const EchoConstructor = window.Echo;
      window.Echo = new EchoConstructor({
          broadcaster: 'pusher',
          key: '{{ env("PUSHER_APP_KEY") }}',
          cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
          forceTLS: true
      });
  
      const myId = document.getElementById('currentUserId')?.value;
      window.Echo.channel('sales-turn')
.listen('TurnAssigned', async (e) => {
    const currentUserId = document.getElementById("currentUserId")?.value;
    const takeCustomerBtn = document.getElementById("takeCustomerBtn");
    const turnStatus = document.getElementById("turn-status");
    const isMyTurnSpan = document.getElementById("isMyTurnValue");

    const isMyTurn = e.salesperson_id == currentUserId;
    window.isMyTurn = isMyTurn;

    if (isMyTurn) {
        // ✅ Speak the name before enabling
        await announceTurn(e.salesperson_name);

        // ✅ Enable the take customer button
        takeCustomerBtn?.removeAttribute("disabled");
        takeCustomerBtn?.classList.remove("opacity-50", "cursor-not-allowed");

        // ✅ Update UI
        turnStatus.textContent = "🎯 It's your turn!";
        turnStatus.classList.add("text-grey-600", "font-semibold");

        if (isMyTurnSpan) {
            isMyTurnSpan.textContent = "true";
            isMyTurnSpan.style.color = "grey";
        }

    } else {
        // ❌ Not your turn
        takeCustomerBtn?.setAttribute("disabled", "true");
        takeCustomerBtn?.classList.add("opacity-50", "cursor-not-allowed");

        turnStatus.textContent = "⏳ Not your turn!";
        turnStatus.classList.remove("text-grey-600");

        if (isMyTurnSpan) {
            isMyTurnSpan.textContent = "false";
            isMyTurnSpan.style.color = "red";
        }
    }
});
document.addEventListener('click', () => {
    window.speechSynthesis.getVoices();
}, { once: true });


  });
  </script>
  <script>
    function updateTurnStatusUI(isMyTurn) {
        const turnValue = document.getElementById("isMyTurnValue");
        const turnText = document.getElementById("isMyTurnText");
        const takeBtn = document.getElementById("takeCustomerBtn");
        const turnStatus = document.getElementById("turn-status");

        if (turnValue) turnValue.textContent = isMyTurn ? "true" : "false";
        if (turnText) turnText.style.color = isMyTurn ? "green" : "red";

        if (takeBtn && turnStatus) {
            if (isMyTurn) {
                takeBtn.removeAttribute("disabled");
                takeBtn.classList.remove("opacity-50", "cursor-not-allowed");
                turnStatus.textContent = " It's your turn!";
                turnStatus.classList.add("text-grey-600", "font-semibold");
            } else {
                takeBtn.setAttribute("disabled", "true");
                takeBtn.classList.add("opacity-50", "cursor-not-allowed");
                turnStatus.textContent = "Not your turn!";
                turnStatus.classList.remove("text-grey-600", "font-semibold");
            }
        }

        // For global use (optional)
        window.isMyTurn = isMyTurn;
    }
    document.addEventListener("DOMContentLoaded", function () {
    const takeCustomerBtn = document.getElementById("takeCustomerBtn");
    const turnStatus = document.getElementById("turn-status");
    const isMyTurnSpan = document.getElementById("isMyTurnValue");
    const currentUserId = document.getElementById('currentUserId')?.value;

    // Initialize Echo and Pusher
    window.Pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
        cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
        encrypted: true
    });

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ env("PUSHER_APP_KEY") }}',
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        forceTLS: true
    });

    window.Echo.channel('sales-turn')
.listen('TurnAssigned', async (e) => {
    const currentUserId = document.getElementById("currentUserId")?.value;
    const takeCustomerBtn = document.getElementById("takeCustomerBtn");
    const turnStatus = document.getElementById("turn-status");
    const isMyTurnSpan = document.getElementById("isMyTurnValue");

    const isMyTurn = e.salesperson_id == currentUserId;
    window.isMyTurn = isMyTurn;

    if (isMyTurn) {
        // ✅ Speak the name before enabling
        await announceTurn(e.salesperson_name);

        // ✅ Enable the take customer button
        takeCustomerBtn?.removeAttribute("disabled");
        takeCustomerBtn?.classList.remove("opacity-50", "cursor-not-allowed");

        // ✅ Update UI
        turnStatus.textContent = "🎯 It's your turn!";
        turnStatus.classList.add("text-grey-600", "font-semibold");

        if (isMyTurnSpan) {
            isMyTurnSpan.textContent = "true";
            isMyTurnSpan.style.color = "grey";
        }

    } else {
        // ❌ Not your turn
        takeCustomerBtn?.setAttribute("disabled", "true");
        takeCustomerBtn?.classList.add("opacity-50", "cursor-not-allowed");

        turnStatus.textContent = "⏳ Not your turn!";
        turnStatus.classList.remove("text-grey-600");

        if (isMyTurnSpan) {
            isMyTurnSpan.textContent = "false";
            isMyTurnSpan.style.color = "red";
        }
    }
});
document.addEventListener('click', () => {
    window.speechSynthesis.getVoices();
}, { once: true });


    function fireTurnAlert(isMyTurn) {
        Swal.fire({
            icon: isMyTurn ? 'success' : 'info',
            title: isMyTurn ? ' Your Turn!' : 'Please check in to activate your turn queue.',
            text: isMyTurn
                ? 'You can now take the next customer.'
                : 'Please fill the form.'
        });
    }
});
function announceTurn(name) {
    return new Promise((resolve) => {
        window.speechSynthesis.cancel();
        const msg = new SpeechSynthesisUtterance(`${name}, it's your turn`);
        msg.lang = 'en-US';
        msg.rate = 1;

        msg.onend = () => resolve();  // When speech ends, resolve promise
        window.speechSynthesis.speak(msg);
    });
}

document.addEventListener('click', () => {
    window.speechSynthesis.getVoices();
}, { once: true });


</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
      const currentUserId = document.getElementById("currentUserId")?.value;
      const takeCustomerBtn = document.getElementById("takeCustomerBtn");

      window.Pusher = Pusher;

      window.Echo = new Echo({
          broadcaster: 'pusher',
          key: "{{ config('broadcasting.connections.pusher.key') }}",
          cluster: "{{ config('broadcasting.connections.pusher.options.cluster') }}",
          forceTLS: true
      });

      window.Echo.channel('turn-channel')
          .listen('TurnAssigned', (e) => {
              const turnHolderId = e.salesperson_id;

              if (currentUserId == turnHolderId) {
                  // ✅ It's your turn — enable button
                  takeCustomerBtn.disabled = false;
                  takeCustomerBtn.classList.remove('bg-gray-800');
                  takeCustomerBtn.classList.add('bg-gray-600');
              } else {
                  // ❌ Not your turn — disable button
                  takeCustomerBtn.disabled = true;
                  takeCustomerBtn.classList.remove('bg-gray-600');
                  takeCustomerBtn.classList.add('bg-gray-800');
              }
          });
  });
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('salesForm');
    const modalSaveBtn = document.getElementById('modalSaveBtn');

    modalSaveBtn.addEventListener('click', function (e) {
      e.preventDefault();

      modalSaveBtn.disabled = true;
      modalSaveBtn.textContent = 'Saving...';

      const formData = new FormData(form);

      axios.post(form.action, formData)
        .then(function (response) {
          const data = response.data;

          if (data.success) {
            Swal.fire({
              icon: 'success',
              title: '✅ Customer Saved',
              text: data.message || 'Customer saved successfully!',
              confirmButtonText: 'Go to Dashboard',
              allowOutsideClick: false,
              allowEscapeKey: false,
              backdrop: true
            }).then(() => {
              if (data.redirect) {
                window.location.href = data.redirect;
              }
            });

            // Close modal & reset form
            const modalEl = document.getElementById('salesModal');
            if (modalEl) {
              const modal = bootstrap.Modal.getInstance(modalEl);
              if (modal) modal.hide();
            }
            form.reset();

          } else {
            // ❌ Not your turn or other controlled backend rejection
            Swal.fire({
              icon: 'warning',
              title: '⚠️ Action Blocked',
              text: data.error || 'Something went wrong.',
              confirmButtonText: 'OK',
              allowOutsideClick: false,
              allowEscapeKey: false,
              backdrop: true
            }).then(() => {
              if (data.redirect) {
                window.location.href = data.redirect;
              }
            });
          }
        })
        .catch(function (error) {
          console.error('Error submitting:', error);

          const errData = error.response?.data || {};
          const errMsg = errData.error || error.message || '⏳ Please wait until it is your turn.';
          const redirectUrl = errData.redirect;

          Swal.fire({
            icon: 'error',
            title: '⛔ Request Failed',
            text: errMsg,
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            allowEscapeKey: false,
            backdrop: true
          }).then(() => {
            if (redirectUrl) {
              window.location.href = redirectUrl;
            }
          });
        })
        .finally(() => {
          modalSaveBtn.disabled = false;
          modalSaveBtn.textContent = 'Save';
        });
    });
  });
</script>

<script>
  document.querySelectorAll('.customer-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
      const name = card.dataset.name;
      const email = card.dataset.email;
      const phone = card.dataset.phone;
      const interest = card.dataset.interest;
      const notes = card.dataset.notes;
      const disposition = card.dataset.disposition;
      const process = JSON.parse(card.dataset.process || '[]');

      function fillCustomerForm(card) {
    const name = card.dataset.name;
    const email = card.dataset.email;
    const phone = card.dataset.phone;
    const interest = card.dataset.interest;
    const notes = card.dataset.notes;
    const disposition = card.dataset.disposition;
    const process = JSON.parse(card.dataset.process || '[]');

    document.getElementById('nameInput').value = name || '';
    document.getElementById('emailInput').value = email || '';
    document.getElementById('phone').value = phone || '';
    document.getElementById('interestInput').value = interest || '';
    document.querySelector('textarea[name="notes"]').value = notes || '';

    document.querySelectorAll('input[name="process[]"]').forEach(cb => cb.checked = false);
    process.forEach(p => {
      const checkbox = document.querySelector(`input[name="process[]"][value="${p}"]`);
      if (checkbox) checkbox.checked = true;
    });

    if (disposition) {
      const radio = document.querySelector(`input[name="disposition"][value="${disposition}"]`);
      if (radio) radio.checked = true;
    }
  }

  // Add hover events to all cards
  document.querySelectorAll('.customer-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
      fillCustomerForm(card);
    });
  });

  // 👉 Auto-select last active customer on load
  const lastActiveCard = document.querySelector('.customer-card.last-active');
  if (lastActiveCard) {
    fillCustomerForm(lastActiveCard);
  }
    });
  });
</script>
<script>
  document.querySelectorAll('.customer-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
      const name = card.getAttribute('data-name');
      const email = card.getAttribute('data-email');
      const phone = card.getAttribute('data-phone');
      const interest = card.getAttribute('data-interest');
      const notes = card.getAttribute('data-notes');
      const disposition = card.getAttribute('data-disposition');
      const process = JSON.parse(card.getAttribute('data-process') || '[]');
  
      document.getElementById('nameInput').value = name || '';
      document.getElementById('emailInput').value = email || '';
      document.getElementById('phone').value = phone || '';
      document.getElementById('interestInput').value = interest || '';
      document.querySelector('textarea[name="notes"]').value = notes || '';
  
      // Clear all checkboxes
      document.querySelectorAll('input[name="process[]"]').forEach(cb => cb.checked = false);
      // Check those in process
      process.forEach(p => {
        const checkbox = document.querySelector(`input[name="process[]"][value="${p}"]`);
        if (checkbox) checkbox.checked = true;
      });
  
      // Set disposition radio
      if (disposition) {
        const radio = document.querySelector(`input[name="disposition"][value="${disposition}"]`);
        if (radio) radio.checked = true;
      }
    });
  });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toBtn = document.getElementById('toBtn');
    
        toBtn?.addEventListener('click', function () {
            const salesperson = this.getAttribute('data-salesperson');
            const customer = this.getAttribute('data-customer');
            const time = this.getAttribute('data-time');
    
            // Fill in check-in info
            document.getElementById('checkin-salesperson').textContent = salesperson ?? '-';
            document.getElementById('checkin-customer').textContent = customer ?? '-';
            document.getElementById('checkin-time').textContent = time ?? '-';
    
            // Show the info section
            document.getElementById('checkin-info').classList.remove('hidden');
        });
    });
    </script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const toBtns = document.querySelectorAll('.toBtn');
      const checkinInfo = document.getElementById('checkin-info');
  
      toBtns.forEach(btn => {
          btn.addEventListener('click', function () {
              const salesperson = this.dataset.salesperson;
              const customer = this.dataset.customer;
              const time = this.dataset.time;
              const salespersonId = this.dataset.salespersonId;
  
              // Fill right-side panel
              document.getElementById('checkin-salesperson').textContent = salesperson;
              document.getElementById('checkin-customer').textContent = customer;
              document.getElementById('checkin-time').textContent = time;
              checkinInfo.classList.remove('hidden');
  
              // Hide all forms
              document.querySelectorAll('.sales-form').forEach(form => form.classList.add('hidden'));
  
              // Show current salesperson's form
              const currentForm = document.querySelector(`.sales-form[data-salesperson-id="${salespersonId}"]`);
              if (currentForm) currentForm.classList.remove('hidden');
          });
      });
  });
  </script>
      
@endpush  