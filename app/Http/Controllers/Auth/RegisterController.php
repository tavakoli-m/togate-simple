<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\SendVerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function form()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $inputs = $request->validated();

        $inputs['password'] = Hash::make($inputs['password']);

        $user = User::create($inputs);

        Mail::to($inputs['email'])->queue(new SendVerificationMail($user));

        return to_route('index');
    }

    public function verify(User $user)
    {
        if($user->status === 1)
        {
            $user->update(['status' => 2]);
        }

        return to_route('index');
    }
}
