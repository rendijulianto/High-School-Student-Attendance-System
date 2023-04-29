<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Inertia
use Inertia\Inertia;
// Models
use App\Models\Teacher;
use Auth;


class LoginController extends Controller
{

    public function index()
    {
        return Inertia::render('Auth/LoginTeacher');
    }


    public function isLogin(Request $request)
    {
       $this->validate($request, [
           'email' => 'required|email',
           'password' => 'required'
       ], [
              'email.required' => 'Email tidak boleh kosong',
              'email.email' => 'Email tidak valid',
              'password.required' => 'Password tidak boleh kosong'
         ]);

        $credentials = $request->only('email', 'password');
         if (Auth::guard('teacher')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.teacher');
         }

         return back()->withErrors([
             'email' => 'Email atau password salah',
         ]);
    }
}
