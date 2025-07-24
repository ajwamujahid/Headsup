@extends('layouts.app')

@section('content')

@php
$title = 'Appointments';
$subtitle = 'Manage and View all the appointmeents here';
@endphp
                    
                    <!-- Page Content -->
                    <main class="flex-1 overflow-y-auto">
                        <div class="py-6">
                            <div class="max-w-full">
                                <div class="w-full grid grid-cols-1 xl:grid-cols-4 gap-6 px-4 mt-4">
    <!-- LEFT SIDE: Customer Form -->
   <div class="xl:col-span-3  overflow-visible">
  <div id="formContainer">
    <form id="salesForm" method="POST" action="#" class=" grid grid-cols-1 md:grid-cols-2 gap-8 bg-white rounded-2xl border border-gray-200 p-8 shadow-lg">
      @csrf
<div class="md:col-span-2">
  <h3 class="text-2xl font-bold text-gray-800 leading-tight mb-0">Customer Sales Form</h3>
  <p class="text-gray-500 mt-0 leading-tight">Fill out the details below to log a customer sales interaction.</p>
</div>

     <input type="hidden" name="id" id="customerId" value="">
<input type="hidden" name="user_id" value="1" />

      <!-- Customer Info -->
<div class="space-y-4">
  

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">
        Name
      
      </label>

      <input
        id="nameInput"
        name="name"
        type="text"
        class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"
       
        
      />
    </div>
  

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">
        Email
      
      </label>

      <input
        id="emailInput"
        name="email"
        type="email"
        class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"
       
        
      />
    </div>
  

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">
        Phone
      
      </label>

      <input
        id="phoneInput"
        name="phone"
        type="text"
        class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"
       
        
      />
    </div>
  

    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1 capitalize">
        Interest
      
      </label>

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
          <textarea name="notes" rows="6"
            class="border border-gray-300 rounded-xl px-4 py-3 text-base w-full"></textarea>
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
              <button type="submit"
                class="bg-gray-800 text-white px-3 py-1.5 rounded ">
                Save
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Trigger -->
      <div class="md:col-span-2 text-right mt-4">
       <button id="openModalBtn"  type="button"
          class="bg-gray-800 text-white px-3 py-1.5 rounded">
          Close
        </button>
<button 
  type="button"
  id="toBtn"
  class=" relative bg-gray-800 text-white px-4 py-1.5 rounded"
>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- T/O request -->

<!-- <script>
  document.addEventListener('DOMContentLoaded', () => {
    const toButton = document.querySelector('.toBtn');
    if (!toButton) return; // safety check

    const spinner = toButton.querySelector('.toSpinner');
    const customerIdInput = document.getElementById('customerId');

    toButton.addEventListener('click', async () => {
      const customerId = customerIdInput?.value;

      if (!customerId) {
        Swal.fire({
          icon: 'warning',
          title: 'No Customer Selected',
          text: 'Please select or load a customer first.'
        });
        return;
      }

      spinner.classList.remove('hidden');

      try {
        await new Promise(resolve => setTimeout(resolve, 1500)); // Optional delay

        const response = await fetch('forward-customer', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify({ customer_id: customerId })
        });

        const result = await response.json();

        if (result.status === 'success') {
          await Swal.fire({
            icon: 'success',
            title: 'T/O Requested',
            text: 'T/O successfully.',
            timer: 2000,
            showConfirmButton: true
          });
        } else {
          throw new Error('Forward failed.');
        }
      } catch (err) {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: err.message || 'Something went wrong.'
        });
      } finally {
        spinner.classList.add('hidden');
      }
    });
  });
</script> -->



