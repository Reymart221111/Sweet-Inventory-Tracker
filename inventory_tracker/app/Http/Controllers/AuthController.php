<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $defaultUserId;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function __construct()
    {
        $this->createDefaultAdmin();
    }

    private function createDefaultAdmin()
    {
        $this->defaultUserId = 1;

        if (!User::where('id', $this->defaultUserId)->exists()) {
            // If no admin exists, insert default admin account
            User::create([
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'test@example.com',
                'password' => Hash::make('admin12345'),
                'role' => 'admin'
            ]);

            return; // Skip further execution, admin account has been created
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email address does not match records!'
            ])->onlyInput('email');
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Password is incorrect!'
            ])->onlyInput('email');
        }

        Auth::login($user);

        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect()->intended('admin/dashboard');
        } elseif ($user->role === 'manager') {
            return redirect()->intended('manager/dashboard');
        } elseif ($user->role === 'employee') {
            return redirect()->intended('employee/pos');
        }

        // Optional: Redirect to a default location if role doesn't match
        return redirect()->intended('/');
    }
}
