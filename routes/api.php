<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\PaymentProviderRequestController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/events', [EventController::class, 'index'])->name('api.events');
Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('api.payment-methods');
Route::get('/companies', [CompanyController::class, 'index'])->name('api.companies');
Route::get('/payment-provider-requests', [PaymentProviderRequestController::class, 'index'])->name('api.payment-provider-requests');
