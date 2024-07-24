<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', \App\Http\Controllers\API\V1\LoginController::class)->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/customer-address', [\App\Http\Controllers\API\V1\CustomerAddressController::class, 'store'])->name('address-customer.store');
});
