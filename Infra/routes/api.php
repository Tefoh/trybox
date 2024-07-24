<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', \App\Http\Controllers\API\V1\LoginController::class)->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/customer-address', [\App\Http\Controllers\API\V1\CustomerAddressController::class, 'store'])->name('address-customer.store');

    Route::post('/seller', [\App\Http\Controllers\API\V1\SellerController::class, 'store'])->name('seller.store');

    Route::post('/store/{store}/product', [\App\Http\Controllers\API\V1\ProductController::class, 'store'])->name('store.add-product');
});
