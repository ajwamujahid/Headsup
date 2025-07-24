<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\UserController;
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// web.php
Route::get('/dashboard', function () {
    return view('dashboard'); // For admin
})->name('admin.dashboard');

 use App\Http\Controllers\SalesManagerController;

Route::get('/manager/dashboard', [SalesManagerController::class, 'dashboard'])->name('manager.dashboard');

use App\Http\Controllers\SalesController;
Route::post('/sales/store', [SalesController::class, 'store'])->name('sales.store');
use App\Http\Controllers\SalesCheckController;
Route::post('/sales/check-toggle', [\App\Http\Controllers\SalesCheckController::class, 'toggle'])
    ->middleware('auth');
    Route::get('/sales/current-turn', [SalesPersonController::class, 'currentTurn']);
    Route::post('/sales/take-customer', [SalesPersonController::class, 'takeCustomer']);

Route::get('/profile', function () {
    return view('profile');
})->name('profile'); // ✅ for GET

Route::patch('/profile', [LoginController::class, 'updateProfile'])->middleware('auth')->name('profile.update'); // ✅ for PATCH

Route::put('/update-password', [LoginController::class, 'updatePassword'])->middleware('auth')->name('password.update');


Route::get('/appointments/create', [AppointmentController::class, 'index'])->name('appointments.create');
Route::post('/appointments/create', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments', [AppointmentController::class, 'showList'])->name('appointments.index');

Route::get('/appointments/{id}/customer_arrived', [AppointmentController::class, 'showArrivalForm'])->name('appointments.customer_arrived');
Route::get('/create/saleperson', [UserController::class, 'create'])->name('saleperson.create');
Route::get('/appointments/{appointment}/show', [AppointmentController::class, 'show'])->name('appointments.show');
// ✅ Route for showing appointment detail page
Route::get('/appointments/{appointment}/show', [App\Http\Controllers\AppointmentController::class, 'show'])->name('appointments.show');
Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');

// Handle the Form Submission
Route::post('/create/saleperson', [UserController::class, 'store'])->name('saleperson.store');


Route::get('/salesperson', [UserController::class, 'index'])->name('salesperson.index');
Route::get('/salesperson/{id}/edit', [UserController::class, 'edit'])->name('salesperson.edit');
Route::put('/salesperson/{id}', [UserController::class, 'update'])->name('salesperson.update');

Route::delete('/salesperson/{id}', [UserController::class, 'destroy'])->name('salesperson.destroy');
use App\Http\Controllers\CustomerSaleController;

Route::get('/customer-sales', [CustomerSaleController::class, 'create'])->name('customer.create');
Route::post('/customer-sales', [CustomerSaleController::class, 'store'])->name('customer.store');

Route::get('/sales/current-turn', function () {
    $current = \App\Models\SalesProfile::where('is_current_turn', true)->first();
    return response()->json([
        'salesperson_id' => $current?->id,
        'name' => $current?->name
    ]);
});

use App\Http\Controllers\SalesPersonController;
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

// Route::post('/sales/store', [SalesPersonController::class, 'storeCustomer']);
Route::get('/sales/available-salespersons', [SalesPersonController::class, 'getSalespersons']);
Route::post('/sales/transfer-customer', [SalesPersonController::class, 'transferCustomer']);
Route::post('/sales/transfer', [SalesPersonController::class, 'transferCustomer']);

Route::get('/sales/current-turn', [SalesPersonController::class, 'currentTurn']);

use App\Http\Controllers\CustomerController;

Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/customers/add', [CustomerController::class, 'create'])->name('customer.add');

Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
use App\Http\Controllers\SalesAppointmentController;

// Route Group for Salesperson (optional middleware: auth, role, etc.)
Route::prefix('salesperson')->name('salesperson.')->group(function () {

    // Appointment creation form (index with salespersons)
    Route::get('/appointments/create', [SalesAppointmentController::class, 'index'])->name('appointments.create');

    // Store new appointment
    Route::post('/appointments', [SalesAppointmentController::class, 'store'])->name('appointments.store');

    // View appointment list (all for this salesperson)
    Route::get('/appointments', [SalesAppointmentController::class, 'showList'])->name('appointments.index');

    // View single completed appointment
    Route::get('/appointments/{id}', [SalesAppointmentController::class, 'show'])->name('appointments.show');

    // Arrival form (when customer arrives)
    Route::get('/appointments/{id}/arrival', [SalesAppointmentController::class, 'showArrivalForm'])->name('appointments.arrival');

    // Edit form for appointment
    Route::get('/appointments/{id}/edit', [SalesAppointmentController::class, 'edit'])->name('appointments.edit');

    // Update appointment details
    Route::put('/appointments/{id}', [SalesAppointmentController::class, 'update'])->name('appointments.update');

});

use App\Http\Controllers\SalesCustomerController;

Route::prefix('salesperson')->name('salesperson.')->group(function () {
    Route::get('/customer', [SalesCustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [SalesCustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer/store', [SalesCustomerController::class, 'store'])->name('customer.store');
});
use App\Http\Controllers\SalespersonActivityController;

Route::prefix('salesperson')->name('salesperson.')->group(function () {
    Route::get('/customer/activity-report', [SalespersonActivityController::class, 'index'])
        ->name('customer.activity-report'); // ❌ REMOVE the extra "salesperson."
});

Route::post('/customers/{id}/assign', [CustomerController::class, 'assign'])->name('customers.assign');

use App\Http\Controllers\CustomerActivityController;

Route::get('/activity', [CustomerActivityController::class, 'index'])->name('customer.customer-activity');
