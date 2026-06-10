# 💙 SoulKeep — Platform Kesehatan Mental Mahasiswa

> Aplikasi web kesehatan mental berbasis Laravel untuk mendukung UN SDG Goal 3.  
> Fitur: Mood Tracker · Tes Stres · Relaksasi · Terapi Game · Psikolog Terdekat · Library Edukasi

![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat&logo=php)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=flat&logo=mysql)
![License](https://img.shields.io/badge/License-MIT-green?style=flat)

---

## 📋 Daftar Isi

- [Prasyarat](#-prasyarat)
- [Instalasi dengan Laragon](#-instalasi-dengan-laragon-direkomendasikan)
- [Instalasi dengan XAMPP](#-instalasi-dengan-xampp)
- [Akses Halaman](#-akses-halaman)
- [API Endpoint](#-api-endpoint)
- [Struktur Folder](#-struktur-folder)
- [Troubleshooting](#-troubleshooting)
- [Quick Reference](#-quick-reference)

---

## 🔧 Prasyarat

| Software | Versi | Keterangan |
|---|---|---|
| PHP | 8.3+ | Sudah termasuk di Laragon & XAMPP |
| MySQL | 5.7+ / 8.x | Sudah termasuk di Laragon & XAMPP |
| Composer | 2.x | Wajib diinstall terpisah |
| Laragon **atau** XAMPP | Latest | Pilih salah satu |

> **Tidak perlu:** Node.js · npm · Redis · Git

---

## 🟢 Instalasi dengan Laragon (Direkomendasikan)

### Langkah 1 — Ekstrak & Tempatkan Folder

1. Ekstrak file `mental-health-api.zip`
2. Pindahkan folder `mental-health-api` ke dalam: `C:\laragon\www\`
3. Hasil akhir: `C:\laragon\www\mental-health-api\`

### Langkah 2 — Buat Database MySQL

1. Buka **Laragon** → klik kanan tray icon → **Database** → **HeidiSQL** (atau klik tombol DB di Laragon)
2. Klik **New** → buat koneksi baru → klik **Open**
3. Di panel kiri, klik kanan → **Create new** → **Database**
4. Nama database: `soulkeep` → klik **OK**

### Langkah 3 — Konfigurasi .env

1. Masuk ke folder `C:\laragon\www\mental-health-api\`
2. Copy file `.env.example` → rename menjadi `.env`
3. Buka `.env` dengan Notepad/VS Code, ubah bagian DB:

```env
APP_NAME=SoulKeep
APP_ENV=local
APP_DEBUG=true
APP_URL=http://mental-health-api.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=soulkeep
DB_USERNAME=root
DB_PASSWORD=

APP_API_KEY=rahasia-uas-123
```

> **Catatan:** Password MySQL di Laragon defaultnya **kosong**.

### Langkah 4 — Buka Terminal di Folder Project

- Buka Laragon → klik **Terminal** (atau tekan `Alt+T`)
- Navigasi ke folder project:

```bash
cd C:\laragon\www\mental-health-api
```

### Langkah 5 — Install Dependency

```bash
composer install
```

### Langkah 6 — Generate Keys

```bash
php artisan key:generate
php artisan jwt:secret
```

### Langkah 7 — Migrasi Database

```bash
php artisan migrate
```

### Langkah 8 — Jalankan Aplikasi

Laragon otomatis serve project di `http://mental-health-api.test` jika folder ada di `www/`.

Atau jalankan manual:

```bash
php artisan serve
```

Akses di: **http://localhost:8000**

---

## 🔵 Instalasi dengan XAMPP

### Langkah 1 — Ekstrak & Tempatkan Folder

1. Ekstrak file `mental-health-api.zip`
2. Pindahkan folder `mental-health-api` ke dalam: `C:\xampp\htdocs\`
3. Hasil akhir: `C:\xampp\htdocs\mental-health-api\`

### Langkah 2 — Jalankan XAMPP

1. Buka **XAMPP Control Panel**
2. Klik **Start** pada **Apache** dan **MySQL**
3. Pastikan keduanya berstatus **Running** (hijau)

### Langkah 3 — Buat Database MySQL

1. Buka browser → akses **http://localhost/phpmyadmin**
2. Klik **New** di panel kiri
3. Isi nama database: `soulkeep`
4. Collation: `utf8mb4_unicode_ci`
5. Klik **Create**

### Langkah 4 — Konfigurasi .env

1. Masuk ke folder `C:\xampp\htdocs\mental-health-api\`
2. Copy `.env.example` → rename menjadi `.env`
3. Buka `.env`, ubah bagian DB:

```env
APP_NAME=SoulKeep
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=soulkeep
DB_USERNAME=root
DB_PASSWORD=

APP_API_KEY=rahasia-uas-123
```

> **Catatan:** Password MySQL di XAMPP defaultnya **kosong**. Jika kamu pernah mengatur password, isi sesuai password MySQL-mu.

### Langkah 5 — Buka CMD di Folder Project

- Buka **File Explorer** → masuk ke `C:\xampp\htdocs\mental-health-api\`
- Klik di address bar → ketik `cmd` → tekan **Enter**

Atau buka CMD manual:

```cmd
cd C:\xampp\htdocs\mental-health-api
```

### Langkah 6 — Pastikan PHP XAMPP Dikenali CMD

Jika perintah `php` tidak dikenali, tambahkan PHP XAMPP ke PATH Windows:

1. Buka **System Properties** → **Environment Variables**
2. Di **System Variables** → pilih **Path** → klik **Edit**
3. Klik **New** → tambahkan: `C:\xampp\php`
4. Klik **OK** → tutup CMD → buka CMD baru
5. Verifikasi: `php -v`

### Langkah 7 — Install Dependency

```bash
composer install
```

### Langkah 8 — Generate Keys

```bash
php artisan key:generate
php artisan jwt:secret
```

### Langkah 9 — Migrasi Database

```bash
php artisan migrate
```

### Langkah 10 — Jalankan Aplikasi

```bash
php artisan serve
```

Akses di: **http://localhost:8000**

---

## 🌐 Akses Halaman

| Halaman | URL | Keterangan |
|---|---|---|
| Landing Page | `/` | Halaman utama publik |
| Register | `/register` | Daftar akun baru |
| Login | `/login` | Masuk ke aplikasi |
| Dashboard | `/dashboard` | Mood tracker utama |
| Tes Stres | `/assessment` | Skrining kesehatan mental |
| Relaksasi | `/relaxation` | Latihan pernapasan |
| Terapi Game | `/games` | 3 game terapeutik |
| Psikolog Terdekat | `/nearby` | Peta layanan terdekat |
| Library | `/education` | Edukasi & sumber daya |

> Base URL: `http://localhost:8000` (artisan serve) atau `http://mental-health-api.test` (Laragon auto)

---

## 🔌 API Endpoint

Semua endpoint memerlukan header: `X-API-KEY: rahasia-uas-123`

| Method | Endpoint | Auth Tambahan | Keterangan |
|---|---|---|---|
| POST | `/api/register` | — | Daftar akun |
| POST | `/api/login` | — | Login → dapat JWT token |
| GET | `/api/moods` | Bearer JWT | Ambil semua mood |
| POST | `/api/moods` | Bearer JWT | Simpan mood |
| GET | `/api/moods/stats` | Bearer JWT | Statistik mood |
| DELETE | `/api/moods/{id}` | Bearer JWT | Hapus mood |
| GET | `/api/assessments` | Bearer JWT | Riwayat asesmen |
| POST | `/api/assessments` | Bearer JWT | Simpan asesmen |
| GET | `/api/admin/users` | Basic Auth | Daftar user (admin) |

Contoh penggunaan:

```bash
# Register
curl -X POST http://localhost:8000/api/register \
  -H "X-API-KEY: rahasia-uas-123" \
  -H "Content-Type: application/json" \
  -d '{"name":"Budi","email":"budi@test.com","password":"password123"}'

# Login
curl -X POST http://localhost:8000/api/login \
  -H "X-API-KEY: rahasia-uas-123" \
  -H "Content-Type: application/json" \
  -d '{"email":"budi@test.com","password":"password123"}'

# Get Moods (ganti YOUR_TOKEN dengan token dari response login)
curl -X GET http://localhost:8000/api/moods \
  -H "X-API-KEY: rahasia-uas-123" \
  -H "Authorization: Bearer YOUR_TOKEN"
```

---

## 📁 Struktur Folder

```
mental-health-api/
├── app/Http/
│   ├── Controllers/
│   │   ├── AuthController.php        # Register & Login
│   │   ├── MoodController.php        # CRUD Mood + Stats
│   │   └── AssessmentController.php  # Tes Stres
│   └── Middleware/
│       └── ApiKeyMiddleware.php      # Validasi X-API-KEY
├── database/
│   └── migrations/                   # Skema tabel database
├── resources/views/                  # Semua halaman Blade
│   ├── welcome.blade.php
│   ├── dashboard.blade.php
│   ├── assessment.blade.php
│   ├── relaxation.blade.php
│   ├── education.blade.php
│   ├── games.blade.php
│   ├── games_jurnal.blade.php
│   ├── games_wordle.blade.php
│   ├── games_puzzle.blade.php
│   ├── nearby.blade.php
│   └── auth/ (login, register)
├── routes/
│   ├── web.php                       # Route halaman web
│   └── api.php                       # Route API
└── .env                              # Konfigurasi (buat dari .env.example)
```

---

## ❗ Troubleshooting

| Masalah | Solusi |
|---|---|
| `php: command not found` | Tambahkan PHP ke PATH (lihat Langkah 6 XAMPP) |
| `composer: command not found` | Download & install dari https://getcomposer.org |
| `Access denied for user 'root'` | Cek password MySQL di `.env` — coba kosongkan `DB_PASSWORD=` |
| `Unknown database 'soulkeep'` | Buat database `soulkeep` di HeidiSQL/phpMyAdmin terlebih dahulu |
| `Class "JWTAuth" not found` | Jalankan `php artisan jwt:secret` |
| Halaman error 500 | Jalankan `php artisan key:generate` |
| Port 8000 sudah dipakai | Jalankan `php artisan serve --port=8080` |
| `composer install` lambat | Gunakan koneksi WiFi, bukan hotspot |

---

## ⚡ Quick Reference

```bash
# ==== LARAGON — semua command sekaligus ====
composer install
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan serve

# ==== XAMPP — semua command sekaligus ====
# (pastikan PHP sudah ada di PATH, Apache & MySQL sudah Running)
composer install
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan serve

# ==== Jalankan ulang setelah restart komputer ====
php artisan serve
```
