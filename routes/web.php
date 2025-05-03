<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function(){
    Route::get('register',[RegisterController::class,'form'])->name('register.form');
    Route::post('register',[RegisterController::class,'register'])->name('register');
    Route::get('verify/{user:email}',[RegisterController::class,'verify'])->name('register.verify');
});

Route::view('/','welcome')->name('index');