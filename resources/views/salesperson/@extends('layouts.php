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

</style>
@endpush

   @section('content')
     <!-- Page Content -->
     {{-- <p style="color:red">Your ID: {{ session('sales_id') }}</p>
     <p id="isMyTurnText" style="color:blue">Is It Your Turn? <span id="isMyTurnValue">{{ $isMyTurn ? 'true' : 'false' }}</span></p> --}}

     

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
              <button type="submit" id="modalSaveBtn" class="bg-gray-800 text-white px-3 py-1.5 rounded "> Save</button>
            </div> 
          </div>
        </div>
      </div>

      <!-- Modal Trigger -->
      <div class="md:col-span-2 text-right mt-4">
       <button id="openModalBtn"  type="button" class="bg-gray-800 text-white px-3 py-1.5 rounded"> Close </button>
<button type="button" id="toBtn"  class=" relative bg-gray-800 text-white px-4 py-1.5 rounded">
  <span class="btn-label">T/O</span>
  <div class="toSpinner hidden absolute inset-0 bg-black/50 flex items-center justify-center z-10 rounded">
    <div class="w-6 h-6 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
  </div>
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
     <span class="status-text text-sm font-semibold px-3 py-1 rounded-md flex items-center gap-1 bg-red-100 text-red-700">
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
          class="check-toggle-btn px-6 py-2 text-sm font-semibold flex items-center gap-2 rounded-md text-white shadow-md
          bg-green-500 hover:bg-green-600">
          <span class="btn-text">Check In</span>
          <svg class="btn-spinner hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24">
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
      {{-- <button id="takeCustomerBtn" class="btn btn-primary" type="button" data-checked-in="false" class="w-full bg-gray-800 text-white font-semibold px-6 py-2 rounded mb-4 flex items-center justify-center gap-2">
      <span class="spinner hidden w-5 h-5 border-2 border-white border-t-transparent rounded animate-spin"></span>
      <span class="btn-text">Take Customer</span>
    </button>
     --}}
     <input type="hidden" id="currentUserId" value="{{ session('sales_id') }}">
     <button id="takeCustomerBtn"  type="button" data-checked-in="false" class="w-full bg-gray-800 text-white font-semibold px-6 py-2  rounded mb-4 flex  gap-2" data-checked-in="{{ $checkedIn ? 'true' : 'false' }}">
    
      <span id="turn-status" class="text-sm text-gray-500"></span>
      <span class="btn-text" class= "w-full bg-gray-800 text-white font-semibold px-6 py-2  rounded mb-4 flex items-center justify-center gap-2">Take Customer</span>
  </button>
  
  
<button id="addCustomerBtn" type="button"  class="w-full bg-gray-800 text-white  px-6 py-2 rounded mb-4 hidden"> Add Customer </button>
    </div>
  </div>
  <!-- Scrollable Customers -->
  <div class="flex-1 overflow-y-auto pr-2 max-h-[80vh]" id="customerCards">
    <style>
.active-card {
  animation: pulseActive 1s infinite;
  border-color: #6366f1;
  box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
}

/* Pause class */
.active-card.paused {
  animation-play-state: paused !important;
}


</style>

<div id="customer-list">
  @foreach ($customers as $c)
    <div class="bg-white border rounded-lg p-4 shadow-sm space-y-1 mt-3 {{ $c->salesperson_id == session('sales_id') ? 'active-card' : '' }}">
      <h3 class="font-semibold text-indigo-600 text-sm uppercase tracking-wide">Customer Info</h3>
      <p class="text-sm bg-indigo-100 text-gray-700"><strong>Sales Person:</strong> {{ $c->salesperson->name ?? 'N/A' }}</p>
      <p class="text-sm text-gray-700"><strong>Name:</strong> {{ $c->name ?? '-' }}</p>
      <p class="text-sm text-gray-700"><strong>Email:</strong> {{ $c->email ?? '-' }}</p>
      <p class="text-sm text-gray-700"><strong>Phone:</strong> {{ $c->phone ?? '-' }}</p>
      <p class="text-sm text-gray-700"><strong>Process:</strong> {{ is_array(json_decode($c->process)) ? implode(', ', json_decode($c->process)) : 'N/A' }}</p>
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
  @endforeach
</div>

</div>




  
  <div id="appointment-wrapper">
  <style>
  .active-card {
    animation: pulseActive 1s infinite;
    border-color: #6366f1;
    box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
  }

  @keyframes pulseActive {
    0% {
      box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7);
    }
    70% {
      box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
    }
    100% {
      box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
    }
  }

  .pause-animation {
    animation: none !important;
    box-shadow: none !important;
  }
</style>


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
<script>
window.salespersons = @json($salesperson); // comes from controller

