# ðŸ’™ mental_health_api â€” Platform Kesehatan Mental Mahasiswa

> Laravel 13 Â· PHP 8.4 Â· MySQL Â· Tailwind CDN Â· JWT Auth  
> Mendukung **UN SDG 3** â€” Good Health and Well-Being

---

## ðŸ“‹ Daftar Isi

1. [Persyaratan Sistem](#-persyaratan-sistem)
2. [Instalasi dengan Laragon](#-instalasi-dengan-laragon-direkomendasikan)
3. [Instalasi dengan XAMPP](#-instalasi-dengan-xampp)
4. [Konfigurasi .env](#-konfigurasi-env)
5. [Migrasi Database](#-migrasi-database)
6. [Buat Akun Admin](#-buat-akun-admin)
7. [Akses Halaman](#-akses-halaman)
8. [Peran & Hak Akses](#-peran--hak-akses)
9. [API Endpoint](#-api-endpoint)
10. [Struktur Folder](#-struktur-folder)
11. [Troubleshooting](#-troubleshooting)
12. [Quick Reference](#-quick-reference)

---

## âœ… Persyaratan Sistem

| Kebutuhan | Versi Minimum | Cek |
|---|---|---|
| PHP | 8.2+ | `php -v` |
| Composer | 2.x | `composer -V` |
| MySQL | 5.7+ / MariaDB 10.4+ | - |
| Node.js | 18+ (opsional) | `node -v` |

> **Rekomendasi:** Gunakan **Laragon** â€” sudah include PHP, MySQL, Composer dalam 1 paket.  
> Download: https://laragon.org/download

---

## ðŸŸ¢ Instalasi dengan Laragon (Direkomendasikan)

### Langkah 1 â€” Tempatkan Folder Project

1. Ekstrak / clone project ke:
   ```
   C:\laragon\www\mental-health-api\
   ```
2. Buka **Laragon** â†’ klik kanan tray icon â†’ **Start All**
3. Pastikan **Apache** dan **MySQL** berstatus hijau

### Langkah 2 â€” Buat Database

1. Buka browser â†’ **http://localhost/phpmyadmin**
2. Klik **New** di panel kiri
3. Isi nama database: `mental_health_api`
4. Collation: `utf8mb4_unicode_ci`
5. Klik **Create**

### Langkah 3 â€” Konfigurasi .env

```bash
# Di terminal (Laragon terminal atau CMD di folder project):
copy .env.example .env
```

Buka `.env` lalu ubah bagian ini:

```env
APP_NAME=mental_health_api
APP_ENV=local
APP_URL=http://mental-health-api.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mental_health_api
DB_USERNAME=root
DB_PASSWORD=

APP_API_KEY=rahasia-uas-123

JWT_SECRET=          # akan diisi otomatis oleh perintah jwt:secret
```

> Password MySQL Laragon default: **kosong**

### Langkah 4 â€” Install Dependency & Setup

Buka **Laragon Terminal** (Alt+T) atau CMD di folder project:

```bash
cd C:\laragon\www\mental-health-api

composer install

php artisan key:generate

php artisan jwt:secret

php artisan migrate

php artisan storage:link
```

### Langkah 5 â€” Akses Aplikasi

Laragon otomatis membuat virtual host:

```
http://mental-health-api.test
```

Atau jalankan manual:

```bash
php artisan serve
# Akses: http://localhost:8000
```

---

## ðŸ”µ Instalasi dengan XAMPP

### Langkah 1 â€” Tempatkan Folder Project

1. Ekstrak / clone project ke:
   ```
   C:\xampp\htdocs\mental-health-api\
   ```

### Langkah 2 â€” Jalankan XAMPP

1. Buka **XAMPP Control Panel**
2. Klik **Start** pada **Apache** dan **MySQL**
3. Pastikan keduanya **Running** (hijau)

### Langkah 3 â€” Buat Database

1. Buka browser â†’ **http://localhost/phpmyadmin**
2. Klik **New** di panel kiri
3. Nama database: `mental_health_api`
4. Collation: `utf8mb4_unicode_ci` â†’ **Create**

### Langkah 4 â€” Tambahkan PHP ke PATH (jika belum)

Jika perintah `php` tidak dikenali di CMD:

1. **Start** â†’ cari **"Environment Variables"** â†’ buka
2. **System Variables** â†’ pilih **Path** â†’ **Edit**
3. **New** â†’ tambahkan: `C:\xampp\php`
4. **OK** â†’ tutup CMD â†’ buka CMD baru
5. Verifikasi: `php -v`

Lakukan hal sama untuk Composer jika belum terinstal:
- Download dari: https://getcomposer.org/Composer-Setup.exe

### Langkah 5 â€” Buka CMD di Folder Project

Buka File Explorer â†’ masuk ke `C:\xampp\htdocs\mental-health-api\`  
Klik address bar â†’ ketik `cmd` â†’ **Enter**

### Langkah 6 â€” Konfigurasi .env

```cmd
copy .env.example .env
```

Buka `.env`, ubah bagian ini:

```env
APP_NAME=mental_health_api
APP_ENV=local
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mental_health_api
DB_USERNAME=root
DB_PASSWORD=

APP_API_KEY=rahasia-uas-123
```

> Password MySQL XAMPP default: **kosong**. Jika pernah diubah, isi sesuai passwordmu.

### Langkah 7 â€” Install Dependency & Setup

```bash
composer install

php artisan key:generate

php artisan jwt:secret

php artisan migrate

php artisan storage:link

php artisan serve
```

Akses di: **http://localhost:8000**

---

## âš™ï¸ Konfigurasi .env

Berikut bagian penting yang **wajib** dikonfigurasi:

```env
# Nama & URL aplikasi
APP_NAME=mental_health_api
APP_URL=http://localhost:8000          # sesuaikan

# Database MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mental_health_api
DB_USERNAME=root
DB_PASSWORD=                           # kosong jika default

# API Key (jangan diubah â€” dipakai oleh frontend)
APP_API_KEY=rahasia-uas-123

# Session (gunakan file agar tidak butuh tabel sessions)
SESSION_DRIVER=file

# JWT (diisi otomatis oleh php artisan jwt:secret)
JWT_SECRET=
```

> **Penting:** `SESSION_DRIVER=file` lebih mudah untuk instalasi lokal.  
> Jika tetap `database`, pastikan tabel `sessions` sudah ada (sudah include di migrasi).

---

## ðŸ—„ï¸ Migrasi Database

Jalankan satu perintah untuk membuat semua tabel:

```bash
php artisan migrate
```

Tabel yang akan dibuat:

| Tabel | Keterangan |
|---|---|
| `users` | Data pengguna + kolom `role`, `status`, `bio`, `avatar`, `address` |
| `moods` | Log mood harian user |
| `assessments` | Hasil tes stres user |
| `news` | Artikel berita (CRUD oleh admin) |
| `chat_rooms` | Ruang chat antara user dan terapis |
| `messages` | Pesan dalam chat room |
| `sessions` | Sesi login |
| `cache` | Cache framework |
| `jobs` | Queue jobs |
| `personal_access_tokens` | Token API Sanctum |

Untuk **reset** dan mulai ulang:

```bash
php artisan migrate:fresh
# atau dengan seed (jika ada):
php artisan migrate:fresh --seed
```

---

## ðŸ‘¤ Buat Akun Admin

Setelah migrasi, buat akun admin via **Tinker**:

```bash
php artisan tinker
```

Di dalam tinker, ketik:

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name'     => 'Admin mental_health_api',
    'email'    => 'admin@mental_health_api.id',
    'password' => Hash::make('admin123'),
    'role'     => 'admin',
    'status'   => 'active',
]);
```

Tekan **Enter** lalu ketik `exit`.

Login admin di: `http://localhost:8000/login`  
Email: `admin@mental_health_api.id` | Password: `admin123`

> **Catatan:** Akun dengan `role=admin` akan diarahkan ke `/admin/dashboard` setelah login.

---

## ðŸŒ Akses Halaman

| Halaman | URL | Role |
|---|---|---|
| Landing Page | `/` | Semua |
| Register | `/register` | Tamu |
| Login | `/login` | Tamu |
| **Dashboard** | `/dashboard` | User |
| **Tes Stres** | `/assessment` | User |
| **Relaksasi** | `/relaxation` | User |
| **Terapi Game** | `/games` | User |
| **Psikolog Terdekat** | `/nearby` | User |
| **Library** | `/education` | User |
| **Berita** | `/news` | Semua (CRUD: Admin) |
| **Chat Terapis** | `/chat` | User |
| **Profil** | `/profile` | Semua |
| Panel Terapis | `/therapist/dashboard` | Therapist |
| Admin Dashboard | `/admin/dashboard` | Admin |
| Kelola Terapis | `/admin/therapists` | Admin |
| Kelola Berita | `/admin/news` | Admin |

---

## ðŸ” Peran & Hak Akses

| Role | Cara Daftar | Tampilan |
|---|---|---|
| **user** | Daftar via `/register` pilih "User" | Sidebar kiri + semua fitur user |
| **therapist** | Daftar via `/register` pilih "Terapis" â†’ tunggu approval admin | Panel chat + status pending/aktif |
| **admin** | Dibuat manual via Tinker | Panel admin + CRUD berita + kelola terapis |

**Alur Therapist:**
1. Daftar sebagai terapis â†’ status `pending`
2. Admin login â†’ `/admin/therapists` â†’ klik **Approve**
3. Terapis bisa menerima chat dari user

---

## ðŸ“¡ API Endpoint

Semua request API wajib menyertakan header:

```
X-API-KEY: rahasia-uas-123
```

### Auth

| Method | Endpoint | Body | Keterangan |
|---|---|---|---|
| POST | `/api/register` | name, email, password, role | Daftar akun |
| POST | `/api/login` | email, password | Login â†’ dapat JWT token |

### User (butuh `Authorization: Bearer {token}`)

| Method | Endpoint | Keterangan |
|---|---|---|
| GET | `/api/profile` | Data profil user |
| PUT | `/api/profile` | Update profil |
| GET | `/api/moods` | Daftar mood |
| POST | `/api/moods` | Simpan mood |
| DELETE | `/api/moods/{id}` | Hapus mood |
| GET | `/api/assessments` | Riwayat tes stres |
| POST | `/api/assessments` | Simpan hasil tes |
| GET | `/api/news` | Daftar berita |
| GET | `/api/therapists` | Daftar terapis aktif |
| POST | `/api/chat/start` | Mulai chat dengan terapis |
| GET | `/api/chat/rooms` | Daftar room chat |
| GET | `/api/chat/rooms/{id}/messages` | Pesan dalam room |
| POST | `/api/chat/rooms/{id}/messages` | Kirim pesan |

### Contoh Penggunaan

```bash
# 1. Login
curl -X POST http://localhost:8000/api/login \
  -H "X-API-KEY: rahasia-uas-123" \
  -H "Content-Type: application/json" \
  -d '{"email":"user@test.com","password":"password"}'

# Response: {"token":"eyJ...","name":"Budi","role":"user","id":1}

# 2. Ambil berita (gunakan token dari response login)
curl -X GET http://localhost:8000/api/news \
  -H "X-API-KEY: rahasia-uas-123" \
  -H "Authorization: Bearer eyJ..."
```

---

## ðŸ“ Struktur Folder

```
mental-health-api/
â”œâ”€â”€ app/
â”‚   â”œâ”€â”€ Http/
â”‚   â”‚   â”œâ”€â”€ Controllers/
â”‚   â”‚   â”‚   â”œâ”€â”€ AuthController.php        # Login, register (web + API)
â”‚   â”‚   â”‚   â”œâ”€â”€ MoodController.php        # CRUD mood
â”‚   â”‚   â”‚   â”œâ”€â”€ AssessmentController.php  # Tes stres
â”‚   â”‚   â”‚   â”œâ”€â”€ ChatController.php        # Chat user â†” terapis
â”‚   â”‚   â”‚   â”œâ”€â”€ NewsController.php        # Berita (CRUD admin)
â”‚   â”‚   â”‚   â”œâ”€â”€ AdminController.php       # Panel admin
â”‚   â”‚   â”‚   â””â”€â”€ ProfileController.php     # Profil user
â”‚   â”‚   â””â”€â”€ Middleware/
â”‚   â”‚       â”œâ”€â”€ ApiKeyMiddleware.php       # Validasi X-API-KEY
â”‚   â”‚       â”œâ”€â”€ WebAuthMiddleware.php      # Cek session login
â”‚   â”‚       â””â”€â”€ RoleMiddleware.php         # Cek role user
â”‚   â””â”€â”€ Models/
â”‚       â”œâ”€â”€ User.php
â”‚       â”œâ”€â”€ Mood.php
â”‚       â”œâ”€â”€ Assessment.php
â”‚       â”œâ”€â”€ News.php
â”‚       â”œâ”€â”€ ChatRoom.php
â”‚       â””â”€â”€ Message.php
â”œâ”€â”€ database/
â”‚   â””â”€â”€ migrations/                       # 10 file migrasi
â”œâ”€â”€ resources/views/
â”‚   â”œâ”€â”€ layouts/app.blade.php             # Layout utama (navbar/sidebar)
â”‚   â”œâ”€â”€ partials/user-sidebar.blade.php   # Sidebar role user
â”‚   â”œâ”€â”€ auth/ (login, register)
â”‚   â”œâ”€â”€ dashboard.blade.php
â”‚   â”œâ”€â”€ assessment.blade.php
â”‚   â”œâ”€â”€ relaxation.blade.php
â”‚   â”œâ”€â”€ education.blade.php
â”‚   â”œâ”€â”€ games*.blade.php
â”‚   â”œâ”€â”€ nearby.blade.php
â”‚   â”œâ”€â”€ news/
â”‚   â”œâ”€â”€ chat/
â”‚   â”œâ”€â”€ therapist/
â”‚   â”œâ”€â”€ admin/
â”‚   â””â”€â”€ profile/
â”œâ”€â”€ routes/
â”‚   â”œâ”€â”€ web.php                           # Route halaman web
â”‚   â””â”€â”€ api.php                           # Route API (38 endpoint)
â”œâ”€â”€ .env.example                          # Template konfigurasi
â””â”€â”€ README.md
```

---

## ðŸ”§ Troubleshooting

| Masalah | Solusi |
|---|---|
| `php: command not found` | Tambahkan PHP ke PATH Windows (lihat Langkah 4 XAMPP) |
| `composer: command not found` | Download dari https://getcomposer.org |
| `Access denied for user 'root'` | Cek password MySQL di `.env` â€” coba kosongkan `DB_PASSWORD=` |
| `Unknown database 'mental_health_api'` | Buat database `mental_health_api` di **phpMyAdmin** (`http://localhost/phpmyadmin`) terlebih dahulu |
| `Class "JWTAuth" not found` | Jalankan `php artisan jwt:secret` |
| Error 500 / APP_KEY missing | Jalankan `php artisan key:generate` |
| `storage/app/public` tidak bisa diakses | Jalankan `php artisan storage:link` |
| Gambar berita tidak muncul | Pastikan `storage:link` sudah dijalankan |
| Port 8000 sudah dipakai | Jalankan `php artisan serve --port=8080` |
| Session error / login loop | Pastikan `SESSION_DRIVER=file` di `.env` |
| Chat tidak load | Pastikan `APP_API_KEY=rahasia-uas-123` di `.env` |
| `composer install` lambat | Gunakan koneksi WiFi stabil, bukan hotspot |
| Migrasi gagal (column exists) | Jalankan `php artisan migrate:fresh` *(data hilang)* |

---

## âš¡ Quick Reference

```bash
# ====== SETUP LENGKAP (copy-paste sekaligus) ======
composer install
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan storage:link
php artisan serve

# ====== Jalankan ulang setelah restart komputer ======
php artisan serve
# Akses: http://localhost:8000

# ====== Reset database (data hilang!) ======
php artisan migrate:fresh

# ====== Buat akun admin via Tinker ======
php artisan tinker
# Lalu:
# User::create(['name'=>'Admin','email'=>'admin@mental_health_api.id','password'=>Hash::make('admin123'),'role'=>'admin','status'=>'active']);

# ====== Cek error log ======
tail -f storage/logs/laravel.log   # Linux/Mac
Get-Content storage\logs\laravel.log -Tail 20  # Windows PowerShell
```

---

## ðŸ“Š Stack Teknologi

| Layer | Teknologi |
|---|---|
| Backend | Laravel 13, PHP 8.4 |
| Auth | Laravel Session (web) + JWT (API) |
| Database | MySQL / MariaDB |
| Frontend | Blade Templates, Tailwind CSS CDN |
| Font | Google Fonts (Outfit, Plus Jakarta Sans) |
| Map | Leaflet.js (halaman Psikolog Terdekat) |
| Chat | AJAX polling 5 detik |

---

*mental_health_api Â© 2026 â€” Dibuat sebagai proyek UAS dengan tema UN SDG 3 (Good Health and Well-Being)*

