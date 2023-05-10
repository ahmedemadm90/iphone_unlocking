<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function dologin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect(route('home'));
        } else {
            return redirect(route('login'))->with(['error' => 'Invaled Credentials']);
        }
    }
    public function doregister(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'country' => 'required',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string',
        ]);
        $input['role_id'] = 2;
        $input['password'] = Hash::make($request->password);
        User::create($input);
        return redirect(route('home'));
    }
}
