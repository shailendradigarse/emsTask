<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\FinanceMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\EventPaymentController;
use App\Http\Controllers\PaymentProviderRequestController;


Route::get('/', function () {

    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth']], function() {

    Route::get('/finance/dashboard', [FinanceController::class, 'index'])->name('finance.dashboard')->middleware(FinanceMiddleware::class);
    Route::get('/finance/edit-payment/{event}', [FinanceController::class, 'editPayment'])->name('finance.editPayment')->middleware(FinanceMiddleware::class);
    Route::put('/finance/update-payment/{event}', [FinanceController::class, 'updatePayment'])->name('finance.updatePayment')->middleware(FinanceMiddleware::class);


// Route to display the form for requesting a new payment provider
Route::get('/payment-provider-requests/create', [PaymentProviderRequestController::class, 'create'])->name('paymentProviderRequests.create');

// Payment provider requests
Route::post('/payment-provider-requests', [PaymentProviderRequestController::class, 'store'])->name('paymentProviderRequests.store');
Route::put('/payment-provider-requests/{id}', [PaymentProviderRequestController::class, 'updateStatus'])->name('paymentProviderRequests.updateStatus')->middleware(AdminMiddleware::class);

Route::get('/admin/payment-provider-requests', [PaymentProviderRequestController::class, 'index'])->name('admin.paymentProviderRequests.index')->middleware(AdminMiddleware::class);
});

require __DIR__.'/auth.php';
