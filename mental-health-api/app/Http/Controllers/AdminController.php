<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount      = User::where('role', 'user')->count();
        $pendingCount   = User::where('role', 'therapist')->where('status', 'pending')->count();
        $therapistCount = User::where('role', 'therapist')->count();
        $newsCount      = News::count();

        return view('admin.dashboard', compact('userCount', 'pendingCount', 'therapistCount', 'newsCount'));
    }

    public function therapists()
    {
        $therapists = User::where('role', 'therapist')->latest()->paginate(15);
        return view('admin.therapists', compact('therapists'));
    }

    public function approveTherapist(User $user)
    {
        $user->update(['status' => 'active']);
        return redirect('/admin/therapists')->with('success', "Terapis {$user->name} telah disetujui.");
    }

    public function rejectTherapist(User $user)
    {
        $user->update(['status' => 'rejected']);
        return redirect('/admin/therapists')->with('success', "Terapis {$user->name} telah ditolak.");
    }

    public function users()
    {
        $users = User::where('role', 'user')->latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect('/admin/users')->with('success', 'Pengguna berhasil dihapus.');
    }
}
