<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\GatewayController;
use App\Http\Controllers\Dashboard\PaymentController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function(){
    Route::get('register',[RegisterController::class,'form'])->name('register.form');
    Route::post('register',[RegisterController::class,'register'])->name('register');
    Route::get('verify/{user:email}',[RegisterController::class,'verify'])->name('register.verify');

    Route::get('login',[LoginController::class,'form'])->name('login.form');
    Route::post('login',[LoginController::class,'login'])->name('login');
});

Route::prefix('dashboard')->name('dashboard.')->group(function(){
    Route::view('/','dashboard.index')->name('index');

    Route::resource('gateway',GatewayController::class);

    Route::get('/payment',PaymentController::class)->name('payment.index');
});

Route::view('/','welcome')->name('index');