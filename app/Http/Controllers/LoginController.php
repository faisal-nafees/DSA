<?php

namespace App\Http\Controllers;

use App\Mail\LoginMail;
use App\Mail\UserLoginMail;
use Illuminate\Http\Request;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if (request()->isMethod('post')) {
            // $credentials = $request->only('email', 'password');
            $credentials = ['company_webmail' => $request->email, 'password' => $request->password];
            if (Auth::attempt($credentials)) {
                // Authentication passed, redirect to the desired location
                Mail::to(env('MAIL_TO_ADDRESS'))->send(new LoginMail());
                Config::set('mail.from.name', 'DSA IT Backend');
                Mail::to(auth()->user()->personal_email)->send(new UserLoginMail());
                return redirect('/dashboard');
            } else {
                // Authentication failed, redirect back with error message
                return redirect()->back()->with('error', 'Invalid credentials');
            }
        } else {
            return view('admin.login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }

    public function profile()
    {
    }

    public function edit()
    {
    }
}
