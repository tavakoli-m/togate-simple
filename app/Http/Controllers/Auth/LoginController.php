<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function form()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if(!Auth::attempt($request->validated()))
        {
            return back()->with('email','ایمیل یا رمز عبور اشتباه میباشد');
        }

        return to_route('index');
    }
}