<script>
  let selectedCardId = null;

  function bindAppointmentCardLogic() {
    const nameInput = document.getElementById('nameInput');
    const phoneInput = document.getElementById('phoneInput');
    const idInput = document.getElementById('customerId');

    document.querySelectorAll('.customer-card').forEach(card => {
      card.addEventListener('click', () => {
        const name = card.dataset.name || '';
        const phone = card.dataset.phone || '';
        const id = card.dataset.customerId || '';

        nameInput.value = name;
        phoneInput.value = phone;
        idInput.value = id;

        document.querySelectorAll('.customer-card').forEach(c => c.classList.remove('active-card'));
        card.classList.add('active-card');

        selectedCardId = card.id;
      });
    });
  }

  function checkDuplicateName() {
    const appointmentCard = document.querySelector('#appointment-card');
    if (!appointmentCard) return;

    const appointmentName = appointmentCard.dataset.name?.trim().toLowerCase();
    const customerCards = document.querySelectorAll('.customer-card');

    customerCards.forEach(card => {
      const customerName = card.dataset.name?.trim().toLowerCase();
      if (card.id !== 'appointment-card' && customerName === appointmentName) {
        appointmentCard.classList.add("border-red-500");
        appointmentCard.classList.remove("border-gray-200");
      }
    });
  }

  function refreshAppointments() {
    fetch('/appointment/section')
      .then(res => res.text())
      .then(html => {
        const wrapper = document.getElementById("appointment-wrapper");
        wrapper.innerHTML = html;

        // Bind logic to new cards
        bindAppointmentCardLogic();
        checkDuplicateName();

        // Reapply active card style
        if (selectedCardId) {
          const selectedCard = document.getElementById(selectedCardId);
          if (selectedCard) selectedCard.classList.add('active-card');
        }
      });
  }

  document.addEventListener('DOMContentLoaded', () => {
    bindAppointmentCardLogic();
    checkDuplicateName();

    setInterval(refreshAppointments, 3000);
  });
</script> 



<script>
  $(document).ready(() => {
    toggleButton();
    updateTurnStatus();
    setInterval(updateTurnStatus, 10000);

    const form = document.getElementById('salesForm');

    function fillFormFromCard(card) {
      const name = card.dataset.name || '';
      const phone = card.dataset.phone || '';
      const customerId = card.dataset.customerId || '';

      // Set values to inputs
      const nameInput = document.getElementById('nameInput');
      const phoneInput = document.getElementById('phoneInput');
      const idInput = form.querySelector('input[name="id"]');

      if (nameInput) nameInput.value = name;
      if (phoneInput) phoneInput.value = phone;
      if (idInput) idInput.value = customerId;

      // Clear previous animation
      document.querySelectorAll('.customer-card').forEach(c => {
        c.classList.remove('active-card');
      });

      // Re-trigger animation
      card.classList.remove('active-card');
      void card.offsetWidth; // Force reflow to restart animation
      card.classList.add('active-card');

      toggleButton();
      updateNameInputState();
    }

    const appointmentCard = document.querySelector('#appointment-card');
    if (appointmentCard) {
      fillFormFromCard(appointmentCard);
    }

    // Click event in case card is clicked again
    document.querySelectorAll('.customer-card').forEach(card => {
      card.addEventListener('click', () => {
        fillFormFromCard(card);
      });
    });
  });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const nameInput = document.getElementById('nameInput');
  const newCustomerBtn = document.getElementById('newCustomerBtn');

  function toggleButton() {
    const hasValue = nameInput.value.trim().length > 0;

    newCustomerBtn.disabled = !hasValue;
    newCustomerBtn.classList.toggle('bg-gray-400', !hasValue);
    newCustomerBtn.classList.toggle('bg-[#111827]', hasValue);
  }

  nameInput.addEventListener('input', toggleButton);
  toggleButton(); // Initial check on page load
});
</script>

