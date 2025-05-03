<?php

use App\Http\Controllers\Api\RequestPaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('request.json',RequestPaymentController::class);