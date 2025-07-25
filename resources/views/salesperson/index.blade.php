@extends('layouts.app')

@section('content')
@php
$title = 'Users';
$subtitle = 'View and manage all active sales team members below.';
@endphp
<main class="flex-1 overflow-y-auto">
    <div class="py-6 container mx-auto px-4">

        <div class="flex justify-end mb-4">
            <a href="{{route('saleperson.create')}}" class="text-white px-3 mt-5 py-1.5 rounded bg-gray-800">Add User</a>
        </div>

        <div class="overflow-x-auto rounded-lg shadow border border-gray-200">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border-b px-4 py-2 text-left">Name</th>
                        <th class="border-b px-4 py-2 text-left">Email</th>
                        <th class="border-b px-4 py-2 text-left">Customer</th>
                        <th class="border-b px-4 py-2 text-left">User Type</th>
                        <th class="border-b px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salespeople as $user)
                        <tr class="border-t">
                            <td class="border-b px-4 py-3">{{ $user->name }}</td>
                            <td class="border-b px-4 py-3">{{ $user->email }}</td>
                            <td class="border-b px-4 py-3">{{ $user->customers_count }}</td>

                            <td class="border-b px-4 py-3">{{ ucfirst($user->role) }}</td>
                            <td class="border-b px-4 py-3">
                                <div class="flex gap-2">

                                    <!-- Edit -->
                                    <a href="{{ route('salesperson.edit', $user->id) }}"

                                        class="text-white font-bold px-3 py-1.5 rounded bg-gray-800">
                                        Edit
                                     </a>
                                     
                                    <!-- Delete -->
                                   <button data-id="{{ $user->id }}" class="delete-user text-white font-bold px-3 py-1.5 rounded bg-gray-800">
    Delete
</button>

<!-- Show Activity Button for Sales Person -->
@if($user->role === 'Sales Person')
<a href="{{ url('/salesperson/activity-report?user_id=' . $user->id) }}"
   class="text-white font-bold px-3 py-1.5 rounded bg-gray-800">
    Activity
</a>
@endif

@if($user->role === 'Sales Person' && $user->activeCheckin)
<!-- Checkout -->
<form class="check-out-form" action="{{ url('/sales/person-checkout/' . $user->id) }}" method="POST">
    @csrf
    <button type="submit"
            class="check-out-btn text-white font-bold px-3 py-1.5 rounded bg-gray-800">
        <span class="btn-text">Check Out</span>
        <svg class="btn-spinner hidden animate-spin h-4 w-4 text-white"
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10"
                    stroke="currentColor" stroke-width="4" />
            <path class="opacity-75" fill="currentColor"
                  d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 010 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z" />
        </svg>
    </button>
</form>
@endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // DELETE USER
    document.querySelectorAll('.delete-user').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            Swal.fire({
    title: 'Are you sure?',
    text: "This will delete the user!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'Cancel',
    buttonsStyling: false, // disables default styling so we can fully control it
    customClass: {
        confirmButton: 'bg-gray-800 text-white px-5 py-2 rounded mr-2 hover:bg-gray-900',
        cancelButton: 'bg-red-600 text-white px-5 py-2 rounded hover:bg-red-700'
    }


            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/salesperson/${userId}`, {

                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    }).then(response => response.json())
                      .then(data => {
                          Swal.fire('Deleted!', data.message, 'success').then(() => location.reload());
                      }).catch(err => {
                          Swal.fire('Error', 'Something went wrong.', 'error');
                      });
                }
            });
        });
    });

    // CHECKOUT
    document.querySelectorAll('.check-out-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const button = form.querySelector('.check-out-btn');
            const spinner = form.querySelector('.btn-spinner');
            const btnText = form.querySelector('.btn-text');

            button.disabled = true;
            spinner.classList.remove('hidden');
            btnText.classList.add('hidden');

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'Accept': 'application/json'
                }
            }).then(res => res.json())
              .then(data => {
                  Swal.fire('Success', data.message, 'success');
                  button.disabled = false;
                  spinner.classList.add('hidden');
                  btnText.classList.remove('hidden');
              }).catch(err => {
                  Swal.fire('Error', 'Checkout failed.', 'error');
                  button.disabled = false;
                  spinner.classList.add('hidden');
                  btnText.classList.remove('hidden');
              });
        });
    });
</script>
@endpush
