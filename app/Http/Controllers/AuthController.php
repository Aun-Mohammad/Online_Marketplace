<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login_view()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->except(['_token', 'submit']))) {

            $user = Auth::user();

            if ($user->role == 'seller') {
                return redirect()->route('seller-dashboard');
            } else if ($user->role == 'buyer') {
                return redirect()->route('buyer-dashboard');
            }
        } else {
            return back()->with(['failure' => 'Invalid login credentials']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register_view()
    {
        return view('register');
    }

    /**
     * Display the specified resource.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'role' => ['required'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        $is_registered = User::create($data);

        if ($is_registered) {

            return back()->with(['success' => 'Successfully Registered']);
        } else {
            return back()->with(['failure' => 'Failed to register!']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with(['success' => 'Successfully logged out!']);
    }
}
