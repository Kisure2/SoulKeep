<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::find(session('user.id'));
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(session('user.id'));

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:500',
            'bio'     => 'nullable|string|max:1000',
            'avatar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'address', 'bio']);

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        // Refresh session
        session(['user' => $user->fresh()->toArray()]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(session('user.id'));

        $request->validate([
            'current_password' => 'required|string',
            'password'         => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password saat ini tidak sesuai.');
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}