<!-- Time duration  -->
<script>
function completeForm(customerId) {
    fetch(`/customer/complete-form/${customerId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': 'QC0OnL1LR2kjUlIYYOYaXtpXo12h9eO4Hcp5zEMk',
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message || 'Form completed');
    });
}
</script>



<script>
  let durationInterval = null;

  function startDurationTimer(startTimeIso) {
    const start = new Date(startTimeIso);

    function updateDuration() {
      const now = new Date();
      const diffMs = now - start;

      const seconds = Math.floor((diffMs / 1000) % 60);
      const minutes = Math.floor((diffMs / 1000 / 60) % 60);
      const hours = Math.floor((diffMs / 1000 / 60 / 60));

      const formatted = [
        hours > 0 ? `${hours}h` : '',
        minutes > 0 ? `${minutes}m` : '',
        `${seconds}s`
      ].filter(Boolean).join(' ');

      document.getElementById('duration').textContent = formatted;
    }

    updateDuration();
    if (durationInterval) clearInterval(durationInterval);
    durationInterval = setInterval(updateDuration, 1000);
  }

  
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#checkToggleForm').on('submit', function(e) {
    e.preventDefault();

    const btn = $('#checkToggleButton');
    const btnText = btn.find('.btn-text');

    // ✅ Block check-out if cards exist
    if (btnText.text().trim() === 'Check Out' && $('#customer-list .customer-card').length > 0) {
      Swal.fire({
        icon: 'error',
         title: 'Pending Customer Cards',
  text: 'Please complete or transfer all customer cards before checking out.',
      });
      return;
    }

    const spinner = btn.find('.btn-spinner');
    btn.prop('disabled', true);
    btnText.addClass('hidden');
    spinner.removeClass('hidden');

    $.ajax({
      url: $(this).attr('action'),
      method: 'POST',
      data: $(this).serialize(),
      success: function(response) {
        btn.prop('disabled', false);
        btnText.removeClass('hidden');
        spinner.addClass('hidden');

        if (response.checked_in) {
          // ✅ Checked In UI
          btnText.text('Check Out');
          btn.removeClass('bg-green-500 hover:bg-green-600')
            .addClass('bg-red-500 hover:bg-red-600');

          $('.status-text').text('✅ Checked In')
            .removeClass('bg-red-100 text-red-700')
            .addClass('bg-green-100 text-green-800');

          $('#check-in-time').text(new Date(response.checked_in_at).toLocaleString());
          $('#check-out-time').text('N/A');

          $('#duration-wrapper').removeClass('hidden');
          $('#duration').text('Loading...');
          startDurationTimer(response.checked_in_at);

        } else {
          // ❌ Checked Out UI
          btnText.text('Check In');
          btn.removeClass('bg-red-500 hover:bg-red-600')
            .addClass('bg-green-500 hover:bg-green-600');

          $('.status-text').text('❌ Checked Out')
            .removeClass('bg-green-100 text-green-800')
            .addClass('bg-red-100 text-red-700');

          $('#check-out-time').text(new Date().toLocaleString());
          $('#duration-wrapper').addClass('hidden');
          clearInterval(durationInterval);
        }

        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: response.message,
          timer: 2000,
          showConfirmButton: true,
        });
      },
      error: function() {
        btn.prop('disabled', false);
        btnText.removeClass('hidden');
        spinner.addClass('hidden');

        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Something went wrong. Please try again.',
        });
      }
    });
  });
</script>


<script>
document.addEventListener('DOMContentLoaded', () => {
  const toBtn   = document.getElementById('toBtn');
  const spinner = toBtn.querySelector('.toSpinner');
  const label   = toBtn.querySelector('.btn-label');
  const form    = document.getElementById('salesForm');

  async function forwardCard() {
    const customer_id = form.querySelector('input[name="id"]')?.value.trim();

    if (!customer_id) {
      Swal.fire('Error', 'No customer selected.', 'error');
      return;
    }

    spinner.classList.remove('hidden');
    label.classList.add('opacity-0');
    toBtn.disabled = true;

    try {
      const response = await fetch("#", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ id: customer_id }) // ✅ 'id', not 'customer_id'
      });

      if (!response.ok) {
        const errRes = await response.text();
        throw new Error(`Server error: ${errRes}`);
      }

      const result = await response.json();

      localStorage.setItem('manager_notification', 'T/O Customer forwarded to Sales Manager.');

      Swal.fire({
        icon: 'success',
        title: 'Transferred!',
        text: result.message || 'Card moved to Sales Manager.',
        timer: 2000,
        showConfirmButton: true
      }).then(() => {
        // ✅ Remove specific card instead of full list
       
      });

    } catch (error) {
      console.error('Forward error:', error); // ✅ Add logging
      Swal.fire('Error', error.message || 'Something went wrong.', 'error');
    } finally {
      spinner.classList.add('hidden');
      label.classList.remove('opacity-0');
      toBtn.disabled = false;
    }
  }

  toBtn.addEventListener('click', forwardCard);
});
</script> 


<script>
    const modal = document.getElementById('customerModal');
    const openBtn = document.getElementById('openModalBtn');
    const closeBtn = document.getElementById('closeModalBtn');

    // Open modal
    openBtn.addEventListener('click', () => {
      modal.classList.remove('hidden');
    });

    // Close modal
    closeBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
    });

    // Click outside to close
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.add('hidden');
      }
    });
  </script>


  <!-- JavaScript for Transfer -->

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const salespeople = [{"id":3,"name":"Asad","counter_number":null,"email":"asad@asad.com","email_verified_at":"2025-07-07T18:02:55.000000Z","created_at":"2025-07-07T18:02:55.000000Z","updated_at":"2025-07-07T18:02:55.000000Z"},{"id":5,"name":"Umar","counter_number":null,"email":"umar@umar.com","email_verified_at":"2025-07-07T18:02:56.000000Z","created_at":"2025-07-07T18:02:56.000000Z","updated_at":"2025-07-07T18:02:56.000000Z"}];
    const currentUserId = 1;

    document.body.addEventListener('click', function (e) {
      if (!e.target.classList.contains('transfer-btn')) return;

      const button = e.target;
      const customerId = button.dataset.customerId;
      const customerName = button.dataset.customerName;

      let options = '<option disabled selected value="">Choose a sales person</option>';
      salespeople.forEach(sales => {
        if (sales.id !== currentUserId) {
          options += `<option value="${sales.id}">${sales.name}</option>`;
        }
      });

      Swal.fire({
        title: `<div class="text-xl font-bold text-[#111827] mb-2">Transfer Customer</div>`,
        html: `
          <div class="text-sm text-[#111827] mb-4">
            You are about to transfer
            <span class="font-semibold text-indigo-600">${customerName}</span>
            to another sales person.
          </div>
          <label class="block text-sm font-medium mb-1 text-[#111827]">Select Sales Person:</label>
          <select id="salespersonSelect" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm text-sm focus:outline-none focus:ring-2 focus:ring-[#111827] text-[#111827]">
            ${options}
          </select>
        `,
        showCancelButton: true,
        confirmButtonText: 'Confirm Transfer',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
          const val = document.getElementById('salespersonSelect').value;
          if (!val) {
            Swal.showValidationMessage('Please select a sales person.');
          }
          return val;
        },
        customClass: {
          popup: 'rounded-2xl p-6 shadow-xl',
          confirmButton: 'bg-[#111827] text-white px-5 py-2 mt-4 rounded-lg font-semibold',
          cancelButton: 'mx-3 bg-[#111827] text-white px-5 py-2 mt-4 rounded-lg font-semibold',
        }
      }).then(result => {
        if (!result.isConfirmed) return;

        const selectedSalesId = result.value;

        fetch(`/customers/${customerId}/transfer`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': 'QC0OnL1LR2kjUlIYYOYaXtpXo12h9eO4Hcp5zEMk'
          },
          body: JSON.stringify({
            new_user_id: selectedSalesId
          })
        })
        .then(response => response.json())
        .then(data => {
          Swal.fire({
            icon: 'success',
            title: 'Customer Transferred',
            text: data.message,
            timer: 1500,
            showConfirmButton: true
          });

          // 2 second ke baad page reload
          setTimeout(() => {
            location.reload();
          }, 2000);
        })
        .catch(error => {
          console.error(error);
          Swal.fire('Error!', 'Transfer failed. Please try again.', 'error');
        });
      });
    });
  });
</script>


<script>
  let currentTurnUserId = null;
  let isMyTurn = false;
  let wasTurnBefore = false;
  let cardClicked = false;
  let customerSavedThisTurn = false;

  const form = document.getElementById('salesForm');
  const nameInput = document.getElementById('nameInput');
  const addBtn = document.getElementById('addCustomerBtn');
  const takeBtn = document.getElementById('newCustomerBtn');
  const customerIdInput = document.getElementById('customerId');

  nameInput.readOnly = true;

  const inputs = form.querySelectorAll('input[type="text"], input[type="email"], textarea');

  // Toggle buttons based on input status
function toggleButtons() {
  const nameVal = nameInput.value.trim();
  const hasCustomerId = customerIdInput.value.trim() !== '';
  let otherFieldFilled = false;

  inputs.forEach(input => {
    if (input.id !== 'nameInput' && input.value.trim() !== '') {
      otherFieldFilled = true;
    }
  });

  // Show Add button ONLY when there's an ID
  if (hasCustomerId) {
    addBtn.classList.remove('hidden');
    takeBtn.classList.add('hidden');
  } else {
    addBtn.classList.add('hidden');
    takeBtn.classList.remove('hidden');
  }

  takeBtn.disabled = false;
}


  // Toggle readonly on name field
function updateNameInputState() {
  nameInput.readOnly = false;
}


  // Customer card clicked
  document.addEventListener('click', function (e) {
    const card = e.target.closest('.customer-card');
    if (!card) return;

    cardClicked = true;
    customerSavedThisTurn = false;

    nameInput.value = card.dataset.customerName || '';
    customerIdInput.value = card.dataset.customerId || '';

    toggleButtons();
    updateNameInputState();
  });

  // Inputs trigger toggle
  inputs.forEach(input => {
    input.addEventListener('input', toggleButtons);
  });

  // Reset form and hide addBtn
  addBtn.addEventListener('click', function () {
    form.reset();
    customerIdInput.value = "";
    nameInput.value = "";
    document.getElementById('emailInput').value = "";
    document.getElementById('phoneInput').value = "";
    document.getElementById('interestInput').value = "";

    cardClicked = false;
    updateNameInputState();
    toggleButtons();
  });

  // Take Customer button logic
  takeBtn.addEventListener('click', function (e) {
    e.preventDefault();

    const nameVal = nameInput.value.trim();

    $('#newCustomerBtn .spinner').removeClass('hidden');
    $('#newCustomerBtn .btn-text').text('Taking...');
    $('#newCustomerBtn').prop('disabled', true);

    $.get('/check-in-status')
      .done(res => {
        if (!res.is_checked_in) {
          Swal.fire({
            icon: 'error',
            title: `Oops! You're not checked in`,
            text: 'Please check in before proceeding.',
          });
          resetTakeButtonUI();
          return;
        }

      if (!isMyTurn) {
        Swal.fire({
          icon: 'error',
          title: 'Hold On!',
          text: ` It's not your turn to take a customer yet.`
        });
        resetTakeButtonUI();
        return;
      }

      

      $.ajax({
        url: '#',
        method: 'POST',
        data: {
          _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: () => {
          Swal.fire({
            icon: 'success',
            title: 'Customer Taken!',
            text: 'You have successfully taken this customer.',
            timer: 2000,
          });

          cardClicked = false;
          customerSavedThisTurn = false;

          // Simulate assigning customerId if successful
          customerIdInput.value = Math.floor(Math.random() * 100000); // For demo purpose
          updateTurnStatus();
          updateNameInputState();
          toggleButtons();
        },
        error: () => {
          Swal.fire({
            icon: 'error',
            title: 'Error occurred!'
          });
        },
        complete: () => {
          resetTakeButtonUI();
        }
      });
    })
    .fail(() => {
      Swal.fire({
        icon: 'error',
        title: 'Check-in failed!',
        text: 'Please try again.'
      });
      resetTakeButtonUI();
    });
});

