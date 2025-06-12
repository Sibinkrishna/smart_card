<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     // Register
     public function index(){
        return view('User.auth.register');
     }
     public function loginIndex(){
        return view('User.Auth.login');
     }
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|digits:10|unique:users,phone',
            'password'   => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => Hash::make($request->password),
        ]);

        Auth::login($user); // auto-login
        return redirect('/');
        // return response()->json(['message' => 'Registered successfully', 'user' => $user]);
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required', // email or phone
            'password' => 'required',
        ]);

        $user = User::where('email', $request->login)
                    ->orWhere('phone', $request->login)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        if ($user->status != 'active') {
            return response()->json(['message' => 'Account is not active'], 403);
        }

        Auth::login($user); // Session login
        return response()->json(['message' => 'Login successful', 'user' => $user]);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out']);
    }
}
