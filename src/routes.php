<?php

use Illuminate\Support\Facades\Route;
use StancerLaravel\Http\Controllers\PaymentController;

Route::post('/payment', [PaymentController::class, 'createPayment'])->name('payment.create');