function resetTakeButtonUI() {
  $('#newCustomerBtn .spinner').addClass('hidden');
  $('#newCustomerBtn .btn-text').text('Take Customer');
  $('#newCustomerBtn').prop('disabled', false);
}

// Turn status polling
function updateTurnStatus() {
  $.get('/next-turn-status')
    .done(res => {
      isMyTurn = res.is_your_turn;
      currentTurnUserId = res.current_turn_user_id;

      if (!res.is_checked_in) {
        $('#turn-status').text('❗ Please check in to activate your turn queue.');
      } else if (isMyTurn) {
        $('#turn-status').text(`🟢 It’s your turn now!`);
      } else {
        $('#turn-status').text('⏳ Waiting for your turn...');
      }

      wasTurnBefore = isMyTurn;
      updateNameInputState();
      toggleButtons();
    })
    .fail(() => {
      $('#turn-status').text('⚠️ Error checking turn.');
      isMyTurn = false;
      updateNameInputState();
      toggleButtons();
    });
}

$(document).ready(() => {
  toggleButtons();
  updateTurnStatus();
  setInterval(updateTurnStatus, 10000);
});
</script>



<!-- form auto save -->

<script>
document.addEventListener('DOMContentLoaded', () => {
const form = document.getElementById('salesForm');
const idInput = form.querySelector('input[name="id"]');
const nameInput = form.querySelector('input[name="name"]');
const emailInput = form.querySelector('input[name="email"]');
const phoneInput = form.querySelector('input[name="phone"]');
const interestInput = form.querySelector('input[name="interest"]');
const notesInput = form.querySelector('textarea[name="notes"]');
const appointmentInput = form.querySelector('input[name="appointment_id"]');
const newCustomerBtn = document.getElementById('newCustomerBtn');
const addCustomerBtn = document.getElementById('addCustomerBtn');

let debounceTimeout;
let customerSavedThisTurn = false;
let autosaveEnabled = false;
let loadedFromAppointment = false;

setInterval(() => {
  customerSavedThisTurn = false;
}, 3000);

const attachFieldListeners = () => {
  const fields = form.querySelectorAll('input, textarea, select');
  fields.forEach(field => {
    const handleInput = () => {
      if (!autosaveEnabled) return;
      if (
        loadedFromAppointment &&
        ['email', 'name', 'phone', 'interest'].includes(field.name)
      ) {
        if (!hasStartedManualEdit && !idWasManuallyCleared) {
          idInput.value = '';
          loadedFromAppointment = false;
          idWasManuallyCleared = true;
        }
        hasStartedManualEdit = true;
      }
      customerSavedThisTurn = false;
      clearTimeout(debounceTimeout);
      debounceTimeout = setTimeout(() => {
        autoSaveForm();
      }, 700);
    };

    const handleChange = () => {
      if (!autosaveEnabled) return;
      if (
        loadedFromAppointment &&
        ['email', 'name', 'phone', 'interest'].includes(field.name)
      ) {
        if (!hasStartedManualEdit && !idWasManuallyCleared) {
          idInput.value = '';
          loadedFromAppointment = false;
          idWasManuallyCleared = true;
        }
        hasStartedManualEdit = true;
      }
      customerSavedThisTurn = false;
      clearTimeout(debounceTimeout);
      debounceTimeout = setTimeout(() => {
        autoSaveForm();
      }, 300);
    };

    field.removeEventListener('input', handleInput);
    field.addEventListener('input', handleInput);
    field.removeEventListener('change', handleChange);
    field.addEventListener('change', handleChange);
  });
};

 if (newCustomerBtn) {
  newCustomerBtn.addEventListener('click', async () => {
    if (!isMyTurn) {
      console.log('⛔ Not your turn. Cannot take new customer.');
      return;
    }

    const isFormDirty = !!(
      nameInput.value.trim() ||
      emailInput.value.trim() ||
      phoneInput.value.trim() ||
      interestInput.value.trim() ||
      [...form.querySelectorAll('input[name="process[]"]')].some(cb => cb.checked)
    );

    if (isFormDirty) {
      await autoSaveForm(true);
    } else {
      nameInput.value = '';
      emailInput.value = '';
      phoneInput.value = '';
      interestInput.value = '';
      [...form.querySelectorAll('input[name="process[]"]')].forEach(cb => cb.checked = false);
      await autoSaveForm(true);
    }

    if (idInput.value) {
      autosaveEnabled = true;
      attachFieldListeners();
    }
  });
}


async function autoSaveForm(allowWithoutId = false) {
  console.log('autoSaveForm triggered');

  const appointmentInput = document.querySelector('[name="appointment_id"]');
  const hasAppointment = appointmentInput && appointmentInput.value.trim() !== '';
  const hasCustomerId = idInput && idInput.value.trim() !== '';

  // ✅ Block auto-save if no ID and no appointment, unless explicitly allowed
  if (!hasCustomerId && !hasAppointment && !allowWithoutId) {
    console.log('🚫 No customer ID or appointment — skipping auto-save');
    return;
  }

  if (customerSavedThisTurn) {
    console.log('Skipping save: Already saved recently');
    return;
  }

  const formData = new FormData(form);

  try {
    const response = await fetch('#', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': 'QC0OnL1LR2kjUlIYYOYaXtpXo12h9eO4Hcp5zEMk',
        'X-Requested-With': 'XMLHttpRequest',
      },
      body: formData
    });

    const result = await response.json();
    console.log('✅ Server Response:', result);

   if (result.status === 'success') {
  if (result.id) {
    idInput.value = result.id;
    localStorage.setItem('activeCustomerId', result.id);
  }

  customerSavedThisTurn = true;

  // ✅ Preserve appointment_id
  const appointmentIdValue = appointmentInput?.value;

  if (allowWithoutId && !hasCustomerId) {
    form.querySelectorAll('input[type="hidden"]').forEach(el => {
      if (!['id', 'user_id', 'appointment_id'].includes(el.name)) {
        el.value = '';
      }
    });

    if (appointmentInput && appointmentIdValue) {
      appointmentInput.value = appointmentIdValue;
    }

    idInput.value = result.id;
  }

  await loadCustomers?.();

  applyActiveCard();

  setTimeout(() => {
    const newCard = document.querySelector(`.customer-card[data-customer-id="${result.id}"]`);
    if (newCard) {
      document.querySelectorAll('.customer-card').forEach(c => {
        c.classList.remove('active-card');
      });

      newCard.classList.add('active-card'); 
    } else {
      console.warn('❌ Card not found for customer ID:', result.id);
    }
  }, 300);
}
 else {
      console.error('❌ Save failed:', result);
    }
  } catch (err) {
    console.error('❌ Auto-save error:', err);
  }
}


  async function loadCustomers() {
    try {
      const resp = await fetch('https://headsup.trevinosauto.com/customers?partial=1', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
      });

      const html = await resp.text();
      document.getElementById('customer-list').innerHTML = html;

      bindCardClickEvents();
      bindAppointmentCardClick();
      applyActiveCard();
    } catch (err) {
      console.error('Failed to load customers', err);
    }
  }

  function bindCardClickEvents() {
    document.querySelectorAll('.customer-card').forEach(card => {
      if (card.id === 'appointment-card') return;

      card.addEventListener('click', () => {
        const customerId = card.dataset.customerId;
        if (!customerId) return;

        clearFormFields();

        idInput.value = customerId;
        nameInput.value = card.dataset.name || '';
        emailInput.value = card.dataset.email ?? '';
        phoneInput.value = card.dataset.phone ?? '';
        interestInput.value = card.dataset.interest ?? '';
        notesInput.value = card.dataset.notes ?? '';

       
        if (card.dataset.process) {
          card.dataset.process.split(',').forEach(proc => {
            const checkbox = [...form.querySelectorAll('input[name="process[]"]')]
              .find(cb => cb.value.trim() === proc.trim());
            if (checkbox) checkbox.checked = true;
          });
        }

        document.querySelectorAll('.customer-card').forEach(c => {
          c.classList.remove('active-card');
        });

        card.classList.add('active-card');
        localStorage.setItem('activeCustomerId', customerId);

        autosaveEnabled = true;
        attachFieldListeners();
      });
    });
  }

  function bindAppointmentCardClick() {
    const appointmentCard = document.querySelector('#appointment-card');
    if (!appointmentCard) return;

    appointmentCard.addEventListener('click', async () => {
      if (appointmentCard.classList.contains('hidden')) return;
      if (appointmentCard.dataset.used === 'true') return;

      clearFormFields();

      idInput.value = '';
      nameInput.value = appointmentCard.dataset.name || '';
      emailInput.value = appointmentCard.dataset.email ?? '';
      phoneInput.value = appointmentCard.dataset.phone ?? '';
      interestInput.value = appointmentCard.dataset.interest ?? '';
      appointmentInput.value = appointmentCard.dataset.appointmentId ?? '';

      if (appointmentCard.dataset.process) {
        appointmentCard.dataset.process.split(',').forEach(proc => {
          const checkbox = [...form.querySelectorAll('input[name="process[]"]')]
            .find(cb => cb.value.trim() === proc.trim());
          if (checkbox) checkbox.checked = true;
        });
      }

      document.querySelectorAll('.customer-card').forEach(c => {
        c.classList.remove('active-card');
      });

      appointmentCard.classList.add('active-card');
      appointmentCard.dataset.used = 'true';

      localStorage.setItem('activeCustomerId', appointmentCard.dataset.customerId);
      loadedFromAppointment = true;
      autosaveEnabled = true;
      attachFieldListeners();

      setTimeout(() => {
        console.log('🚀 Auto-saving after appointment click:', appointmentInput.value);
        autoSaveForm(true);
      }, 200);

      appointmentCard.classList.add('hidden');
    });
  }

