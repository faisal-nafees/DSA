<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Auth;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if (request()->isMethod('post')) {
            // $credentials = $request->only('email', 'password');
            $credentials = ['company_webmail' => $request->email, 'password' => $request->password];
            if (Auth::attempt($credentials)) {
                // return $credentials;
                // Authentication passed, redirect to the desired location
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
