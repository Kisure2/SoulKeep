@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="flex min-h-[calc(100vh-64px)]">
    @include('admin._sidebar')

    <div class="flex-1 p-8">
        <div class="mb-8">
            <h1 class="text-2xl font-outfit font-extrabold text-neutralDark">🧑‍💻 Kelola Pengguna</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar semua pengguna terdaftar di SoulKeep.</p>
        </div>

        <div class="bg-white rounded-3xl border border-brand-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-brand-50 border-b border-brand-100">
                            <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Pengguna</th>
                            <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Bergabung</th>
                            <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-50">
                        @forelse($users as $user)
                        <tr class="hover:bg-brand-50/30 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                                        class="w-9 h-9 rounded-full object-cover border-2 border-brand-100">
                                    <div>
                                        <p class="font-semibold text-neutralDark">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-400">
                                {{ $user->created_at->format('d M Y') }}<br>
                                <span class="text-gray-300">{{ $user->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST" action="/admin/users/{{ $user->id }}"
                                    onsubmit="return confirm('Hapus pengguna {{ $user->name }}? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-rose-100 text-rose-700 text-xs font-bold rounded-lg hover:bg-rose-600 hover:text-white transition">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-400">
                                <span class="text-4xl block mb-3">🧑‍💻</span>
                                Belum ada pengguna.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-brand-50">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
