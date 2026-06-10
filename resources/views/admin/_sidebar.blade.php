{{-- Admin Sidebar Partial --}}
<aside class="w-60 shrink-0 bg-white border-r border-brand-100 shadow-sm hidden lg:block">
    <div class="p-6 space-y-1">
        <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-4 px-3">Admin Panel</p>

        <a href="/admin/dashboard"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-neutralDark {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <span class="text-lg">📊</span> Dashboard
        </a>
        <a href="/admin/therapists"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-neutralDark {{ request()->is('admin/therapists*') ? 'active' : '' }}">
            <span class="text-lg">👨‍⚕️</span> Kelola Terapis
        </a>
        <a href="/admin/users"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-neutralDark {{ request()->is('admin/users*') ? 'active' : '' }}">
            <span class="text-lg">🧑‍💻</span> Kelola Pengguna
        </a>
        <a href="/admin/news"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-neutralDark {{ request()->is('admin/news*') ? 'active' : '' }}">
            <span class="text-lg">📰</span> Kelola Berita
        </a>

        <div class="pt-4 mt-4 border-t border-brand-50">
            <a href="/dashboard"
                class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-gray-400">
                <span class="text-lg">🏠</span> Kembali ke Beranda
            </a>
        </div>
    </div>
</aside>
