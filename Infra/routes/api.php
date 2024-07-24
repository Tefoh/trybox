<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', \App\Http\Controllers\API\V1\LoginController::class)->name('login');
