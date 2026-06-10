@extends('layouts.app')

@section('title', 'Kelola Terapis')

@section('content')
<div class="flex min-h-[calc(100vh-64px)]">
    @include('admin._sidebar')

    <div class="flex-1 p-8">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-outfit font-extrabold text-neutralDark">👨‍⚕️ Kelola Terapis</h1>
                <p class="text-sm text-gray-500 mt-1">Approve atau tolak pendaftaran terapis.</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-brand-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-brand-50 border-b border-brand-100">
                            <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Terapis</th>
                            <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Bio</th>
                            <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                            <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Bergabung</th>
                            <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-50">
                        @forelse($therapists as $therapist)
                        <tr class="hover:bg-brand-50/30 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $therapist->avatar_url }}" alt="{{ $therapist->name }}"
                                        class="w-10 h-10 rounded-full object-cover border-2 border-brand-100">
                                    <div>
                                        <p class="font-semibold text-neutralDark">{{ $therapist->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $therapist->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 max-w-xs">
                                <p class="text-xs text-gray-500 line-clamp-2">{{ $therapist->bio ?: '—' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($therapist->status === 'active')
                                    <span class="inline-flex items-center gap-1 text-xs font-bold bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full">✅ Aktif</span>
                                @elseif($therapist->status === 'pending')
                                    <span class="inline-flex items-center gap-1 text-xs font-bold bg-amber-100 text-amber-700 px-3 py-1 rounded-full">⏳ Pending</span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-xs font-bold bg-rose-100 text-rose-700 px-3 py-1 rounded-full">❌ Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-400">{{ $therapist->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @if($therapist->status !== 'active')
                                        <form method="POST" action="/admin/therapists/{{ $therapist->id }}/approve">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 bg-emerald-600 text-white text-xs font-bold rounded-lg hover:bg-emerald-700 transition">
                                                ✅ Approve
                                            </button>
                                        </form>
                                    @endif
                                    @if($therapist->status !== 'rejected')
                                        <form method="POST" action="/admin/therapists/{{ $therapist->id }}/reject">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 bg-rose-600 text-white text-xs font-bold rounded-lg hover:bg-rose-700 transition"
                                                onclick="return confirm('Tolak terapis {{ $therapist->name }}?')">
                                                ❌ Tolak
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <span class="text-4xl block mb-3">👨‍⚕️</span>
                                Belum ada terapis yang mendaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($therapists->hasPages())
                <div class="px-6 py-4 border-t border-brand-50">
                    {{ $therapists->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
