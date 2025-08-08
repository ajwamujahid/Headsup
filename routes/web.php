<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesPersonController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SalesManagerController;
use App\Http\Controllers\SalesAppointmentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalespersonActivityController;
use App\Http\Controllers\AdminController;

Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

Route::post('/sales/person-checkout/{id}', [UserController::class, 'personCheckout'])->name('salesperson.checkout');
Route::post('/queues/takeover', [App\Http\Controllers\QueueController::class, 'takeover']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/manager/dashboard', [SalesManagerController::class, 'dashboard'])->name('manager.dashboard'); 
Route::get('/sales/current-turn', [SalesPersonController::class, 'currentTurn']);
Route::post('/sales/take-customer', [SalesPersonController::class, 'takeCustomer']);
Route::get('/profile', function () { return view('profile');})->name('profile'); 
Route::patch('/profile', [LoginController::class, 'updateProfile'])->middleware('auth')->name('profile.update'); 
Route::put('/update-password', [LoginController::class, 'updatePassword'])->middleware('auth')->name('password.update');
// Create Appointment Form
Route::get('/appointments/create', [AppointmentController::class, 'index'])->name('appointments.create');

// Store Appointment (POST)
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

// Appointments List
Route::get('/appointments', [AppointmentController::class, 'showList'])->name('appointments.index');

// Customer Arrival Form
Route::get('/appointments/{id}/customer_arrived', [AppointmentController::class, 'showArrivalForm'])->name('appointments.customer_arrived');

// Show Appointment Detail (no /show suffix)
Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');

// Edit Appointment
Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');

// Update Appointment (PUT)
Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::post('/create/saleperson', [UserController::class, 'store'])->name('saleperson.store');
Route::get('/salesperson/activity-report', [UserController::class, 'activityReport'])->name('sales.activity.report');
Route::get('/salesperson', [UserController::class, 'index'])->name('salesperson.index');
Route::get('/salesperson/{id}/edit', [UserController::class, 'edit'])->name('salesperson.edit');
Route::put('/salesperson/{id}', [UserController::class, 'update'])->name('salesperson.update');
Route::delete('/salesperson/{id}', [UserController::class, 'destroy'])->name('salesperson.destroy');

Route::get('/create/saleperson', [UserController::class, 'create'])->name('saleperson.create');
Route::get('/customer-sales', [CustomerSaleController::class, 'create'])->name('customer.create');
Route::post('/customer-sales', [CustomerSaleController::class, 'store'])->name('customer.store');

Route::get('/sales/current-turn', function () {
    $current = \App\Models\SalesProfile::where('is_current_turn', true)->first();
    return response()->json([
        'salesperson_id' => $current?->id,
        'name' => $current?->name
    ]);
});


Route::get('/sales/current-turn', function () {
    $first = App\Models\SalesCheckin::where('status', 'checked_in')
        ->orderBy('check_in_time')
        ->first();

    return response()->json([
        'current_turn_id' => $first?->salesperson_id
    ]);
});
// web.php or api.php
Route::get('/sales/is-my-turn', function () {
    $salesId = session('sales_id');
    $currentTurn = \App\Models\SalesCheckin::where('is_current_turn', true)->first();

    return response()->json([
        'is_my_turn' => $currentTurn && $currentTurn->salesperson_id == $salesId
    ]);
});

Route::get('/salesperson/dashboard', [SalesPersonController::class, 'dashboard'])->name('salesperson.dashboard');
// Route::post('/sales/check-toggle', [SalesPersonController::class, 'toggleCheck'])->name('sales.check.toggle');
Route::post('/sales/store', [SalesPersonController::class, 'storeCustomer'])->name('sales.store');
Route::get('/sales/current-turn', [SalesPersonController::class, 'currentTurn']);
Route::post('/sales/store', [SalesPersonController::class, 'storeCustomer'])->name('sales.store.customer');
Route::post('/sales/checkout', [SalesPersonController::class, 'checkout']);
Route::post('/sales/check-toggle', [SalesPersonController::class, 'toggleCheck'])->name('sales.check.toggle');

Route::get('/sales/available-salespersons', [SalesPersonController::class, 'getSalespersons']);
Route::post('/sales/transfer-customer', [SalesPersonController::class, 'transferCustomer']);
Route::post('/sales/transfer', [SalesPersonController::class, 'transferCustomer']);

Route::get('/sales/current-turn', [SalesPersonController::class, 'currentTurn']);
Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/customers/add', [CustomerController::class, 'create'])->name('customer.add');

Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');


Route::prefix('salesperson')->name('salesperson.')->group(function () {

    Route::get('/appointments/create', [SalesAppointmentController::class, 'index'])->name('appointments.create');
    Route::post('/appointments', [SalesAppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments', [SalesAppointmentController::class, 'showList'])->name('appointments.index');
    Route::get('/appointments/{id}', [SalesAppointmentController::class, 'show'])->name('appointments.show');
    Route::get('/appointments/{id}/arrival', [SalesAppointmentController::class, 'showArrivalForm'])->name('appointments.arrival');
    Route::get('/appointments/{id}/edit', [SalesAppointmentController::class, 'edit'])->name('appointments.edit');
    
    Route::put('/appointments/{id}', [SalesAppointmentController::class, 'update'])->name('appointments.update');

});


// Route::post('/salesperson/appointments', [SalesAppointmentController::class, 'store'])
//     ->name('salesperson.appointments.store');
// Route::prefix('salesperson')->group(function () {
    
//     Route::get('/appointments', [SalesAppointmentController::class, 'showList'])->name('salesperson.appointments.index');
//     Route::get('/appointments/create', [SalesAppointmentController::class, 'index'])->name('salesperson.appointments.create');
//     Route::post('/appointments', [SalesAppointmentController::class, 'store'])->name('salesperson.appointments.store');
//     Route::get('/appointments/{id}/edit', [SalesAppointmentController::class, 'edit'])->name('salesperson.appointments.edit');
//     Route::put('/appointments/{id}', [SalesAppointmentController::class, 'update'])->name('salesperson.appointments.update');
//     Route::get('/appointments/{id}', [SalesAppointmentController::class, 'show'])->name('salesperson.appointments.show');
//     Route::get('/appointments/{id}/arrived', [SalesAppointmentController::class, 'showArrivalForm'])->name('salesperson.appointments.arrived');
// });

use App\Http\Controllers\SalesCustomerController;

Route::prefix('salesperson')->name('salesperson.')->group(function () {
    Route::get('/customer', [SalesCustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/add', [SalesCustomerController::class, 'add'])->name('customer.add');
    Route::post('/customer/store', [SalesCustomerController::class, 'store'])->name('customer.store');
});
Route::post('/trigger-highlight', [SalesPersonController::class, 'triggerHighlight']);


Route::prefix('salesperson')->name('salesperson.')->group(function () {
    Route::get('/customer/activity-report', [SalespersonActivityController::class, 'index'])
        ->name('customer.activity-report'); 
});

Route::post('/customers/{id}/assign', [CustomerController::class, 'assign'])->name('customers.assign');

use App\Http\Controllers\CustomerActivityController;

Route::get('/activity', [CustomerActivityController::class, 'index'])->name('customer.customer-activity');
use App\Http\Controllers\QueueController;

Route::get('/queues', [QueueController::class, 'index'])->name('queues.index');
Route::post('/highlight-customer', [QueueController::class, 'highlightCustomer'])->name('highlight.customer');
use App\Events\CustomerHighlighted;

Route::get('/highlight-customer/{id}', function ($id) {
    $salespersonName = 'John Doe'; // You can fetch from DB
    event(new CustomerHighlighted($id, $salespersonName));
    return 'Highlight Triggered!';
});
Route::get('/api/sales-checkins', function() {
    $checkins = \App\Models\SalesCheckin::with('salesperson') // Assuming relationship exists
                ->latest('check_in_time')
                ->take(10) // You can paginate as needed
                ->get();

    return response()->json($checkins);
});
Route::post('/api/complete-customer', [QueueController::class, 'completeCustomer']);
Route::get('/checkin-list-fragment', function () {
    $todayCheckins = \App\Models\SalesCheckin::with('salesperson')
        ->whereDate('created_at', now()->toDateString())
        ->latest()
        ->get();

    $checkedInSalespeople = $todayCheckins->unique('salesperson_id');

    return view('partials.checkin-list', ['checkedInSalespeople' => $checkedInSalespeople]);
});
Route::get('/salesperson/{id}', function ($id) {
    $name = \App\Models\SalesProfile::where('id', $id)->value('name');
    return response()->json(['name' => $name ?? 'Unknown']);
});
