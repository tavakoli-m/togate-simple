<?php

use App\Http\Controllers\Api\PaymentFormController;
use App\Http\Controllers\Api\RequestPaymentController;
use Illuminate\Support\Facades\Route;

Route::post('request.json', RequestPaymentController::class);
Route::get('start.json/{payment:token}', [PaymentFormController::class, 'start']);
Route::get('check.json/{payment:token}', [PaymentFormController::class, 'check']);
Route::get('status.json/{payment:token}', [PaymentFormController::class, 'status']);
