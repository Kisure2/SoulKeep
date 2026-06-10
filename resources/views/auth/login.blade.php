<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Masuk ke SoulKeep — Lacak kesehatan mental harianmu. Mendukung UN SDG 3.">
    <meta name="theme-color" content="#396696">
    <title>Masuk — SoulKeep</title>
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

            <div class="space-y-8 z-10">
                <svg viewBox="0 0 200 160" class="w-full max-w-xs mx-auto" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="100" cy="80" r="70" fill="rgba(255,255,255,0.08)"/>
                    <circle cx="100" cy="80" r="50" fill="rgba(255,255,255,0.08)"/>
                    <path d="M100 105 C100 105 65 85 65 65 C65 52 75 44 85 47 C92 49 100 58 100 58 C100 58 108 49 115 47 C125 44 135 52 135 65 C135 85 100 105 100 105Z" fill="white" opacity="0.9"/>
                    <circle cx="45" cy="50" r="8" fill="rgba(255,255,255,0.3)"/>
                    <circle cx="155" cy="110" r="6" fill="rgba(255,255,255,0.2)"/>
                    <circle cx="160" cy="40" r="10" fill="rgba(255,255,255,0.15)"/>
                    <circle cx="40" cy="120" r="12" fill="rgba(255,255,255,0.1)"/>
                </svg>
                <div class="space-y-3">
                    <h2 class="text-2xl font-outfit font-extrabold text-white">Selamat Datang Kembali</h2>
                    <p class="text-brand-100/80 text-sm leading-relaxed">Kesehatan mentalmu adalah prioritas. Setiap hari adalah kesempatan baru untuk tumbuh.</p>
                </div>
                <div class="p-4 bg-white/10 border border-white/20 rounded-2xl">
                    <p class="text-xs text-brand-100 italic leading-relaxed" id="quote-text">
                        "Merawat diri sendiri bukan sebuah kemewahan — itu kebutuhan yang harus diprioritaskan."
                    </p>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-xs text-brand-100/80"><span class="text-white">✓</span> Grafik tren mood 7 hari terakhir</div>
                    <div class="flex items-center gap-2 text-xs text-brand-100/80"><span class="text-white">✓</span> Tes stres mandiri tervalidasi</div>
                    <div class="flex items-center gap-2 text-xs text-brand-100/80"><span class="text-white">✓</span> Chat langsung dengan terapis</div>
                </div>
            </div>

            <div class="z-10">
                <p class="text-[10px] text-brand-200/50">💙 SoulKeep © 2026 — Mendukung UN SDG 3</p>
            </div>
        </div>

        {{-- Right Panel: Form --}}
        <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 bg-gradient-to-br from-brand-50 to-white min-h-screen">
            <div class="lg:hidden mb-8 flex items-center gap-2 text-xl font-outfit font-extrabold text-brand-700">
                💙 SoulKeep
            </div>

            <div class="form-panel w-full max-w-md">
                <a href="/" class="inline-flex items-center gap-1 text-xs font-semibold text-neutralDark/50 hover:text-brand-600 transition mb-6">
                    ← Kembali ke Beranda
                </a>

                <div class="bg-white rounded-3xl border border-brand-100 p-8 md:p-10 shadow-xl shadow-brand-100/40">
                    <div class="text-center space-y-1 mb-8">
                        <span class="text-4xl">👋</span>
                        <h1 class="text-2xl font-outfit font-bold text-neutralDark">Masuk ke Akun</h1>
                        <p class="text-xs text-neutralDark/50">Sambut kembali! Check-in dan lihat bagaimana kondisimu.</p>
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

                    {{-- Server-side Form --}}
                    <form method="POST" action="/login" class="space-y-5" id="login-form">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Alamat Email</label>
                            <input type="email" name="email" id="login-email" required autocomplete="email" value="{{ old('email') }}"
                                class="input-field w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition"
                                placeholder="nama@email.com">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Kata Sandi</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" required autocomplete="current-password"
                                    class="input-field w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition pr-12"
                                    placeholder="••••••••">
                                <button type="button" onclick="togglePw()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition p-1">
                                    <span id="eye-icon" class="text-lg">👁️</span>
                                </button>
                            </div>
                        </div>

                        <button type="submit" id="login-btn"
                            class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3.5 rounded-xl shadow-md transition-all flex items-center justify-center gap-2 mt-2">
                            💙 Masuk ke Akun
                        </button>
                    </form>

                    <div class="mt-7 pt-6 border-t border-brand-50 text-center">
                        <p class="text-xs text-neutralDark/50">
                            Belum memiliki akun?
                            <a href="/register" class="text-brand-600 font-bold hover:underline ml-1">Daftar Gratis</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePw() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') { input.type = 'text'; icon.textContent = '🔒'; }
            else { input.type = 'password'; icon.textContent = '👁️'; }
        }

        // ── Intercept form submit: fetch JWT → store localStorage → submit form ──
        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const email    = document.getElementById('login-email').value;
            const password = document.getElementById('password').value;
            const btn      = document.getElementById('login-btn');

            btn.disabled = true;
            btn.innerHTML = '⏳ Memproses...';

            try {
                const res = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-API-KEY': 'rahasia-uas-123',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ email, password }),
                });

                if (res.ok) {
                    const data = await res.json();
                    // Store JWT and user info for page guards and API calls
                    localStorage.setItem('soulkeep_token', data.token);
                    localStorage.setItem('soulkeep_name',  data.name  ?? '');
                    localStorage.setItem('soulkeep_role',  data.role  ?? 'user');
                    localStorage.setItem('soulkeep_id',    data.id    ?? '');
                }
            } catch (err) {
                // API fetch failed (network error etc.) — proceed anyway,
                // server-side session will still handle auth
                console.warn('JWT fetch failed, proceeding with session auth:', err);
            }

            // Always submit the server-side form after attempting JWT fetch
            btn.disabled = false;
            btn.innerHTML = '💙 Masuk ke Akun';
            this.submit();
        });

        // Rotating quotes
        const quotes = [
            '"Merawat diri sendiri bukan sebuah kemewahan — itu kebutuhan yang harus diprioritaskan."',
            '"Kamu tidak harus merasa baik-baik saja setiap hari. Itu manusiawi."',
            '"Langkah kecil setiap hari lebih berarti dari satu langkah besar sesekali."',
            '"Mengenali perasaanmu adalah tanda kekuatan, bukan kelemahan."'
        ];
        let qi = 0;
        const qEl = document.getElementById('quote-text');
        if (qEl) setInterval(() => {
            qi = (qi + 1) % quotes.length;
            qEl.style.opacity = '0';
            qEl.style.transition = 'opacity 0.4s';
            setTimeout(() => { qEl.textContent = quotes[qi]; qEl.style.opacity = '1'; }, 400);
        }, 5000);
    </script>
</body>
</html>
