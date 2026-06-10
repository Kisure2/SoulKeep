<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Daftar akun SoulKeep — Platform kesehatan mental gratis untuk mahasiswa Indonesia.">
    <meta name="theme-color" content="#396696">
    <title>Daftar — SoulKeep</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>💙</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { outfit: ['Outfit', 'sans-serif'], jakarta: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        brand: { 50:'#F4F7FB', 100:'#E4EDF7', 200:'#C7DCEF', 300:'#9CBEDF', 400:'#6E9DCC', 500:'#4B81B7', 600:'#396696', 700:'#2E5178', 850:'#203853', 900:'#17293D' },
                        neutralDark: '#1E2229',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @keyframes fadeIn { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }
        .form-panel { animation: fadeIn 0.4s ease-out; }
        .input-field { transition: all 0.2s ease; }
        .input-field:focus { box-shadow: 0 0 0 3px rgba(57,102,150,0.15); }
        .role-card { transition: all 0.2s ease; cursor: pointer; border: 2px solid #E4EDF7; }
        .role-card:hover { border-color: #6E9DCC; background: #F4F7FB; }
        .role-card.selected { border-color: #396696; background: #E4EDF7; }
        @keyframes slideDown { from{opacity:0;max-height:0;transform:translateY(-6px)} to{opacity:1;max-height:80px;transform:translateY(0)} }
        .notice-box { animation: slideDown 0.3s ease-out; overflow: hidden; }
    </style>
</head>
<body class="min-h-screen text-neutralDark selection:bg-brand-200 selection:text-brand-900">

    <div class="min-h-screen flex">
        {{-- Left Panel: Brand --}}
        <div class="hidden lg:flex lg:w-2/5 bg-gradient-to-br from-brand-700 via-brand-600 to-brand-500 flex-col justify-between p-10 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>

            <a href="/" class="flex items-center gap-2 text-xl font-outfit font-extrabold text-white z-10">
                💙 SoulKeep <span class="text-xs bg-white/20 text-white px-2 py-0.5 rounded font-bold">SDG 3</span>
            </a>

            <div class="space-y-6 z-10">
                <div class="space-y-3">
                    <h2 class="text-3xl font-outfit font-extrabold text-white leading-tight">Bergabung & Mulai Perjalananmu</h2>
                    <p class="text-brand-100/80 text-sm leading-relaxed">Platform gratis untuk mahasiswa Indonesia. Jaga kesehatan mental dengan cara yang menyenangkan dan berbasis sains.</p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-4 text-center">
                        <p class="text-2xl font-outfit font-black text-white">100%</p>
                        <p class="text-xs text-brand-100/70">Gratis Selamanya</p>
                    </div>
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-4 text-center">
                        <p class="text-2xl font-outfit font-black text-white">🔒</p>
                        <p class="text-xs text-brand-100/70">Privasi Terjamin</p>
                    </div>
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-4 text-center">
                        <p class="text-2xl font-outfit font-black text-white">💬</p>
                        <p class="text-xs text-brand-100/70">Chat Terapis</p>
                    </div>
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-4 text-center">
                        <p class="text-2xl font-outfit font-black text-white">🧠</p>
                        <p class="text-xs text-brand-100/70">Berbasis CBT/DBT</p>
                    </div>
                </div>
            </div>

            <div class="z-10">
                <p class="text-[10px] text-brand-200/50">💙 SoulKeep © 2026 — Mendukung UN SDG 3</p>
            </div>
        </div>

        {{-- Right Panel: Form --}}
        <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 bg-gradient-to-br from-brand-50 to-white min-h-screen overflow-y-auto">
            <div class="lg:hidden mb-8 flex items-center gap-2 text-xl font-outfit font-extrabold text-brand-700">
                💙 SoulKeep
            </div>

            <div class="form-panel w-full max-w-md">
                <a href="/" class="inline-flex items-center gap-1 text-xs font-semibold text-neutralDark/50 hover:text-brand-600 transition mb-6">
                    ← Kembali ke Beranda
                </a>

                <div class="bg-white rounded-3xl border border-brand-100 p-8 md:p-10 shadow-xl shadow-brand-100/40">
                    <div class="text-center space-y-1 mb-8">
                        <span class="text-4xl">🌱</span>
                        <h1 class="text-2xl font-outfit font-bold text-neutralDark">Buat Akun Baru</h1>
                        <p class="text-xs text-neutralDark/50">Gratis selamanya. Mulai perjalanan kesehatan mentalmu.</p>
                    </div>

                    {{-- Flash Messages --}}
                    @if(session('error'))
                        <div class="mb-5 p-4 rounded-xl text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-100">
                            ❌ {{ session('error') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="mb-5 p-4 rounded-xl text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-100">
                            @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
                        </div>
                    @endif

                    <form method="POST" action="/register" class="space-y-5">
                        @csrf

                        {{-- Role Selector --}}
                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-3">Daftar Sebagai</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="role-card rounded-2xl p-4 text-center selected" id="role-user-card" onclick="selectRole('user')">
                                    <input type="radio" name="role" value="user" class="hidden" checked id="role-user">
                                    <span class="text-2xl block mb-1">🧑‍💻</span>
                                    <span class="text-sm font-bold text-neutralDark">Pengguna</span>
                                    <p class="text-[10px] text-gray-400 mt-0.5">Cari bantuan & konsultasi</p>
                                </label>
                                <label class="role-card rounded-2xl p-4 text-center" id="role-therapist-card" onclick="selectRole('therapist')">
                                    <input type="radio" name="role" value="therapist" class="hidden" id="role-therapist">
                                    <span class="text-2xl block mb-1">👨‍⚕️</span>
                                    <span class="text-sm font-bold text-neutralDark">Terapis</span>
                                    <p class="text-[10px] text-gray-400 mt-0.5">Bantu pengguna SoulKeep</p>
                                </label>
                            </div>
                            {{-- Therapist approval notice --}}
                            <div id="therapist-notice" class="notice-box hidden mt-3">
                                <div class="flex items-start gap-2 p-3 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-800">
                                    <span class="text-base">⏳</span>
                                    <p><strong>Catatan:</strong> Akun terapis memerlukan verifikasi admin sebelum dapat digunakan. Kami akan memproses dalam 1–2 hari kerja.</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" name="name" required autocomplete="name" value="{{ old('name') }}"
                                class="input-field w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition"
                                placeholder="Nama kamu">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Alamat Email</label>
                            <input type="email" name="email" required autocomplete="email" value="{{ old('email') }}"
                                class="input-field w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition"
                                placeholder="nama@email.com">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Kata Sandi</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" required autocomplete="new-password"
                                    class="input-field w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition pr-12"
                                    placeholder="Min. 6 karakter">
                                <button type="button" onclick="togglePw('password','eye1')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 p-1">
                                    <span id="eye1" class="text-lg">👁️</span>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Konfirmasi Kata Sandi</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password2" required
                                    class="input-field w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition pr-12"
                                    placeholder="Ulangi kata sandi">
                                <button type="button" onclick="togglePw('password2','eye2')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 p-1">
                                    <span id="eye2" class="text-lg">👁️</span>
                                </button>
                            </div>
                        </div>

                        <button type="submit" id="reg-btn"
                            class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3.5 rounded-xl shadow-md transition-all flex items-center justify-center gap-2 mt-2">
                            🌱 Buat Akun Gratis
                        </button>
                    </form>

                    <div class="mt-7 pt-6 border-t border-brand-50 text-center">
                        <p class="text-xs text-neutralDark/50">
                            Sudah punya akun?
                            <a href="/login" class="text-brand-600 font-bold hover:underline ml-1">Masuk</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('role-' + role).checked = true;
            document.getElementById('role-user-card').classList.remove('selected');
            document.getElementById('role-therapist-card').classList.remove('selected');
            document.getElementById('role-' + role + '-card').classList.add('selected');
            document.getElementById('therapist-notice').classList.toggle('hidden', role !== 'therapist');
        }
        function togglePw(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') { input.type = 'text'; icon.textContent = '🔒'; }
            else { input.type = 'password'; icon.textContent = '👁️'; }
        }
        // Restore selected role on validation error
        const oldRole = '{{ old("role", "user") }}';
        if (oldRole) selectRole(oldRole);

        // ── After successful server-side register redirect, fetch JWT ──
        // If arriving at /dashboard after register, token may not exist yet.
        // We intercept the form submit to call API login after form success.
        // Since server redirects us away, we store credentials temporarily.
        const regForm = document.querySelector('form[action="/register"]');
        if (regForm) {
            regForm.addEventListener('submit', function() {
                // Store email/password temporarily so we can auto-login via API
                // after the page redirects to /dashboard
                const emailVal = regForm.querySelector('[name=email]');
                const passVal  = regForm.querySelector('[name=password]');
                if (emailVal && passVal) {
                    sessionStorage.setItem('_reg_email', emailVal.value);
                    sessionStorage.setItem('_reg_pass',  passVal.value);
                }
            });
        }
    </script>

    {{-- Auto-fetch JWT after server-side register redirect --}}
    <script>
        (async () => {
            const e = sessionStorage.getItem('_reg_email');
            const p = sessionStorage.getItem('_reg_pass');
            if (!e || !p) return;
            sessionStorage.removeItem('_reg_email');
            sessionStorage.removeItem('_reg_pass');
            try {
                const r = await fetch('/api/login', {
                    method: 'POST',
                    headers: { 'Content-Type':'application/json', 'X-API-KEY':'rahasia-uas-123', 'Accept':'application/json' },
                    body: JSON.stringify({ email: e, password: p })
                });
                if (r.ok) {
                    const d = await r.json();
                    localStorage.setItem('soulkeep_token', d.token);
                    localStorage.setItem('soulkeep_name',  d.name  ?? '');
                    localStorage.setItem('soulkeep_role',  d.role  ?? 'user');
                    localStorage.setItem('soulkeep_id',    d.id    ?? '');
                }
            } catch(err) { console.warn('JWT auto-fetch after register failed:', err); }
        })();
    </script>
</body>
</html>