function clearFormFields() {
  const preservedValues = {
    appointment_id: appointmentInput?.value ?? '',
    user_id: form.querySelector('input[name="user_id"]')?.value ?? '',
  };


  // 🧹 Clear hidden fields (except id, user_id, appointment_id)
  form.querySelectorAll('input[type="hidden"]').forEach(el => {
    if (!['id', 'user_id', 'appointment_id'].includes(el.name)) {
      el.value = '';
    }
  });

  // ✅ Restore preserved values
  if (appointmentInput && preservedValues.appointment_id) {
    appointmentInput.value = preservedValues.appointment_id;
  }

  const userInput = form.querySelector('input[name="user_id"]');
  if (userInput && preservedValues.user_id) {
    userInput.value = preservedValues.user_id;
  }

  form.querySelectorAll('input[name="process[]"]').forEach(cb => {
    cb.checked = false;
  });
}



 function applyActiveCard() {
  if (loadedFromAppointment) return; 

  const savedId = localStorage.getItem('activeCustomerId');
  const savedCard = document.querySelector(`.customer-card[data-customer-id="${savedId}"]`);

  if (!savedCard || savedCard.id === 'appointment-card') return;

  savedCard.classList.add('active-card');

  if (!idInput.value || idInput.value === savedId) {
    clearFormFields();

    idInput.value = savedId;
    nameInput.value = savedCard.dataset.name || '';
    emailInput.value = savedCard.dataset.email ?? '';
    phoneInput.value = savedCard.dataset.phone ?? '';
    interestInput.value = savedCard.dataset.interest ?? '';
    notesInput.value = savedCard.dataset.notes ?? '';

    if (savedCard.dataset.process) {
      savedCard.dataset.process.split(',').forEach(proc => {
        const checkbox = [...form.querySelectorAll('input[name="process[]"]')]
          .find(cb => cb.value.trim() === proc.trim());
        if (checkbox) checkbox.checked = true;
      });
    }

    autosaveEnabled = true;
    attachFieldListeners();
  }
}


