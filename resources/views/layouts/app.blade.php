<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'SoulKeep — Platform kesehatan mental untuk mahasiswa Indonesia.')">
    <meta name="theme-color" content="#396696">
    <title>@yield('title', 'SoulKeep') — SoulKeep</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💙</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { outfit: ['Outfit', 'sans-serif'], jakarta: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        brand: { 50:'#F4F7FB',100:'#E4EDF7',200:'#C7DCEF',300:'#9CBEDF',400:'#6E9DCC',500:'#4B81B7',600:'#396696',700:'#2E5178',850:'#203853',900:'#17293D' },
                        neutralDark: '#1E2229'
                    }
                }
            }
        }
    </script>
    <style>
        * { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #1E2229; background: #f8fafc; }
        .nav-link { transition: all 0.2s ease; }
        .nav-link:hover { color: #396696; }
        .nav-link.active { color: #396696; font-weight: 700; }
        @keyframes fadeDown { from{opacity:0;transform:translateY(-8px)} to{opacity:1;transform:translateY(0)} }
        .dropdown-menu { animation: fadeDown 0.2s ease-out; }
        @keyframes slideIn { from{opacity:0;transform:translateX(20px)} to{opacity:1;transform:translateX(0)} }
        .flash-msg { animation: slideIn 0.3s ease-out; }
        .sidebar-link { transition: all 0.2s ease; border-radius: 0.75rem; }
        .sidebar-link:hover { background: #E4EDF7; color: #396696; }
        .sidebar-link.active { background: #396696; color: white; }
        @yield('extra_styles')
    </style>
    @yield('head_extra')
</head>
<body class="min-h-screen">

    {{-- ==================== NAVBAR ==================== --}}
    @if(session('role') === 'user')
    @php
        $sidebarActive = '';
        if (request()->is('news*'))    $sidebarActive = 'news';
        elseif (request()->is('chat*'))    $sidebarActive = 'chat';
        elseif (request()->is('profile*')) $sidebarActive = 'profile';
        elseif (request()->is('dashboard')) $sidebarActive = 'dashboard';
    @endphp
    @include('partials.user-sidebar', ['active' => $sidebarActive])
    @else
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-xl border-b border-brand-100 shadow-sm shadow-brand-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center h-16">

                {{-- Logo --}}
                <a href="/" class="flex items-center gap-2 text-lg font-outfit font-extrabold text-brand-700 tracking-tight shrink-0">
                    💙 SoulKeep
                    <span class="text-[9px] bg-brand-600 text-white px-1.5 py-0.5 rounded-full font-bold">SDG 3</span>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-1 text-sm font-semibold text-neutralDark/70">
                    @if(session('role') === 'admin')
                        <a href="/admin/dashboard" class="nav-link px-3 py-2 rounded-lg {{ request()->is('admin*') ? 'active' : '' }}">⚙️ Admin</a>
                    @elseif(session('role') === 'therapist')
                        <a href="/therapist/dashboard" class="nav-link px-3 py-2 rounded-lg {{ request()->is('therapist*') ? 'active' : '' }}">💬 Panel Terapis</a>
                    @elseif(session('role') === 'user')
                        <a href="/dashboard" class="nav-link px-3 py-2 rounded-lg {{ request()->is('dashboard') ? 'active' : '' }}">🏠 Dashboard</a>
                        <a href="/chat" class="nav-link px-3 py-2 rounded-lg {{ request()->is('chat*') ? 'active' : '' }}">💬 Chat Terapis</a>
                        <a href="/assessment" class="nav-link px-3 py-2 rounded-lg {{ request()->is('assessment') ? 'active' : '' }}">📝 Tes Stres</a>
                        <a href="/relaxation" class="nav-link px-3 py-2 rounded-lg {{ request()->is('relaxation') ? 'active' : '' }}">🌬️ Relaksasi</a>
                        <a href="/games" class="nav-link px-3 py-2 rounded-lg {{ request()->is('games*') ? 'active' : '' }}">🎮 Games</a>
                    @endif
                    <a href="/news" class="nav-link px-3 py-2 rounded-lg {{ request()->is('news*') ? 'active' : '' }}">📰 Berita</a>
                </div>

                {{-- Right Side --}}
                <div class="flex items-center gap-3">
                    @if(session('user'))
                        {{-- User Avatar Dropdown --}}
                        <div class="relative" id="user-dropdown-wrap">
                            <button onclick="toggleDropdown()" id="avatar-btn"
                                class="flex items-center gap-2 p-1 rounded-xl hover:bg-brand-50 transition border border-transparent hover:border-brand-100">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(session('user.name', 'U')) }}&background=396696&color=fff&size=64"
                                     alt="Avatar" class="w-8 h-8 rounded-full object-cover border-2 border-brand-200"
                                     id="nav-avatar">
                                <span class="hidden sm:block text-sm font-semibold text-neutralDark max-w-[120px] truncate">{{ session('user.name') }}</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            {{-- Dropdown --}}
                            <div id="user-dropdown" class="dropdown-menu hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-brand-100 py-2 z-50">
                                <div class="px-4 py-2 border-b border-brand-50 mb-1">
                                    <p class="text-xs font-bold text-neutralDark truncate">{{ session('user.name') }}</p>
                                    <p class="text-[11px] text-gray-400 truncate">{{ session('user.email') }}</p>
                                    <span class="mt-1 inline-block text-[10px] font-bold px-2 py-0.5 rounded-full
                                        @if(session('role') === 'admin') bg-purple-100 text-purple-700
                                        @elseif(session('role') === 'therapist') bg-teal-100 text-teal-700
                                        @else bg-brand-100 text-brand-700 @endif">
                                        {{ ucfirst(session('role', 'user')) }}
                                    </span>
                                </div>
                                <a href="/profile" class="flex items-center gap-2 px-4 py-2.5 text-sm text-neutralDark hover:bg-brand-50 transition">
                                    <span>👤</span> Profil Saya
                                </a>
                                @if(session('role') === 'admin')
                                    <a href="/admin/dashboard" class="flex items-center gap-2 px-4 py-2.5 text-sm text-neutralDark hover:bg-brand-50 transition">
                                        <span>⚙️</span> Admin Panel
                                    </a>
                                @elseif(session('role') === 'therapist')
                                    <a href="/therapist/dashboard" class="flex items-center gap-2 px-4 py-2.5 text-sm text-neutralDark hover:bg-brand-50 transition">
                                        <span>💬</span> Panel Terapis
                                    </a>
                                @endif
                                <div class="border-t border-brand-50 mt-1 pt-1">
                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-2 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                                            <span>🚪</span> Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="/login" class="text-sm font-bold text-neutralDark/70 hover:text-brand-600 transition px-3 py-2">Masuk</a>
                        <a href="/register" class="px-4 py-2 bg-brand-600 text-white text-sm font-bold rounded-xl hover:bg-brand-700 transition shadow-md shadow-brand-200">Daftar →</a>
                    @endif

                    {{-- Mobile hamburger --}}
                    <button id="mobile-hamburger" onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-xl hover:bg-brand-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div id="mobile-menu" class="hidden md:hidden pb-4 border-t border-brand-100 pt-3 space-y-1">
                @if(session('role') === 'user')
                    <a href="/dashboard" class="block px-4 py-2.5 text-sm font-semibold rounded-xl hover:bg-brand-50 transition">🏠 Dashboard</a>
                    <a href="/chat" class="block px-4 py-2.5 text-sm font-semibold rounded-xl hover:bg-brand-50 transition">💬 Chat Terapis</a>
                    <a href="/assessment" class="block px-4 py-2.5 text-sm font-semibold rounded-xl hover:bg-brand-50 transition">📝 Tes Stres</a>
                    <a href="/relaxation" class="block px-4 py-2.5 text-sm font-semibold rounded-xl hover:bg-brand-50 transition">🌬️ Relaksasi</a>
                    <a href="/games" class="block px-4 py-2.5 text-sm font-semibold rounded-xl hover:bg-brand-50 transition">🎮 Games</a>
                @elseif(session('role') === 'therapist')
                    <a href="/therapist/dashboard" class="block px-4 py-2.5 text-sm font-semibold rounded-xl hover:bg-brand-50 transition">💬 Panel Terapis</a>
                @elseif(session('role') === 'admin')
                    <a href="/admin/dashboard" class="block px-4 py-2.5 text-sm font-semibold rounded-xl hover:bg-brand-50 transition">⚙️ Admin Panel</a>
                @endif
                <a href="/news" class="block px-4 py-2.5 text-sm font-semibold rounded-xl hover:bg-brand-50 transition">📰 Berita</a>
                @if(session('user'))
                    <a href="/profile" class="block px-4 py-2.5 text-sm font-semibold rounded-xl hover:bg-brand-50 transition">👤 Profil</a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2.5 text-sm font-semibold text-red-600 rounded-xl hover:bg-red-50 transition">🚪 Keluar</button>
                    </form>
                @else
                    <a href="/login" class="block px-4 py-2.5 text-sm font-semibold rounded-xl hover:bg-brand-50 transition">Masuk</a>
                    <a href="/register" class="block px-4 py-2.5 text-sm font-semibold text-brand-600 rounded-xl hover:bg-brand-50 transition">Daftar Gratis →</a>
                @endif
            </div>
        </div>
    </nav>
    @endif

    {{-- ==================== FLASH MESSAGES ==================== --}}
    @if(session('success'))
        <div class="flash-msg max-w-7xl mx-auto px-4 sm:px-6 pt-4">
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-3 rounded-2xl text-sm font-semibold shadow-sm">
                <span class="text-lg">✅</span>
                {{ session('success') }}
                <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-emerald-500 hover:text-emerald-700 font-bold">✕</button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="flash-msg max-w-7xl mx-auto px-4 sm:px-6 pt-4">
            <div class="flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-800 px-5 py-3 rounded-2xl text-sm font-semibold shadow-sm">
                <span class="text-lg">❌</span>
                {{ session('error') }}
                <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-rose-400 hover:text-rose-600 font-bold">✕</button>
            </div>
        </div>
    @endif
    @if($errors->any())
        <div class="flash-msg max-w-7xl mx-auto px-4 sm:px-6 pt-4">
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-3 rounded-2xl text-sm font-semibold shadow-sm">
                <span class="font-bold">⚠️ Terdapat kesalahan:</span>
                <ul class="mt-1 list-disc list-inside text-xs space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- ==================== MAIN CONTENT ==================== --}}
    <main>
        @yield('content')
    </main>

    {{-- ==================== FOOTER ==================== --}}
    <footer class="bg-neutralDark text-white mt-16">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2 text-lg font-outfit font-extrabold">
                    💙 SoulKeep
                </div>
                <p class="text-sm text-white/50">© 2026 SoulKeep · Platform Kesehatan Mental Mahasiswa Indonesia · Mendukung UN SDG 3</p>
                <div class="flex gap-4 text-xs text-white/40">
                    <a href="/news" class="hover:text-white transition">Berita</a>
                    <a href="/nearby" class="hover:text-white transition">Psikolog Terdekat</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Dropdown toggle
        function toggleDropdown() {
            document.getElementById('user-dropdown').classList.toggle('hidden');
        }
        // Close dropdown on outside click
        document.addEventListener('click', function(e) {
            const wrap = document.getElementById('user-dropdown-wrap');
            if (wrap && !wrap.contains(e.target)) {
                document.getElementById('user-dropdown')?.classList.add('hidden');
            }
        });
        // Mobile menu toggle
        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }
    </script>

    @yield('scripts')
</body>
</html>
