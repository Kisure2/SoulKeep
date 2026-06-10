@php $active = $active ?? ''; @endphp
<style>
/* ── Sidebar Layout ────────────────────────────────── */
.sk-sidebar {
    position: fixed; top: 0; left: 0; height: 100vh; width: 224px; z-index: 40;
    background: #fff; border-right: 1px solid #E4EDF7;
    display: flex; flex-direction: column;
    box-shadow: 2px 0 16px -4px rgba(57,102,150,0.08);
    transition: transform .25s ease;
}
body { padding-left: 224px; min-height: 100vh; }
.sk-sidebar-logo {
    display: flex; align-items: center; gap: 10px;
    padding: 1.25rem 1.25rem 1rem;
    border-bottom: 1px solid #E4EDF7;
    flex-shrink: 0;
}
.sk-sidebar-logo .sk-logo-icon {
    width: 34px; height: 34px; border-radius: 10px;
    background: linear-gradient(135deg, #396696 0%, #6B8DD6 100%);
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; flex-shrink: 0;
}
.sk-sidebar-logo .sk-logo-text {
    font-family: 'Outfit', sans-serif; font-weight: 900; font-size: 17px;
    color: #1E2229; letter-spacing: -.3px;
}
.sk-sidebar-logo .sk-logo-text span { color: #396696; }
.sk-sidebar-logo .sk-sdg {
    font-size: 8px; font-weight: 800; background: #E4EDF7;
    color: #396696; padding: 2px 5px; border-radius: 5px;
    letter-spacing: .04em; margin-left: auto;
}
.sk-sidebar-nav {
    flex: 1; overflow-y: auto; padding: .75rem .75rem 0;
    display: flex; flex-direction: column; gap: 2px;
}
.sk-nav-link {
    display: flex; align-items: center; gap: 11px;
    padding: .6rem .875rem; border-radius: 10px; text-decoration: none;
    font-size: .8125rem; font-weight: 600; color: #64748b;
    transition: all .18s ease;
}
.sk-nav-link:hover { background: #F4F7FB; color: #396696; }
.sk-nav-link.active {
    background: linear-gradient(135deg, #E4EDF7 0%, #D6E8F5 100%);
    color: #396696; font-weight: 700;
    box-shadow: inset 3px 0 0 #396696;
}
.sk-nav-link .sk-nav-icon { font-size: 16px; flex-shrink: 0; width: 20px; text-align: center; }
.sk-nav-divider { height: 1px; background: #E4EDF7; margin: .5rem .875rem; }
.sk-sidebar-footer {
    padding: .875rem .75rem; border-top: 1px solid #E4EDF7; flex-shrink: 0;
}
.sk-user-card {
    display: flex; align-items: center; gap: 10px;
    padding: .625rem .875rem; border-radius: 10px;
    background: #F4F7FB; margin-bottom: .5rem;
}
.sk-user-avatar {
    width: 32px; height: 32px; border-radius: 50%; background: #E4EDF7;
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 13px; color: #396696; flex-shrink: 0;
}
.sk-user-name { font-size: .8rem; font-weight: 700; color: #1E2229; truncate; }
.sk-user-role { font-size: .65rem; color: #94a3b8; }
.sk-logout-btn {
    display: flex; align-items: center; gap: 8px; width: 100%;
    padding: .5rem .875rem; border-radius: 10px; border: none;
    background: transparent; color: #94a3b8; font-size: .8rem; font-weight: 600;
    cursor: pointer; transition: all .18s; font-family: inherit;
}
.sk-logout-btn:hover { background: #FEF2F2; color: #ef4444; }
/* ── Mobile: hide sidebar, show bottom bar ─────────── */
@media (max-width: 767px) {
    .sk-sidebar { transform: translateX(-100%); }
    body { padding-left: 0 !important; padding-bottom: 64px; }
}
/* ── Bottom bar (mobile only) ──────────────────────── */
.sk-bottom-bar {
    display: none; position: fixed; bottom: 0; left: 0; right: 0; z-index: 40;
    background: rgba(255,255,255,.97); backdrop-filter: blur(20px);
    border-top: 1px solid #E4EDF7;
}
@media (max-width: 767px) { .sk-bottom-bar { display: block; } }
.sk-bottom-bar-inner { display: flex; align-items: center; height: 60px; padding: 0 4px; }
.sk-bar-link {
    flex: 1; display: flex; flex-direction: column; align-items: center;
    justify-content: center; gap: 2px; text-decoration: none;
    color: #94a3b8; border-radius: 8px; padding: 4px 2px; transition: all .2s;
}
.sk-bar-link:hover, .sk-bar-link.active { color: #396696; }
.sk-bar-link .sk-bar-icon { font-size: 19px; line-height: 1; }
.sk-bar-link .sk-bar-label { font-size: 8px; font-weight: 700; }
</style>

{{-- ── SIDEBAR ─────────────────────────────── --}}
<aside class="sk-sidebar">
    {{-- Logo --}}
    <div class="sk-sidebar-logo">
        <div class="sk-logo-icon">💙</div>
        <span class="sk-logo-text">Soul<span>Keep</span></span>
        <span class="sk-sdg">SDG 3</span>
    </div>

    {{-- Nav Links --}}
    <nav class="sk-sidebar-nav">
        <a href="/dashboard"  class="sk-nav-link {{ $active==='dashboard'  ? 'active' : '' }}">
            <span class="sk-nav-icon">🏠</span> Dashboard
        </a>
        <a href="/assessment" class="sk-nav-link {{ $active==='assessment' ? 'active' : '' }}">
            <span class="sk-nav-icon">📝</span> Tes Stres
        </a>
        <a href="/relaxation" class="sk-nav-link {{ $active==='relaxation' ? 'active' : '' }}">
            <span class="sk-nav-icon">🌬️</span> Relaksasi
        </a>
        <a href="/games"      class="sk-nav-link {{ $active==='games'      ? 'active' : '' }}">
            <span class="sk-nav-icon">🎮</span> Terapi Game
        </a>
        <a href="/nearby"     class="sk-nav-link {{ $active==='nearby'     ? 'active' : '' }}">
            <span class="sk-nav-icon">📍</span> Psikolog
        </a>
        <a href="/education"  class="sk-nav-link {{ $active==='education'  ? 'active' : '' }}">
            <span class="sk-nav-icon">📚</span> Library
        </a>

        <div class="sk-nav-divider"></div>

        <a href="/news"       class="sk-nav-link {{ $active==='news'       ? 'active' : '' }}">
            <span class="sk-nav-icon">📰</span> Berita
        </a>
        <a href="/chat"       class="sk-nav-link {{ $active==='chat'       ? 'active' : '' }}">
            <span class="sk-nav-icon">💬</span> Chat Terapis
        </a>
        <a href="/profile"    class="sk-nav-link {{ $active==='profile'    ? 'active' : '' }}">
            <span class="sk-nav-icon">👤</span> Profil
        </a>
    </nav>

    {{-- Footer: user info + logout --}}
    <div class="sk-sidebar-footer">
        <div class="sk-user-card">
            <div class="sk-user-avatar" id="user-avatar">U</div>
            <div style="min-width:0">
                <div class="sk-user-name" id="user-name">Pengguna</div>
                <div class="sk-user-role">User</div>
            </div>
        </div>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="sk-logout-btn">
                🚪 Keluar
            </button>
        </form>
    </div>
</aside>

{{-- ── MOBILE BOTTOM BAR ───────────────────── --}}
<div class="sk-bottom-bar">
    <div class="sk-bottom-bar-inner">
        <a href="/dashboard"  class="sk-bar-link {{ $active==='dashboard'  ? 'active' : '' }}">
            <span class="sk-bar-icon">🏠</span><span class="sk-bar-label">Home</span>
        </a>
        <a href="/assessment" class="sk-bar-link {{ $active==='assessment' ? 'active' : '' }}">
            <span class="sk-bar-icon">📝</span><span class="sk-bar-label">Tes</span>
        </a>
        <a href="/games"      class="sk-bar-link {{ $active==='games'      ? 'active' : '' }}">
            <span class="sk-bar-icon">🎮</span><span class="sk-bar-label">Game</span>
        </a>
        <a href="/news"       class="sk-bar-link {{ $active==='news'       ? 'active' : '' }}">
            <span class="sk-bar-icon">📰</span><span class="sk-bar-label">Berita</span>
        </a>
        <a href="/chat"       class="sk-bar-link {{ $active==='chat'       ? 'active' : '' }}">
            <span class="sk-bar-icon">💬</span><span class="sk-bar-label">Chat</span>
        </a>
    </div>
</div>