if (addCustomerBtn) {
  addCustomerBtn.addEventListener('click', () => {
    const activeCard = document.querySelector('.active-card');
    const form = document.getElementById('salesForm');

    if (activeCard) {
      activeCard.classList.add('pause-animation');
    }

    if (form) {
      form.reset();

      // ✅ Explicitly clear hidden + preserved fields
      form.querySelector('input[name="id"]').value = '';
      form.querySelector('input[name="appointment_id"]').value = '';
     
      form.querySelectorAll('input[name="process[]"]').forEach(cb => cb.checked = false);
    }

  });
}


  bindCardClickEvents();
  bindAppointmentCardClick();
  applyActiveCard();
});
</script>



<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('salesForm');
    const appointmentCard = document.querySelector('#appointment-card');

    const nameInput = document.getElementById('nameInput');
    const phoneInput = document.getElementById('phoneInput');
    const idInput = document.getElementById('customerId');

    // 🔁 Bind click manually so every click re-applies data
    if (appointmentCard && form) {
      appointmentCard.addEventListener('click', () => {
        // Clear values first to ensure update
        nameInput.value = '';
        phoneInput.value = '';
        idInput.value = '';

        // Small delay ensures DOM update
        setTimeout(() => {
          nameInput.value = appointmentCard.dataset.name || '';
          phoneInput.value = appointmentCard.dataset.phone || '';
          idInput.value = appointmentCard.dataset.customerId || '';

          // Mark active
          document.querySelectorAll('.customer-card').forEach(card => {
            card.classList.remove('active-card');
          });
          appointmentCard.classList.add('active-card');
        }, 50); // Delay helps ensure refresh on same value
      });

      // Trigger first click automatically if needed
      appointmentCard.click();
    }
  });
</script>




  <!-- Form Show  -->
 <!-- <script>
  document.getElementById('newCustomerBtn').addEventListener('click', function () {
    document.getElementById('salesForm').classList.remove('hidden');
  });
</script> -->

  <!-- customer form -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.getElementById('salesForm').addEventListener('submit', async function(e) {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);

      // Show processing alert
      Swal.fire({
        title: 'Processing...',
        text: 'Please wait while we save your data.',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });

      try {
        const response = await fetch("#", {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': 'QC0OnL1LR2kjUlIYYOYaXtpXo12h9eO4Hcp5zEMk',
            'Accept': 'application/json'
          },
          body: formData
        });

        const result = await response.json();

        if (response.ok) {
          // Show success message, then redirect
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: result.message || 'Form submitted successfully',
            timer: 2000,
            showConfirmButton: true,
            willClose: () => {
              window.location.href = result.redirect;
            }
          });

          form.reset(); // Optional
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: result.message || 'Something went wrong!',
          });
        }

      } catch (err) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Request failed. Please try again.'
        });
      }
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