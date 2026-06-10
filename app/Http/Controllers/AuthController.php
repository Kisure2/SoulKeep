<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // ─── Existing JWT API Methods (unchanged) ────────────────────────────────────

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'in:user,therapist', // admin cannot self-register
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role'     => $validated['role'] ?? 'user',
            'status'   => ($validated['role'] ?? 'user') === 'therapist' ? 'pending' : 'active',
        ]);

        return response()->json(['message' => 'Registered successfully', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Email atau Password salah'], 401);
        }

        $user = auth()->guard('api')->user();

        return response()->json([
            'token' => $token,
            'name'  => $user->name,
            'role'  => $user->role,
            'id'    => $user->id,
        ], 200);
    }

    // ─── Web Session Auth Methods ─────────────────────────────────────────────────

    public function webLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau password tidak sesuai.')->withInput();
        }

        // Regenerate session ID to prevent fixation attacks
        $request->session()->regenerate();

        // Store user data in session using the request session object
        $request->session()->put('user', $user->toArray());
        $request->session()->put('role', $user->role);

        // Force-write session to disk BEFORE redirect (prevents race condition)
        $request->session()->save();

        // Role-based redirect
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'therapist') {
            return redirect('/therapist/dashboard');
        }

        return redirect('/dashboard');
    }

    public function webRegister(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:user,therapist',
        ]);

        $status = $request->role === 'therapist' ? 'pending' : 'active';

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'status'   => $status,
        ]);

        $request->session()->regenerate();
        $request->session()->put('user', $user->toArray());
        $request->session()->put('role', $user->role);
        $request->session()->save();

        if ($user->role === 'therapist') {
            return redirect('/therapist/dashboard');
        }

        return redirect('/dashboard');
    }

    public function webLogout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
    }

    // ─── Helper ──────────────────────────────────────────────────────────────────

    public function getUser(): ?User
    {
        return User::find(session('user.id'));
    }
}