<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SoulKeep — Aplikasi kesehatan mental untuk mahasiswa. Lacak mood, tes stres, dan teknik relaksasi. Mendukung UN SDG 3.">
    <meta name="theme-color" content="#396696">
    <title>Dashboard — SoulKeep</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💙</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        outfit: ['Outfit', 'sans-serif'],
                        jakarta: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#F4F7FB',
                            100: '#E4EDF7',
                            200: '#C7DCEF',
                            300: '#9CBEDF',
                            400: '#6E9DCC',
                            500: '#4B81B7',
                            600: '#396696',
                            700: '#2E5178',
                            850: '#203853',
                            900: '#17293D',
                        },
                        neutralDark: '#1E2229',
                    }
                }
            }
        }
    </script>
    <style>
        * { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #1E2229; background: #F4F7FB; }
        @keyframes fadeUp { from{opacity:0;transform:translateY(28px)} to{opacity:1;transform:translateY(0)} }
        .fade-up { animation: fadeUp 0.65s ease-out forwards; opacity:0; }
        .fade-up-d1 { animation-delay:0.1s; }
        .fade-up-d2 { animation-delay:0.22s; }
        .fade-up-d3 { animation-delay:0.34s; }
        @keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }
        .skeleton { background: linear-gradient(90deg, #E4EDF7 25%, #D4E5F3 50%, #E4EDF7 75%); background-size: 200% 100%; animation: shimmer 1.4s infinite; }
        @keyframes slideUp { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
        @keyframes toastIn { from{opacity:0;transform:translateY(16px) scale(.96)} to{opacity:1;transform:translateY(0) scale(1)} }
        @keyframes streakPulse { 0%,100%{transform:scale(1)} 50%{transform:scale(1.15)} }
        nav.scrolled { box-shadow: 0 4px 24px -6px rgba(57,102,150,0.18); }
        .nav-item { color: #64748b; transition: all 0.25s ease; }
        .nav-item:hover { background: #E4EDF7; color: #2E5178; border-radius: 8px; }
        .nav-item.active { background: #E4EDF7; color: #2E5178; font-weight: 700; border-radius: 8px; }
        .mob-nav-item { display:flex; flex-direction:column; align-items:center; justify-content:center; flex:1; padding:6px 2px; color:#94a3b8; transition:all 0.25s ease; text-decoration:none; }
        .mob-nav-item:hover { color:#396696; }
        .mob-nav-item.active { color:#396696; }
        .card { background:#fff; border-radius:16px; border:1px solid #E4EDF7; padding:1.5rem; transition: all 0.3s ease; }
        .card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px -8px rgba(57,102,150,0.15); }
        .card-hover { background:#fff; border-radius:16px; border:1px solid #E4EDF7; padding:1.5rem; transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 12px 32px -8px rgba(57,102,150,0.15); }
        .btn-primary { background:#396696; color:#fff; font-weight:700; padding:0.75rem 1.5rem; border-radius:12px; border:none; cursor:pointer; transition: all 0.25s ease; font-size:0.875rem; }
        .btn-primary:hover { background:#2E5178; transform: translateY(-2px); box-shadow: 0 8px 20px -6px rgba(57,102,150,0.3); }
        .btn-ghost { background:#fff; color:#396696; border:1.5px solid #E4EDF7; font-weight:700; padding:0.75rem 1.5rem; border-radius:12px; cursor:pointer; transition: all 0.25s ease; font-size:0.875rem; }
        .btn-ghost:hover { background:#F4F7FB; border-color:#396696; }
        input[type=range] { -webkit-appearance:none; height:6px; border-radius:6px; outline:none; cursor:pointer; }
        input[type=range]::-webkit-slider-thumb { -webkit-appearance:none; width:20px; height:20px; border-radius:50%; background:#396696; border:2.5px solid #fff; box-shadow:0 2px 8px rgba(57,102,150,0.4); cursor:pointer; transition:transform .15s; }
        input[type=range]::-webkit-slider-thumb:hover { transform:scale(1.2); }
        .toast-notification { animation:toastIn .3s cubic-bezier(.34,1.56,.64,1) both; border-radius:12px; }
        .mood-card { animation:slideUp 0.3s ease-out; }
        .delete-btn { opacity:0; transition:opacity .2s ease; }
        .mood-card-wrap:hover .delete-btn { opacity:1; }
        .fire-icon { animation:streakPulse 2s ease-in-out infinite; display:inline-block; }
        /* === VISUAL UPGRADE === */
        @keyframes blobMove { 0%,100%{border-radius:60% 40% 30% 70%/60% 30% 70% 40%} 50%{border-radius:30% 60% 70% 40%/50% 60% 30% 60%} }
        .blob-anim { animation: blobMove 12s ease-in-out infinite; }
        .blob-delay-1 { animation-delay: 3s; }
        .blob-delay-2 { animation-delay: 6s; }
        @keyframes gradientShift { 0%{background-position:0% 50%} 50%{background-position:100% 50%} 100%{background-position:0% 50%} }
        .gradient-animate { background-size:200% 200%; animation:gradientShift 8s ease infinite; }
        .img-overlay { position: absolute; inset: 0; background: linear-gradient(180deg, transparent 0%, rgba(30,34,41,0.65) 100%); }
        .icon-box { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .shape-circle { border-radius: 50%; position: absolute; opacity: 0.5; filter: blur(40px); pointer-events: none; }
        .shape-blob { position: absolute; filter: blur(60px); pointer-events: none; }
        .stat-card { border-radius: 16px; border: 1px solid #E4EDF7; padding: 1rem; display: flex; align-items: flex-start; gap: 0.75rem; transition: all 0.3s ease; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 12px 32px -8px rgba(57,102,150,0.15); }
    </style>
</head>
<body class="min-h-screen flex flex-col" style="background:#F4F7FB;color:#1E2229">

    <!-- Navigation -->
    <nav id="main-nav" class="sticky top-0 z-40 backdrop-blur-md bg-white/95 border-b border-[#E4EDF7] transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center h-16">
            <a href="/dashboard" class="flex items-center gap-2 text-lg font-outfit font-extrabold text-[#396696] tracking-tight mr-8 shrink-0">
                💙 SoulKeep
                <span class="text-[9px] bg-[#E4EDF7] text-[#396696] px-2 py-0.5 rounded-md font-bold">SDG 3</span>
            </a>
            <div class="hidden md:flex items-center gap-1 flex-1 justify-center">
                <a href="/dashboard"  class="nav-item active px-3 py-2 text-sm font-semibold">🏠 Dashboard</a>
                <a href="/assessment" class="nav-item px-3 py-2 text-sm font-semibold">📝 Tes Stres</a>
                <a href="/relaxation" class="nav-item px-3 py-2 text-sm font-semibold">🌬️ Relaksasi</a>
                <a href="/games"      class="nav-item px-3 py-2 text-sm font-semibold">🎮 Terapi Game</a>
                <a href="/nearby"     class="nav-item px-3 py-2 text-sm font-semibold">📍 Psikolog</a>
                <a href="/education"  class="nav-item px-3 py-2 text-sm font-semibold">📚 Library</a>
            </div>
            <div class="flex items-center gap-3 ml-auto">
                <div class="hidden sm:flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-[#E4EDF7] flex items-center justify-center font-bold text-xs text-[#396696]" id="user-avatar">U</div>
                    <span class="text-sm font-semibold text-[#1E2229]" id="user-name">Pengguna</span>
                </div>
                <button onclick="logout()" class="text-xs font-bold px-3 py-1.5 rounded-lg bg-[#E4EDF7] text-[#396696] hover:bg-[#396696] hover:text-white transition-all">Keluar</button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 sm:py-10 space-y-8 pb-24 md:pb-10">

        <!-- Hero Section -->
        <div class="relative overflow-hidden rounded-2xl mb-8 h-[260px] sm:h-[300px] fade-up fade-up-d1">
            <img src="https://images.unsplash.com/photo-1518241353330-0f7941c2d9b5?w=1200&q=70" alt="hero dashboard" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute -top-20 -right-20 w-64 h-64 shape-blob bg-white/5 shape-circle blob-anim hidden sm:block"></div>
            <div class="img-overlay"></div>
            <div class="relative z-10 h-full flex flex-col justify-between p-6 sm:p-8">
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center gap-2 text-xs font-bold bg-white/15 text-white px-4 py-1.5 rounded-full border border-white/30 backdrop-blur-sm">🌍 Kesehatan Mental · SDG Goal 3</span>
                    <div class="flex items-center gap-2 bg-white/15 backdrop-blur-sm border border-white/25 rounded-xl px-3 py-2">
                        <span class="fire-icon text-xl">🔥</span>
                        <div>
                            <p class="text-lg font-outfit font-black text-white leading-none" id="banner-streak">—</p>
                            <p class="text-[9px] text-white/70 font-semibold">hari streak</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <h1 class="text-3xl sm:text-4xl font-outfit font-black text-white leading-tight">
                        Halo, <span id="welcome-name" class="text-white/90">Pengguna</span>! 👋
                    </h1>
                    <p id="affirmation-text" class="text-white/80 text-sm sm:text-base max-w-md leading-relaxed">Memuat afirmasi hari ini...</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="stat-card fade-up fade-up-d1 bg-gradient-to-br from-white to-[#F4F7FB]">
                <div class="icon-box" style="background: linear-gradient(135deg, #396696, #2E5178);">
                    <span class="text-xl">📝</span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-[#94a3b8] uppercase tracking-wide">Total</p>
                    <p class="text-2xl font-outfit font-extrabold text-[#1E2229]" id="stat-total">—</p>
                    <span id="trend-total" class="text-xs font-semibold text-[#64748b]">memuat...</span>
                </div>
            </div>
            <div class="stat-card fade-up fade-up-d2 bg-gradient-to-br from-white to-[#F0FDF4]">
                <div class="icon-box" style="background: linear-gradient(135deg, #10B981, #059669);">
                    <span class="text-xl">📈</span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-[#94a3b8] uppercase tracking-wide">Rata-rata</p>
                    <p class="text-2xl font-outfit font-extrabold text-[#1E2229]" id="stat-average">—</p>
                    <span id="trend-avg" class="text-xs font-semibold text-[#64748b]">7 hari</span>
                </div>
            </div>
            <div class="stat-card fade-up fade-up-d3 bg-gradient-to-br from-white to-[#F3E8FF]">
                <div class="icon-box" style="background: linear-gradient(135deg, #8B5CF6, #7C3AED);">
                    <span class="text-xl">✨</span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-[#94a3b8] uppercase tracking-wide">Status</p>
                    <p class="text-sm font-bold text-[#1E2229] leading-tight mt-1" id="stat-status">—</p>
                </div>
            </div>
            <div class="stat-card fade-up fade-up-d3 bg-gradient-to-br from-white to-[#FFFBEB]">
                <div class="icon-box" style="background: linear-gradient(135deg, #F59E0B, #D97706);">
                    <span class="fire-icon text-xl">🔥</span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-[#94a3b8] uppercase tracking-wide">Streak</p>
                    <p class="text-2xl font-outfit font-extrabold text-[#1E2229]" id="stat-streak">—</p>
                    <span class="text-xs font-semibold text-[#64748b]">hari berturut</span>
                </div>
            </div>
        </div>

        <!-- Affirmation Widget -->
        <div class="card fade-up fade-up-d2 flex gap-4 items-center">
            <div class="text-4xl shrink-0">🌱</div>
            <div>
                <span class="text-xs font-bold text-[#396696] uppercase tracking-wide">✨ Afirmasi Harian</span>
                <p class="text-base font-semibold text-[#1E2229] mt-1 leading-relaxed" id="affirmation-widget">Setiap langkah kecil adalah investasi untuk kesehatan mentalmu.</p>
            </div>
        </div>

        <!-- Chart + Form Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Mood Chart -->
            <div class="lg:col-span-2 overflow-hidden rounded-2xl border border-[#E4EDF7] bg-white fade-up fade-up-d1">
                <div class="h-1.5 bg-gradient-to-r from-[#396696] via-[#4B81B7] to-[#2E5178]"></div>
                <div class="p-6">
                <h2 class="text-lg font-outfit font-bold text-[#1E2229] mb-1">Tren Mood 7 Hari</h2>
                <p class="text-xs text-[#94a3b8] mb-5">Pantau perjalanan emosionalmu</p>
                <div id="chart-placeholder" class="hidden text-center py-10 text-[#94a3b8] text-sm">
                    <div class="text-4xl mb-3">📊</div>
                    <p>Catat mood 2 hari berturut-turut untuk melihat tren</p>
                </div>
                <div id="chart-container" class="relative h-56">
                    <canvas id="moodChart"></canvas>
                </div>
                </div>
            </div>

            <!-- Mood Form -->
            <div class="card fade-up fade-up-d2 space-y-4" id="mood-form-card">
                <h3 class="text-lg font-outfit font-bold text-[#1E2229]">Catat Mood Hari Ini</h3>
                <div id="today-mood-badge" class="hidden px-4 py-2.5 bg-green-50 border border-green-200 text-green-700 text-xs font-bold rounded-xl flex items-center gap-2">
                    <span>✅</span> <span id="today-mood-text">Sudah dicatat hari ini</span>
                </div>
                <div class="space-y-5">
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <label class="text-sm font-bold text-[#1E2229]">Skala Mood (1-10)</label>
                            <div id="score-badge" class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#E4EDF7] transition-all duration-300">
                                <span id="score-emoji" class="text-lg">🙂</span>
                                <span class="text-xl font-outfit font-extrabold text-[#396696]" id="score-display">5</span>
                            </div>
                        </div>
                        <input type="range" id="mood-score" min="1" max="10" value="5"
                            class="w-full rounded-lg"
                            oninput="updateScore(this.value)" style="background: linear-gradient(to right, #396696 50%, #C7DCEF 50%;)">
                        <div class="flex justify-between text-xs text-[#94a3b8] mt-2 px-1">
                            <span>Sangat Lelah 😞</span>
                            <span>Sangat Baik 😄</span>
                        </div>
                        <p class="text-center text-xs font-bold mt-2 text-[#396696]" id="score-label">Biasa Saja</p>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-[#1E2229] block mb-2">Catatan (Opsional)</label>
                        <textarea id="mood-notes" rows="3" class="w-full border border-[#E4EDF7] rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:border-[#396696] focus:ring-2 focus:ring-[#E4EDF7] transition resize-none" placeholder="Apa yang kamu rasakan hari ini..."></textarea>
                    </div>
                    <button onclick="submitMood()" id="submit-btn" class="btn-primary w-full flex items-center justify-center gap-2">
                        💾 Simpan Mood
                    </button>
                </div>
            </div>
        </div>

        <!-- Quick Feature Access -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <a href="/assessment" class="card flex flex-col gap-2 items-start group no-underline">
                <div class="text-2xl">📊</div>
                <h3 class="text-xs font-bold text-[#1E2229] group-hover:text-[#396696] transition">Tes Stres</h3>
                <p class="text-[10px] text-[#64748b] leading-relaxed">Skrining kesehatan mental</p>
            </a>
            <a href="/relaxation" class="card flex flex-col gap-2 items-start group no-underline">
                <div class="text-2xl">🌬️</div>
                <h3 class="text-xs font-bold text-[#1E2229] group-hover:text-[#396696] transition">Relaksasi</h3>
                <p class="text-[10px] text-[#64748b] leading-relaxed">Teknik pernapasan terpandu</p>
            </a>
            <a href="/games" class="card flex flex-col gap-2 items-start group no-underline">
                <div class="text-2xl">🎮</div>
                <h3 class="text-xs font-bold text-[#1E2229] group-hover:text-[#396696] transition">Terapi Game</h3>
                <p class="text-[10px] text-[#64748b] leading-relaxed">CBT & DBT interaktif</p>
            </a>
            <a href="/nearby" class="card flex flex-col gap-2 items-start group no-underline">
                <div class="text-2xl">📍</div>
                <h3 class="text-xs font-bold text-[#1E2229] group-hover:text-[#396696] transition">Psikolog Dekat</h3>
                <p class="text-[10px] text-[#64748b] leading-relaxed">Cari bantuan profesional</p>
            </a>
            <a href="/education" class="card flex flex-col gap-2 items-start group no-underline">
                <div class="text-2xl">🌍</div>
                <h3 class="text-xs font-bold text-[#1E2229] group-hover:text-[#396696] transition">Info SDG 3</h3>
                <p class="text-[10px] text-[#64748b] leading-relaxed">Edukasi & bantuan</p>
            </a>
        </div>

        <!-- Assessment History -->
        <div class="card fade-up fade-up-d1">
            <div class="flex justify-between items-center mb-5">
                <div>
                    <h2 class="text-lg font-outfit font-bold text-[#1E2229]">Riwayat Tes Stres</h2>
                    <p class="text-xs text-[#94a3b8] mt-0.5">3 hasil tes terakhir yang tersimpan</p>
                </div>
                <a href="/assessment" class="text-xs font-bold text-[#396696] hover:underline">Ikuti Tes Baru →</a>
            </div>
            <div id="assessment-history" class="space-y-2">
                <p class="text-center text-[#94a3b8] text-sm py-4">Memuat...</p>
            </div>
        </div>

        <!-- Mood History -->
        <div class="card fade-up fade-up-d2">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-outfit font-bold text-[#1E2229]">Riwayat Moodmu</h2>
                <span class="text-xs text-[#94a3b8]" id="history-subtitle">Memuat data...</span>
            </div>
            <div id="mood-history" class="space-y-3"></div>
        </div>

    </main>

    <!-- FOOTER - Landing Page Style -->
    <footer class="bg-[#1E2229] text-white mt-auto">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10">
                <div class="space-y-4">
                    <div class="flex items-center gap-2 text-lg font-outfit font-extrabold">💙 SoulKeep</div>
                    <p class="text-xs sm:text-sm text-white/60 leading-relaxed">Platform kesehatan mental gratis untuk mahasiswa Indonesia. Mendukung UN SDG Goal 3.</p>
                    <p class="text-[10px] text-white/40">© 2026 SoulKeep · Dibuat dengan 💙 untuk Indonesia</p>
                </div>
                <div class="space-y-3">
                    <h4 class="text-[10px] font-bold uppercase tracking-widest text-white/40 mb-4">Navigasi</h4>
                    <a href="/dashboard" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">🏠 Dashboard</a>
                    <a href="/assessment" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">📝 Tes Stres</a>
                    <a href="/relaxation" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">🌬️ Relaksasi</a>
                    <a href="/games" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">🎮 Terapi Game</a>
                    <a href="/nearby" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">📍 Psikolog Terdekat</a>
                    <a href="/education" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">📚 Library &amp; Sumber</a>
                </div>
                <div class="space-y-3">
                    <h4 class="text-[10px] font-bold uppercase tracking-widest text-white/40 mb-4">Sumber Daya</h4>
                    <a href="https://sdgs.un.org/goals/goal3" target="_blank" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">🌍 Tentang SDG 3</a>
                    <a href="/education" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">📖 Panduan Lengkap</a>
                    <a href="/nearby" class="block text-xs sm:text-sm text-white/70 hover:text-white transition">🏥 Psikolog Terdekat</a>
                    <p class="text-xs sm:text-sm text-white/70">🔐 Data 100% Privat</p>
                </div>
                <div class="space-y-3">
                    <h4 class="text-[10px] font-bold uppercase tracking-widest text-red-400/80 mb-4">🆘 Bantuan Darurat</h4>
                    <a href="tel:119" class="flex items-center gap-2 text-xs sm:text-sm text-white/70 hover:text-white transition">
                        <span>📞</span>
                        <div class="leading-tight"><p class="text-[9px] text-white/40">SEJIWA</p><p class="font-bold">119 ext 8</p></div>
                    </a>
                    <a href="tel:08113855472" class="flex items-center gap-2 text-xs sm:text-sm text-white/70 hover:text-white transition">
                        <span>📱</span>
                        <div class="leading-tight"><p class="text-[9px] text-white/40">LISA</p><p class="font-bold">0811-385-5472</p></div>
                    </a>
                    <a href="https://www.intothelightid.org" target="_blank" class="flex items-center gap-2 text-xs sm:text-sm text-white/70 hover:text-white transition">
                        <span>🌐</span>
                        <div class="leading-tight"><p class="text-[9px] text-white/40">Into The Light</p><p class="font-bold">intothelightid.org</p></div>
                    </a>
                </div>
            </div>
            <div class="border-t border-white/10 mt-8 pt-6 text-center text-xs text-white/40">
                <p>Layanan kesehatan mental digital. Bukan pengganti konsultasi profesional. Jika dalam krisis, hubungi 119 ext 8 atau layanan darurat lokal.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Nav -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-40 border-t border-[#E4EDF7] bg-white/95 backdrop-blur-sm">
        <div class="flex justify-around h-16 items-center px-1">
            <a href="/dashboard"  class="mob-nav-item active"><span class="text-xl">🏠</span><span class="text-[8px] font-bold mt-0.5">Home</span></a>
            <a href="/assessment" class="mob-nav-item"><span class="text-xl">📝</span><span class="text-[8px] font-bold mt-0.5">Tes</span></a>
            <a href="/games"      class="mob-nav-item"><span class="text-xl">🎮</span><span class="text-[8px] font-bold mt-0.5">Game</span></a>
            <a href="/nearby"     class="mob-nav-item"><span class="text-xl">📍</span><span class="text-[8px] font-bold mt-0.5">Psikolog</span></a>
            <a href="/relaxation" class="mob-nav-item"><span class="text-xl">🌬️</span><span class="text-[8px] font-bold mt-0.5">Napas</span></a>
        </div>
    </nav>

    <script>
        const API_BASE = '/api';
        const API_KEY = 'rahasia-uas-123';
        const token = localStorage.getItem('soulkeep_token');

        if (!token) window.location.href = '/login';

        const userName = localStorage.getItem('soulkeep_name') || 'Pengguna';
        document.getElementById('user-name').textContent = userName;
        document.getElementById('welcome-name').textContent = userName;

        // Phase 4 navbar init
        const _av = document.getElementById('user-avatar');
        if (_av) _av.textContent = (localStorage.getItem('soulkeep_name') || 'P')[0].toUpperCase();
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('main-nav');
            if (nav) nav.classList.toggle('scrolled', window.scrollY > 10);
        });

        // =====================
        // AFFIRMATION
        // =====================
        const affirmations = [
            "Setiap langkah kecil yang kamu ambil adalah investasi untuk kesehatan mentalmu.",
            "Kamu berharga, dan kesejahteraanmu adalah prioritas utama.",
            "Tidak apa-apa untuk beristirahat dan memulihkan diri sepenuhnya.",
            "Kamu memiliki kekuatan untuk melewati hari ini dengan baik.",
            "Kesehatan mentalmu lebih penting daripada kesempurnaan.",
            "Percayai dirimu sendiri dan proses penyembuhan yang sedang berjalan.",
            "Setiap hari adalah kesempatan baru untuk tumbuh dan berkembang.",
            "Kamu tidak sendirian dalam perjalanan ini.",
            "Perasaanmu valid, dan kamu berhak untuk didengar.",
            "Satu hari dalam satu waktu — kamu bisa melewatinya."
        ];
        const todayAffirmation = affirmations[new Date().getDay() % affirmations.length];
        const affirmEl = document.getElementById('affirmation-text');
        const affirmWidget = document.getElementById('affirmation-widget');
        affirmWidget.textContent = todayAffirmation;

        // Fade in affirmation in hero
        setTimeout(() => {
            affirmEl.textContent = todayAffirmation;
            affirmEl.classList.remove('opacity-0');
        }, 500);

        // =====================
        // MOOD SCORE SLIDER
        // =====================
        const moodLabels = {
            1: 'Sangat Lelah', 2: 'Sangat Lelah',
            3: 'Cukup Lelah', 4: 'Agak Lelah',
            5: 'Biasa Saja', 6: 'Cukup Baik',
            7: 'Lumayan Baik', 8: 'Sangat Baik',
            9: 'Luar Biasa', 10: 'Sempurna!'
        };
        const moodEmojis = {
            1: '😞', 2: '😞', 3: '😔', 4: '😐', 5: '🙂',
            6: '🙂', 7: '😊', 8: '😄', 9: '😄', 10: '🤩'
        };

        function updateScore(val) {
            const v = parseInt(val);
            const display = document.getElementById('score-display');
            const badge = document.getElementById('score-badge');
            const emoji = document.getElementById('score-emoji');
            const label = document.getElementById('score-label');
            const slider = document.getElementById('mood-score');

            display.textContent = v;
            emoji.textContent = moodEmojis[v];
            label.textContent = moodLabels[v];

            // Dynamic slider gradient
            const pct = ((v - 1) / 9) * 100;
            slider.style.background = `linear-gradient(to right, #396696 ${pct}%, #C7DCEF ${pct}%)`;

            // Dynamic badge color
            let badgeClass = 'px-3 py-1.5 rounded-xl flex items-center gap-2 transition-all duration-300 ';
            let labelColor = '';
            if (v <= 3) {
                badgeClass += 'bg-red-50';
                display.style.color = '#dc2626';
                label.style.color = '#dc2626';
            } else if (v <= 5) {
                badgeClass += 'bg-yellow-50';
                display.style.color = '#d97706';
                label.style.color = '#d97706';
            } else if (v <= 7) {
                badgeClass += 'bg-blue-50';
                display.style.color = '#396696';
                label.style.color = '#396696';
            } else {
                badgeClass += 'bg-green-50';
                display.style.color = '#16a34a';
                label.style.color = '#16a34a';
            }
            badge.className = badgeClass;
        }

        // Initialize slider display
        updateScore(5);

        // =====================
        // TOAST NOTIFICATION
        // =====================
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            const colors = {
                success: 'bg-emerald-600 text-white',
                error: 'bg-red-600 text-white',
                info: 'bg-brand-600 text-white'
            };
            toast.className = `toast-notification fixed bottom-20 md:bottom-6 right-4 z-[100] px-5 py-3.5 rounded-2xl shadow-2xl text-sm font-bold flex items-center gap-2 ${colors[type] || colors.success}`;
            toast.innerHTML = `<span>${type === 'success' ? '✓' : type === 'error' ? '✗' : 'ℹ'}</span> ${message}`;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(10px)';
                toast.style.transition = 'all 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // =====================
        // SUBMIT MOOD
        // =====================
        async function submitMood() {
            const score = parseInt(document.getElementById('mood-score').value);
            const notes = document.getElementById('mood-notes').value;
            const btn = document.getElementById('submit-btn');

            btn.disabled = true;
            btn.innerHTML = `<svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menyimpan...`;

            try {
                const res = await fetch(`${API_BASE}/moods`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-API-KEY': API_KEY, 'Authorization': `Bearer ${token}` },
                    body: JSON.stringify({ score, notes })
                });

                if (res.status === 401) { localStorage.removeItem('soulkeep_token'); window.location.href = '/login'; return; }

                const data = await res.json();
                if (res.ok) {
                    showToast('Mood berhasil disimpan! 🎉', 'success');
                    document.getElementById('mood-score').value = 5;
                    document.getElementById('mood-notes').value = '';
                    updateScore(5);
                    await loadAllData();
                } else {
                    showToast(data.error || 'Gagal menyimpan mood', 'error');
                }
            } catch (e) {
                showToast('Gagal terhubung ke server', 'error');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '💾 Simpan Mood';
            }
        }

        // =====================
        // DELETE MOOD
        // =====================
        async function deleteMood(id) {
            if (!confirm('Yakin ingin menghapus catatan mood ini?')) return;

            try {
                const res = await fetch(`${API_BASE}/moods/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-API-KEY': API_KEY, 'Authorization': `Bearer ${token}` }
                });

                if (res.status === 401) { localStorage.removeItem('soulkeep_token'); window.location.href = '/login'; return; }

                const data = await res.json();
                if (res.ok) {
                    showToast('Catatan mood dihapus', 'info');
                    await loadAllData();
                } else {
                    showToast(data.error || 'Gagal menghapus', 'error');
                }
            } catch (e) {
                showToast('Gagal menghapus mood', 'error');
            }
        }

        // =====================
        // CHART
        // =====================
        let moodChartInstance = null;

        function renderChart(data) {
            const last7 = data.slice(0, 7).reverse();
            const container = document.getElementById('chart-container');
            const placeholder = document.getElementById('chart-placeholder');

            if (last7.length < 2) {
                container.classList.add('hidden');
                placeholder.classList.remove('hidden');
                return;
            }

            container.classList.remove('hidden');
            placeholder.classList.add('hidden');

            const labels = last7.map(m => {
                const d = new Date(m.created_at);
                return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
            });
            const scores = last7.map(m => m.score);
            const notes = last7.map(m => m.notes || '—');

            if (moodChartInstance) moodChartInstance.destroy();

            const ctx = document.getElementById('moodChart').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 200);
            gradient.addColorStop(0, 'rgba(57, 102, 150, 0.25)');
            gradient.addColorStop(1, 'rgba(57, 102, 150, 0)');

            moodChartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Mood Score',
                        data: scores,
                        borderColor: '#396696',
                        backgroundColor: gradient,
                        borderWidth: 2.5,
                        pointBackgroundColor: '#396696',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1E2229',
                            titleFont: { family: 'Outfit', weight: 'bold', size: 12 },
                            bodyFont: { family: 'Plus Jakarta Sans', size: 11 },
                            padding: 10,
                            callbacks: {
                                title: (items) => `Mood: ${items[0].raw}/10`,
                                label: (item) => `📝 ${notes[item.dataIndex].substring(0, 40)}${notes[item.dataIndex].length > 40 ? '...' : ''}`
                            }
                        }
                    },
                    scales: {
                        y: { min: 0, max: 10, ticks: { stepSize: 2, font: { size: 11 } }, grid: { color: '#E4EDF7' } },
                        x: { ticks: { font: { size: 11 } }, grid: { display: false } }
                    }
                }
            });
        }

        // =====================
        // MOOD HISTORY
        // =====================
        function moodEmoji(s) { return s >= 8 ? '😄' : s >= 6 ? '🙂' : s >= 4 ? '😐' : s >= 2 ? '😔' : '😞'; }
        function moodBg(s) { return s >= 8 ? 'bg-green-50 border-green-200' : s >= 6 ? 'bg-blue-50 border-blue-200' : s >= 4 ? 'bg-yellow-50 border-yellow-200' : 'bg-red-50 border-red-200'; }
        function moodScoreColor(s) { return s >= 8 ? 'text-green-700' : s >= 6 ? 'text-blue-700' : s >= 4 ? 'text-yellow-700' : 'text-red-700'; }

        function showSkeletons() {
            const historyDiv = document.getElementById('mood-history');
            historyDiv.innerHTML = [1,2,3].map(() => `
                <div class="flex gap-4 p-4 rounded-xl border border-gray-100 bg-gray-50">
                    <div class="skeleton w-12 h-12 rounded-full"></div>
                    <div class="flex-1 space-y-2 pt-1">
                        <div class="skeleton h-4 w-24 rounded-lg"></div>
                        <div class="skeleton h-3 w-48 rounded-lg"></div>
                        <div class="skeleton h-3 w-32 rounded-lg"></div>
                    </div>
                </div>
            `).join('');
        }

        function renderHistory(data) {
            const historyDiv = document.getElementById('mood-history');
            const subtitle = document.getElementById('history-subtitle');

            if (data.length === 0) {
                subtitle.textContent = '0 catatan';
                historyDiv.innerHTML = `
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <svg class="w-24 h-24 mb-4 text-brand-200" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="100" cy="100" r="80" fill="#E4EDF7"/>
                            <text x="100" y="120" text-anchor="middle" font-size="70">📋</text>
                        </svg>
                        <h3 class="text-lg font-outfit font-bold text-neutralDark mb-2">Belum ada catatan mood</h3>
                        <p class="text-sm text-gray-400 mb-6 max-w-xs">Mulai perjalanan kesehatan mentalmu dengan mencatat bagaimana perasaanmu hari ini.</p>
                        <button onclick="document.getElementById('mood-form-card').scrollIntoView({behavior:'smooth'})"
                            class="px-6 py-2.5 bg-brand-600 text-white font-bold rounded-xl text-sm hover:bg-brand-700 transition">
                            ✏️ Catat Mood Pertamamu
                        </button>
                    </div>
                `;
                return;
            }

            subtitle.textContent = `${data.length} catatan tersimpan`;
            historyDiv.innerHTML = data.map(m => {
                const d = new Date(m.created_at);
                const date = d.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
                const time = d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                return `
                    <div class="mood-card-wrap relative group">
                        <div class="mood-card flex gap-4 p-4 rounded-xl border ${moodBg(m.score)} transition-all duration-200 hover:shadow-sm">
                            <div class="text-4xl shrink-0">${moodEmoji(m.score)}</div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start gap-2 flex-wrap">
                                    <div class="flex items-center gap-2">
                                        <span class="text-2xl font-outfit font-extrabold ${moodScoreColor(m.score)}">${m.score}</span>
                                        <span class="text-xs font-semibold ${moodScoreColor(m.score)} opacity-60">/10</span>
                                        <span class="text-xs font-bold ${moodScoreColor(m.score)} px-2 py-0.5 bg-white/60 rounded-full">${moodLabels[m.score]}</span>
                                    </div>
                                    <span class="text-xs text-gray-400 shrink-0">${date}, ${time}</span>
                                </div>
                                ${m.notes
                                    ? `<p class="text-sm text-gray-700 mt-2 leading-relaxed truncate">${m.notes}</p>`
                                    : `<p class="text-xs text-gray-400 italic mt-2">Tanpa catatan</p>`
                                }
                            </div>
                        </div>
                        <button onclick="deleteMood(${m.id})" class="delete-btn absolute top-3 right-3 w-7 h-7 bg-white/90 border border-red-200 text-red-500 hover:bg-red-50 rounded-full flex items-center justify-center text-sm shadow-sm" title="Hapus catatan ini">
                            🗑️
                        </button>
                    </div>
                `;
            }).join('');
        }

        // =====================
        // UPDATE STATS
        // =====================
        async function updateStats() {
            try {
                const res = await fetch(`${API_BASE}/moods/stats`, {
                    headers: { 'X-API-KEY': API_KEY, 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
                });
                if (!res.ok) return;
                const data = await res.json();

                document.getElementById('stat-total').textContent = data.total ?? '—';
                document.getElementById('stat-average').textContent = data.avg_7_days ? data.avg_7_days.toFixed(1) : '—';
                document.getElementById('stat-streak').textContent = (data.streak ?? 0) + ' Hari';

                // Status kesehatan
                const avg = data.avg_7_days;
                let status = '—';
                if (avg >= 8) status = '✨ Sangat Sehat';
                else if (avg >= 6) status = '💙 Stabil';
                else if (avg >= 4) status = '😟 Cukup Lelah';
                else if (avg > 0) status = '😞 Perlu Istirahat';
                document.getElementById('stat-status').textContent = status;

                // Tren badge
                const curr = data.avg_7_days || 0;
                const prev = data.avg_7_days_prev || 0;
                const trendAvg = document.getElementById('trend-avg');
                if (prev === 0) {
                    trendAvg.textContent = '—';
                    trendAvg.className = 'text-xs font-bold px-2 py-0.5 rounded-full bg-gray-100 text-gray-500';
                } else if (curr > prev) {
                    trendAvg.textContent = `↑ +${(curr - prev).toFixed(1)}`;
                    trendAvg.className = 'text-xs font-bold px-2 py-0.5 rounded-full bg-green-100 text-green-700';
                } else if (curr < prev) {
                    trendAvg.textContent = `↓ ${(curr - prev).toFixed(1)}`;
                    trendAvg.className = 'text-xs font-bold px-2 py-0.5 rounded-full bg-red-100 text-red-700';
                } else {
                    trendAvg.textContent = '→ Stabil';
                    trendAvg.className = 'text-xs font-bold px-2 py-0.5 rounded-full bg-gray-100 text-gray-500';
                }

                // Total trend
                const totalEl = document.getElementById('trend-total');
                totalEl.textContent = data.total > 0 ? `${data.total} ✓` : '—';
                totalEl.className = 'text-xs font-bold px-2 py-0.5 rounded-full ' + (data.total > 0 ? 'bg-brand-100 text-brand-700' : 'bg-gray-100 text-gray-500');

            } catch (e) { console.warn('Stats error:', e); }
        }

        // =====================
        // FETCH HISTORY + CHART
        // =====================
        async function fetchHistory() {
            showSkeletons();
            try {
                const res = await fetch(`${API_BASE}/moods`, {
                    headers: { 'Accept': 'application/json', 'X-API-KEY': API_KEY, 'Authorization': `Bearer ${token}` }
                });
                if (res.status === 401) { localStorage.removeItem('soulkeep_token'); window.location.href = '/login'; return; }
                if (!res.ok) { document.getElementById('mood-history').innerHTML = '<p class="text-center text-red-400 py-8">❌ Gagal memuat data</p>'; return; }

                const data = await res.json();
                renderHistory(data);
                renderChart(data);
            } catch (e) {
                document.getElementById('mood-history').innerHTML = `<p class="text-center text-red-400 py-8">❌ ${e.message}</p>`;
            }
        }

        // =====================
        // CHECK TODAY MOOD
        // =====================
        async function checkTodayMood() {
            try {
                const r = await fetch(`${API_BASE}/moods`, {
                    headers: { 'X-API-KEY': API_KEY, 'Authorization': `Bearer ${token}` }
                });
                if (!r.ok) return;
                const data = await r.json();
                const today = new Date().toDateString();
                const todayEntry = data.find(m => new Date(m.created_at).toDateString() === today);
                if (todayEntry) {
                    const badge = document.getElementById('today-mood-badge');
                    const text = document.getElementById('today-mood-text');
                    text.textContent = `Sudah dicatat hari ini — Skor: ${todayEntry.score}/10 · Mau update? Silakan catat lagi 😊`;
                    badge.classList.remove('hidden');
                }
            } catch(e) {}
        }

        // =====================
        // ASSESSMENT HISTORY
        // =====================
        async function loadAssessmentHistory() {
            const container = document.getElementById('assessment-history');
            try {
                const r = await fetch(`${API_BASE}/assessments`, {
                    headers: { 'X-API-KEY': API_KEY, 'Authorization': `Bearer ${token}` }
                });
                const data = await r.json();
                if (!r.ok || !Array.isArray(data) || data.length === 0) {
                    container.innerHTML = `<p class="text-center text-gray-400 text-sm py-6">Belum ada riwayat tes. <a href="/assessment" class="text-brand-600 font-bold underline">Ikuti tes sekarang →</a></p>`;
                    return;
                }
                const levelStyle = {
                    'Ringan': 'bg-green-50 border-green-200',
                    'Sedang': 'bg-yellow-50 border-yellow-200',
                    'Berat':  'bg-red-50 border-red-200'
                };
                const levelText = {
                    'Ringan': 'text-green-700',
                    'Sedang': 'text-yellow-700',
                    'Berat':  'text-red-700'
                };
                const levelEmoji = { 'Ringan': '🟢', 'Sedang': '🟡', 'Berat': '🔴' };
                container.innerHTML = data.slice(0, 3).map(a => {
                    const d = new Date(a.created_at).toLocaleDateString('id-ID', { day:'numeric', month:'short', year:'numeric' });
                    const cls = levelStyle[a.level] || 'bg-gray-50 border-gray-200';
                    const txt = levelText[a.level] || 'text-gray-700';
                    return `
                    <div class="flex items-center justify-between p-4 rounded-xl border ${cls}">
                        <div>
                            <p class="text-sm font-bold ${txt}">Skor ${a.total_score}/40 — Stres ${a.level}</p>
                            <p class="text-xs ${txt} opacity-60 mt-0.5">${d}</p>
                        </div>
                        <span class="text-2xl">${levelEmoji[a.level] || '⚪'}</span>
                    </div>`;
                }).join('');
            } catch(e) {
                container.innerHTML = `<p class="text-center text-gray-400 text-sm py-4">Gagal memuat riwayat tes</p>`;
            }
        }

        // =====================
        // LOAD ALL DATA
        // =====================
        async function loadAllData() {
            await Promise.all([updateStats(), fetchHistory(), loadAssessmentHistory(), checkTodayMood()]);
        }

        function logout() {
            localStorage.removeItem('soulkeep_token');
            localStorage.removeItem('soulkeep_name');
            window.location.href = '/login';
        }

        // Auto-load on page ready
        document.addEventListener('DOMContentLoaded', loadAllData);
    </script>
</body>
</html>