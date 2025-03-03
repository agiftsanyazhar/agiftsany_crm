<?php

namespace App\Http\Controllers;

use App\Http\Requests\{LoginRequest, RegisterRequest};
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('login') ? 'login' : 'register';
        $data['title'] = ucfirst($page);

        return view("auth.{$page}", $data);
    }

    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->only([
                'name',
                'email',
                'phone',
                'address',
                'password',
            ]);

            $data['password'] = Hash::make($data['password']);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            $user->lead()->create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);

            return redirect()->route('auth', ['login' => 'true'])->with('success', 'Register berhasil!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user()->role == 'customer') {
            return redirect()->route('dashboard.customer.index')->with('success', 'Hello, ' . Auth::user()->name . '!');
        }

        return redirect()->route('dashboard.lead.index')->with('success', 'Hello, ' . Auth::user()->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth', ['login' => 'true'])->with('success', 'Logout successful!');
    }
}