</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pusher-js@7.2.0/dist/web/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>

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
      const takeCustomerBtn = document.getElementById("takeCustomerBtn");
      const turnStatus = document.getElementById("turn-status");
      const customerForm = document.getElementById("customerFormModal"); // change ID if different
  
      // Update turn message & button status
      if (isMyTurn) {
          turnStatus.textContent = "🎯 It's your turn!";
          turnStatus.classList.add("text-grey-600", "font-semibold");
          takeCustomerBtn?.removeAttribute("disabled");
          takeCustomerBtn?.classList.remove("opacity-50", "cursor-not-allowed");
      } else {
          takeCustomerBtn?.setAttribute("disabled", "true");
          takeCustomerBtn?.classList.add("opacity-50", "cursor-not-allowed");
          turnStatus.textContent = "❗ Please check in to activate your turn queue.";
      }
  
      // On click logic
      takeCustomerBtn?.addEventListener("click", function (e) {
          e.preventDefault();
  
          if (isMyTurn) {
    Swal.fire({
        title: 'Customer Assigned!',
        text: "You may now fill the customer form.",
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            // ✅ 1. Show the form/modal
            customerForm?.classList.remove("hidden");

            // ✅ 2. Update the text to show it's their turn
            const turnStatus = document.getElementById("turn-status");
            if (turnStatus) {
                turnStatus.textContent = " It's your turn!";
                turnStatus.classList.add("text-green-600", "font-semibold");
            }
        }
    });
}
 else {
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
        <p style="margin-bottom:10px;"><strong>Transfer to another salesperson.</strong</p>
        <select id="salespersonSelect" class="swal2-select2" style="width:100%;">
            <option value="">-- Select Salesperson --</option>
            ${Object.entries(salespeopleOptions).map(([id, name]) => `<option value="${id}">${name}</option>`).join('')}
        </select>
    `,
    didOpen: () => {
        // Initialize select2 AFTER Swal is rendered
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
    }}).then((result) => {
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

                        cardEl.classList.add("active-card");
                        setTimeout(() => cardEl.classList.remove("active-card"), 2000);
                    });
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
            turnStatus.textContent = "🚫 Not in queue";
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
            turnStatus.textContent = "⏳ Waiting for your turn...";
            newCustomerBtn?.classList.remove("hidden");
            addCustomerBtn?.classList.remove("hidden");
            durationWrapper?.classList.remove("hidden");

            updateDuration();
            durationInterval = setInterval(updateDuration, 1000);

            Swal.fire({
                icon: 'success',
                title: '✅ Checked In!',
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
                        turnStatus.textContent = "🎯 It's your turn!";
                        turnStatus.classList.add("text-grey-600", "font-semibold");
                    }
                } else {
                    takeCustomerBtn?.setAttribute("disabled", "true");
                    takeCustomerBtn?.classList.add("opacity-50", "cursor-not-allowed");

                    if (turnStatus) {
                        turnStatus.textContent = "❗ Please check in to activate your turn queue.";
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
    .listen('TurnAssigned', (e) => {
        const myId = document.getElementById('currentUserId')?.value;
        const btn = document.getElementById("takeCustomerBtn");
        const turnStatus = document.getElementById("turn-status");
        const isMyTurnSpan = document.getElementById("isMyTurnValue");

        if (e.salesperson_id == myId) {
          updateTurnStatusUI(e.salesperson_id == myId);
Swal.fire({
    icon: e.salesperson_id == myId ? 'info' : 'warning',
    title: e.salesperson_id == myId ? '🎯 Your Turn!' : '🔒 Not Your Turn!',
    text: e.salesperson_id == myId ? 'You can now take the next customer.' : 'Please wait your turn.'
});

            // ✅ Update button
            btn?.removeAttribute("disabled");
            btn?.classList.remove("opacity-50", "cursor-not-allowed");

            // ✅ Update turn status message
            if (turnStatus) {
                turnStatus.textContent = "🎯 It's your turn!";
                turnStatus.classList.add("text-grey-600", "font-semibold");
            }

            // ✅ Update "Is It Your Turn?" text
            if (isMyTurnSpan) {
                isMyTurnSpan.textContent = "true";
                isMyTurnSpan.style.color = "grey";
            }

            // ✅ Set a JS flag for consistency
            window.isMyTurn = true;
        } else {
            // ❌ Disable button if not your turn
            btn?.setAttribute("disabled", "true");
            btn?.classList.add("opacity-50", "cursor-not-allowed");

            if (turnStatus) {
                turnStatus.textContent = " Please check in to activate your turn queue!";
                turnStatus.classList.remove("text-gey-600");
            }

            if (isMyTurnSpan) {
                isMyTurnSpan.textContent = "false";
                isMyTurnSpan.style.color = "red";
            }

            window.isMyTurn = false;
        }
    });

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
                turnStatus.textContent = "🎯 It's your turn!";
                turnStatus.classList.add("text-grey-600", "font-semibold");
            } else {
                takeBtn.setAttribute("disabled", "true");
                takeBtn.classList.add("opacity-50", "cursor-not-allowed");
                turnStatus.textContent = "⏳ Not your turn!";
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

    // Listen for TurnAssigned event
    window.Echo.channel('sales-turn')
        .listen('TurnAssigned', (e) => {
            const isMyTurn = e.salesperson_id == currentUserId;

            updateTurnStatusUI(isMyTurn);
            fireTurnAlert(isMyTurn);
        });

    function updateTurnStatusUI(isMyTurn) {
        const takeBtn = document.getElementById("takeCustomerBtn");
        const turnText = document.getElementById("turn-status");
        const isMyTurnSpan = document.getElementById("isMyTurnValue");

        window.isMyTurn = isMyTurn; // Global variable

        if (isMyTurn) {
            takeBtn?.removeAttribute("disabled");
            takeBtn?.classList.remove("opacity-50", "cursor-not-allowed");

            turnText.textContent = "🎯 It's your turn!";
            turnText.classList.add("text-grey-600", "font-semibold");

            if (isMyTurnSpan) {
                isMyTurnSpan.textContent = "true";
                isMyTurnSpan.style.color = "grey";
            }
        } else {
            takeBtn?.setAttribute("disabled", "true");
            takeBtn?.classList.add("opacity-50", "cursor-not-allowed");

            turnText.textContent = "⏳ Not your turn!";
            turnText.classList.remove("text-grey-600");

            if (isMyTurnSpan) {
                isMyTurnSpan.textContent = "false";
                isMyTurnSpan.style.color = "red";
            }
        }
    }

    function fireTurnAlert(isMyTurn) {
        Swal.fire({
            icon: isMyTurn ? 'success' : 'info',
            title: isMyTurn ? '🎯 Your Turn!' : '❗ Please check in to activate your turn queue.',
            text: isMyTurn
                ? 'You can now take the next customer.'
                : 'Please fill the form.'
        });
    }
});

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
                  takeCustomerBtn.classList.add('bg-green-600');
              } else {
                  // ❌ Not your turn — disable button
                  takeCustomerBtn.disabled = true;
                  takeCustomerBtn.classList.remove('bg-green-600');
                  takeCustomerBtn.classList.add('bg-gray-800');
              }
          });
  });
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
      const form = document.getElementById("salesForm");
      if (!form) {
          console.warn("Form not found!");
          return;
      }
  
      form.addEventListener("submit", function (e) {
          e.preventDefault(); // 👈 THIS IS CRITICAL!
  
          const formData = new FormData(form);
          const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
          fetch(form.action, {
              method: "POST",
              headers: {
                  'X-CSRF-TOKEN': csrfToken
              },
              body: formData
          })
          .then(response => response.json())
          .then(data => {
              if (data.error) {
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops!',
                      text: data.error,
                  });
              } else if (data.message) {
                  Swal.fire({
                      icon: 'success',
                      title: 'Success!',
                      text: data.message,
                  }).then(() => {
                      form.reset();
                      // location.reload(); // optional
                  });
              }
          })
          .catch(error => {
              console.error("Fetch failed:", error);
              Swal.fire({
                  icon: 'error',
                  title: 'Error!',
                  text: 'Something went wrong.',
              });
          });
      });
  });
  document.addEventListener("DOMContentLoaded", function () {
    const takeCustomerBtn = document.getElementById("takeCustomerBtn");
    const turnStatus = document.getElementById("turn-status");
    const isMyTurnSpan = document.getElementById("isMyTurnValue"); // Optional
    const currentUserId = document.getElementById("currentUserId")?.value;

    // 🔁 Echo listener (make sure only one)
    window.Echo.channel('sales-turn')
        .listen('TurnAssigned', (e) => {
            const isMyTurn = e.salesperson_id == currentUserId;

            // ✅ Set global variable
            window.isMyTurn = isMyTurn;

            // ✅ Update Button
            if (takeCustomerBtn) {
                if (isMyTurn) {
                    takeCustomerBtn.removeAttribute("disabled");
                    takeCustomerBtn.classList.remove("opacity-50", "cursor-not-allowed");
                    takeCustomerBtn.classList.remove("bg-gray-800");
                    takeCustomerBtn.classList.add("bg-green-600");
                } else {
                    takeCustomerBtn.setAttribute("disabled", "true");
                    takeCustomerBtn.classList.add("opacity-50", "cursor-not-allowed");
                    takeCustomerBtn.classList.remove("bg-green-600");
                    takeCustomerBtn.classList.add("bg-gray-800");
                }
            }

            // ✅ Update Turn Status Text
            if (turnStatus) {
                turnStatus.textContent = isMyTurn ? "🎯 It's your turn!" : "⏳ Not your turn!";
                turnStatus.classList.toggle("text-green-600", isMyTurn);
                turnStatus.classList.toggle("text-gray-500", !isMyTurn);
            }

            // ✅ Optional span update
            if (isMyTurnSpan) {
                isMyTurnSpan.textContent = isMyTurn ? "true" : "false";
                isMyTurnSpan.style.color = isMyTurn ? "green" : "red";
            }

            // ✅ Alert (Optional SweetAlert)
            Swal.fire({
                icon: isMyTurn ? 'success' : 'info',
                title: isMyTurn ? '🎯 Your Turn!' : '⏳ Wait!',
                text: isMyTurn
                    ? 'You can now take the customer.'
                    : 'Please wait for your turn.',
                timer: 2000,
                showConfirmButton: false
            });
        });
});

  </script>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const takeBtn = document.getElementById("takeCustomerBtn");
    const currentUserId = "{{ session('sales_id') }}";

    const pusher = new Pusher('your-pusher-key', {
        cluster: 'your-cluster',
        encrypted: true
    });

    const channel = pusher.subscribe('turn-channel');

    channel.bind('TurnAssigned', function (data) {
        if (parseInt(currentUserId) === data.salesperson_id) {
            takeBtn.disabled = false;
        } else {
            takeBtn.disabled = true;
        }
    });
});
</script>

<!-- Axios + SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('salesForm');
    const modalSaveBtn = document.getElementById('modalSaveBtn');

    modalSaveBtn.addEventListener('click', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        axios.post(form.action, formData)
            .then(function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Customer Saved',
                    text: response.data.message || 'Customer saved successfully!'
                }).then(() => {
                    window.location.reload(); // or redirect if needed
                });
            })
            .catch(function (error) {
                if (error.response && error.response.data && error.response.data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: '⏳ Not your turn!',
                        text: error.response.data.error
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Unexpected Error',
                        text: 'Something went wrong. Please try again.'
                    });
                }
            });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

  // TAKE CUSTOMER
  document.querySelectorAll('.take-btn').forEach(button => {
    button.addEventListener('click', function () {
      const customerId = this.dataset.id;

      axios.post(`/customers/take/${customerId}`)
        .then(res => {
          Swal.fire({
            icon: 'success',
            title: 'Customer Taken',
            text: res.data.message || 'You have taken this customer.'
          });

          // Optionally disable or update button
          this.disabled = true;
          this.textContent = 'Taken';
        })
        .catch(err => {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: err.response.data.error || 'Failed to take customer.'
          });
        });
    });
  });

  // TRANSFER CUSTOMER
  document.querySelectorAll('.transfer-btn').forEach(button => {
    button.addEventListener('click', function () {
      const customerId = this.dataset.id;
      const customerName = this.dataset.name;
      const card = this.closest('.customer-card');

      Swal.fire({
        title: `Transfer ${customerName}`,
        input: 'text',
        inputLabel: 'Enter Salesperson ID or Name',
        showCancelButton: true,
        confirmButtonText: 'Transfer',
      }).then(result => {
        if (result.isConfirmed) {
          axios.post(`/customers/transfer/${customerId}`, {
            to: result.value
          }).then(res => {
            Swal.fire({
              icon: 'success',
              title: 'Transferred!',
              text: res.data.message || 'Customer has been transferred.'
            });

            // Remove card without reload
            card.remove();

          }).catch(err => {
            Swal.fire({
              icon: 'error',
              title: 'Transfer Failed',
              text: err.response.data.error || 'Could not transfer customer.'
            });
          });
        }
      });
    });
  });

});
</script>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const saveBtn = document.getElementById('modalSaveBtn');
    const form = document.getElementById('salesForm');

    saveBtn.addEventListener('click', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        axios.post(form.action, formData)
            .then(response => {
                Swal.fire({
                    icon: 'success',
                    title: 'Customer Saved!',
                    text: response.data.message || 'Successfully added!'
                }).then(() => {
                    window.location.reload(); // Optional: reload to clear form
                });
            })
            .catch(error => {
                if (error.response && error.response.data.error) {
                    Swal.fire({
                        icon: 'error',
                        title: '⏳ Not Allowed',
                        text: error.response.data.error
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Try again.'
                    });
                }
            });
    });
});
</script>
@endpush

