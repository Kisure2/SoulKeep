<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Daftar akun SoulKeep — Mulai lacak kesehatan mentalmu. Mendukung UN SDG 3.">
    <meta name="theme-color" content="#396696">
    <title>Daftar Akun — SoulKeep</title>
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
        @keyframes toastIn { from{opacity:0;transform:translateY(20px) scale(0.95)} to{opacity:1;transform:translateY(0) scale(1)} }
        .form-panel { animation: fadeIn 0.4s ease-out; }
        .toast-notification { animation: toastIn 0.35s cubic-bezier(0.34,1.56,0.64,1) forwards; }
        .input-field { transition: all 0.2s ease; }
        .input-field:focus { box-shadow: 0 0 0 3px rgba(57,102,150,0.15); }
    </style>
</head>
<body class="min-h-screen text-neutralDark selection:bg-brand-200 selection:text-brand-900">

    <!-- Guard redirect if logged in -->
    <script>
        if (localStorage.getItem('soulkeep_token')) window.location.href = '/dashboard';
    </script>

    <div class="min-h-screen flex">
        <!-- Left Panel: Brand -->
        <div class="hidden lg:flex lg:w-2/5 bg-gradient-to-br from-brand-900 via-brand-700 to-brand-500 flex-col justify-between p-10 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>

            <a href="/" class="flex items-center gap-2 text-xl font-outfit font-extrabold text-white z-10">
                💙 SoulKeep <span class="text-xs bg-white/20 text-white px-2 py-0.5 rounded font-bold">SDG 3</span>
            </a>

            <div class="space-y-8 z-10">
                <!-- Illustration -->
                <svg viewBox="0 0 200 160" class="w-full max-w-xs mx-auto" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="100" cy="80" r="70" fill="rgba(255,255,255,0.06)"/>
                    <circle cx="100" cy="80" r="45" fill="rgba(255,255,255,0.06)"/>
                    <!-- Plant/Growth Icon -->
                    <path d="M100 130 L100 70" stroke="white" stroke-width="3" stroke-linecap="round" opacity="0.9"/>
                    <path d="M100 90 C85 80 75 60 80 45 C90 55 95 75 100 90Z" fill="white" opacity="0.8"/>
                    <path d="M100 100 C115 90 125 70 120 55 C110 65 105 80 100 100Z" fill="white" opacity="0.7"/>
                    <circle cx="50" cy="55" r="7" fill="rgba(255,255,255,0.25)"/>
                    <circle cx="150" cy="105" r="5" fill="rgba(255,255,255,0.2)"/>
                    <circle cx="155" cy="45" r="9" fill="rgba(255,255,255,0.15)"/>
                </svg>

                <div class="space-y-3">
                    <h2 class="text-2xl font-outfit font-extrabold text-white">Mulai Perjalananmu</h2>
                    <p class="text-brand-100/80 text-sm leading-relaxed">Bergabung dengan SoulKeep dan mulai memantau kesehatan mentalmu hari ini.</p>
                </div>

                <div class="p-4 bg-white/10 border border-white/20 rounded-2xl">
                    <p class="text-xs text-brand-100 italic leading-relaxed">
                        "Setiap hari adalah peluang baru untuk memilih kesehatan mentalmu. Mulai sekarang."
                    </p>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-xs text-brand-100/80"><span class="text-white">✓</span> Daftar dalam 30 detik</div>
                    <div class="flex items-center gap-2 text-xs text-brand-100/80"><span class="text-white">✓</span> Tidak perlu kartu kredit</div>
                    <div class="flex items-center gap-2 text-xs text-brand-100/80"><span class="text-white">✓</span> Data 100% privat & aman</div>
                </div>
            </div>

            <div class="z-10">
                <p class="text-[10px] text-brand-200/50">💙 SoulKeep © 2026 — Mendukung UN SDG 3</p>
            </div>
        </div>

        <!-- Right Panel: Form -->
        <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 bg-gradient-to-br from-brand-50 to-white min-h-screen">
            <!-- Mobile Logo -->
            <div class="lg:hidden mb-6 flex items-center gap-2 text-xl font-outfit font-extrabold text-brand-700">
                💙 SoulKeep
            </div>

            <div class="form-panel w-full max-w-md">
                <a href="/" class="inline-flex items-center gap-1 text-xs font-semibold text-neutralDark/50 hover:text-brand-600 transition mb-6">
                    ← Kembali ke Beranda
                </a>

                <div class="bg-white rounded-3xl border border-brand-100 p-8 md:p-10 shadow-xl shadow-brand-100/40">
                    <!-- Header -->
                    <div class="text-center space-y-1 mb-7">
                        <span class="text-4xl">🌱</span>
                        <h1 class="text-2xl font-outfit font-bold text-neutralDark">Buat Akun Baru</h1>
                        <p class="text-xs text-neutralDark/50">Mari bergabung dan mulai mencatat perjalanan mentalmu.</p>
                    </div>

                    <!-- Alert Message -->
                    <div id="msg" class="mb-5 hidden"></div>

                    <!-- Form -->
                    <form onsubmit="event.preventDefault(); register();" class="space-y-4">
                        <!-- Name -->
                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" id="name" required autocomplete="name"
                                class="input-field w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition"
                                placeholder="Nama Lengkap Anda">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Alamat Email</label>
                            <div class="relative">
                                <input type="email" id="email" required autocomplete="email"
                                    class="input-field w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition pr-10"
                                    placeholder="nama@email.com"
                                    onblur="validateEmail(this)">
                                <span id="email-status" class="absolute right-3 top-1/2 -translate-y-1/2 text-sm hidden"></span>
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Kata Sandi</label>
                            <div class="relative">
                                <input type="password" id="password" required autocomplete="new-password"
                                    class="input-field w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition pr-12"
                                    placeholder="Minimal 8 karakter"
                                    oninput="checkPasswordStrength(this.value)">
                                <button type="button" onclick="togglePassword('password', 'eye-pass')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition p-1">
                                    <span id="eye-pass" class="text-lg">👁️</span>
                                </button>
                            </div>
                            <!-- Password Strength -->
                            <div class="mt-2 space-y-1">
                                <div class="flex gap-1.5">
                                    <div class="strength-bar flex-1 h-1.5 rounded-full bg-gray-100" id="bar1"></div>
                                    <div class="strength-bar flex-1 h-1.5 rounded-full bg-gray-100" id="bar2"></div>
                                    <div class="strength-bar flex-1 h-1.5 rounded-full bg-gray-100" id="bar3"></div>
                                    <div class="strength-bar flex-1 h-1.5 rounded-full bg-gray-100" id="bar4"></div>
                                </div>
                                <p class="text-[10px] font-semibold" id="strength-label" style="color:#9ca3af">Masukkan kata sandi</p>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-xs font-bold text-neutralDark uppercase tracking-wider mb-2">Konfirmasi Kata Sandi</label>
                            <div class="relative">
                                <input type="password" id="confirm-password" required autocomplete="new-password"
                                    class="input-field w-full bg-brand-50/50 border border-brand-100 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white transition pr-12"
                                    placeholder="Ulangi kata sandi"
                                    oninput="checkPasswordMatch()">
                                <button type="button" onclick="togglePassword('confirm-password', 'eye-confirm')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition p-1">
                                    <span id="eye-confirm" class="text-lg">👁️</span>
                                </button>
                            </div>
                            <p class="text-[10px] font-semibold mt-1 hidden" id="match-label"></p>
                        </div>

                        <!-- Submit -->
                        <button type="submit" id="btn-submit"
                            class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3.5 rounded-xl shadow-md transition-all flex items-center justify-center gap-2 mt-1">
                            🌱 Daftar Sekarang
                        </button>
                    </form>

                    <!-- Redirect -->
                    <div class="mt-7 pt-5 border-t border-brand-50 text-center">
                        <p class="text-xs text-neutralDark/50">
                            Sudah memiliki akun?
                            <a href="/login" class="text-brand-600 font-bold hover:underline ml-1">Masuk di sini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const API_BASE = '/api';
        const API_KEY = 'rahasia-uas-123';

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') { input.type = 'text'; icon.textContent = '🔒'; }
            else { input.type = 'password'; icon.textContent = '👁️'; }
        }

        function validateEmail(input) {
            const statusEl = document.getElementById('email-status');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            statusEl.classList.remove('hidden');
            if (emailRegex.test(input.value)) {
                statusEl.textContent = '✓'; statusEl.style.color = '#16a34a';
                input.classList.remove('border-red-300'); input.classList.add('border-green-300');
            } else if (input.value) {
                statusEl.textContent = '✗'; statusEl.style.color = '#dc2626';
                input.classList.add('border-red-300'); input.classList.remove('border-green-300');
            }
        }

        function checkPasswordStrength(pw) {
            const bars = ['bar1','bar2','bar3','bar4'];
            const label = document.getElementById('strength-label');
            let score = 0;
            if (pw.length >= 8) score++;
            if (/[A-Z]/.test(pw)) score++;
            if (/[0-9]/.test(pw)) score++;
            if (/[^A-Za-z0-9]/.test(pw)) score++;

            const configs = [
                { color: 'bg-gray-200', text: 'Masukkan kata sandi', textColor: '#9ca3af' },
                { color: 'bg-red-400', text: 'Lemah', textColor: '#ef4444' },
                { color: 'bg-yellow-400', text: 'Cukup', textColor: '#f59e0b' },
                { color: 'bg-blue-400', text: 'Kuat', textColor: '#3b82f6' },
                { color: 'bg-green-500', text: 'Sangat Kuat 🛡️', textColor: '#16a34a' },
            ];

            const cfg = configs[score];
            bars.forEach((id, i) => {
                const el = document.getElementById(id);
                el.className = 'strength-bar flex-1 h-1.5 rounded-full transition-all duration-300 ' + (i < score ? cfg.color : 'bg-gray-100');
            });
            label.textContent = cfg.text;
            label.style.color = cfg.textColor;
        }

        function checkPasswordMatch() {
            const pw = document.getElementById('password').value;
            const cpw = document.getElementById('confirm-password').value;
            const label = document.getElementById('match-label');
            if (!cpw) { label.classList.add('hidden'); return; }
            label.classList.remove('hidden');
            if (pw === cpw) { label.textContent = '✓ Kata sandi cocok'; label.style.color = '#16a34a'; }
            else { label.textContent = '✗ Kata sandi tidak cocok'; label.style.color = '#ef4444'; }
        }

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            const colors = { success: 'bg-emerald-600 text-white', error: 'bg-red-600 text-white' };
            toast.className = `toast-notification fixed bottom-6 right-4 z-[100] px-5 py-3.5 rounded-2xl shadow-2xl text-sm font-bold flex items-center gap-2 ${colors[type]}`;
            toast.innerHTML = `<span>${type === 'success' ? '✓' : '✗'}</span> ${message}`;
            document.body.appendChild(toast);
            setTimeout(() => { toast.style.opacity = '0'; toast.style.transition = 'opacity 0.3s'; setTimeout(() => toast.remove(), 300); }, 3000);
        }

        function showMessage(message, type) {
            const msgDiv = document.getElementById('msg');
            msgDiv.className = 'p-4 rounded-xl text-xs sm:text-sm font-semibold ' +
                (type === 'success' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-rose-50 text-rose-700 border border-rose-100');
            msgDiv.textContent = message;
            msgDiv.classList.remove('hidden');
        }

        async function register() {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPw = document.getElementById('confirm-password').value;
            const btn = document.getElementById('btn-submit');

            if (!name || !email || !password || !confirmPw) { showMessage('⚠️ Semua kolom harus diisi!', 'error'); return; }
            if (password !== confirmPw) { showMessage('⚠️ Kata sandi tidak cocok!', 'error'); return; }
            if (password.length < 8) { showMessage('⚠️ Kata sandi minimal 8 karakter!', 'error'); return; }

            btn.disabled = true;
            btn.innerHTML = `<svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mendaftarkan...`;

            try {
                const response = await fetch(`${API_BASE}/register`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-API-KEY': API_KEY },
                    body: JSON.stringify({ name, email, password })
                });
                const data = await response.json();

                if (response.ok) {
                    showToast('Registrasi berhasil! Mengarahkan ke login...', 'success');
                    setTimeout(() => { window.location.href = '/login'; }, 1500);
                } else {
                    showMessage('❌ ' + (data.error || 'Pendaftaran gagal. Pastikan email belum terdaftar.'), 'error');
                    btn.disabled = false;
                    btn.innerHTML = '🌱 Daftar Sekarang';
                }
            } catch (error) {
                showMessage('💥 Gagal terhubung ke server: ' + error.message, 'error');
                btn.disabled = false;
                btn.innerHTML = '🌱 Daftar Sekarang';
            }
        }
    </script>
</body>
</html>
