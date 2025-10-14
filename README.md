📦 Naik Kelas API Backend (Laravel 12)
Selamat datang di repositori backend API untuk proyek Naik Kelas. Sistem ini menyediakan endpoint CRUD (Create, Read, Update, Delete) yang aman untuk semua data yang diperlukan oleh Dashboard Admin dan halaman publik (total 7 resources).

🔑 I. Struktur Proyek & Keamanan
A. Teknologi Utama
Framework: Laravel v12 (PHP)

Database: MySQL

Otentikasi: Laravel Sanctum (Session-based Auth untuk Dashboard)

B. Konvensi Database
Semua Model menggunakan nama tabel tunggal (misalnya, User.php menggunakan tabel pengguna) dan properti timestamps dimatikan (public $timestamps = false;).

C. Penting: File Sensitif (.gitignore)
File .env, /vendor, dan /node_modules dikecualikan (di-ignore) dari GitHub untuk alasan keamanan dan efisiensi.

⚙️ II. Panduan Instalasi Awal (Setup Lokal)
Berikut adalah langkah-langkah yang harus dilakukan oleh developer untuk mengaktifkan backend.

1. Kloning Repositori & Instal Dependensi
# Kloning (Clone) repositori
git clone [https://github.com/KIRRUU0/naik-kelas-api-backend.git](https://github.com/KIRRUU0/naik-kelas-api-backend.git)
cd naik-kelas-api-backend

# Instal library PHP
composer install

2. Konfigurasi Environment (.env)
# Buat file .env dari template
cp .env.example .env

# Generate Application Key
php artisan key:generate

Edit file .env dan sesuaikan detail koneksi MySQL Anda:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=naik_kelas_db  
DB_USERNAME=root           # Sesuaikan user lokal Anda
DB_PASSWORD=               # Sesuaikan password lokal Anda

3. Pembuatan Database & Skema
Anda harus membuat database kosong dan menjalankan perintah migrasi untuk membuat semua tabel API (webinar, pengguna, dll.).

Buat database kosong bernama naik_kelas_db di server MySQL Anda (melalui phpMyAdmin atau CLI).

Jalankan perintah migrasi Laravel untuk membuat semua tabel:

php artisan migrate

4. Jalankan Server
php artisan serve

🔒 III. Panduan API & Akses Frontend
1. Akses Otentikasi (Frontend)
Login Endpoint: Digunakan untuk menginisiasi sesi dan mendapatkan session cookie.

[POST] [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)

Pendaftaran (Register): Digunakan untuk membuat pengguna baru.

[POST] [http://127.0.0.1:8000/api/pengguna](http://127.0.0.1:8000/api/pengguna)

2. Endpoint Utama (CRUD Penuh)
Resource

Metode

URL Endpoint

Keamanan

Webinar

GET

/api/webinar

Publik

Webinar

POST/PUT/DELETE

/api/webinar/{id}

Auth: Sanctum

Pengguna

GET/PUT/DELETE

/api/pengguna/{id}

Auth: Sanctum

Modul Bisnis

CRUD

/api/modul-bisnis/{id}

Auth: Sanctum

Layanan Umum

CRUD

/api/layanan-umum/{id}

Auth: Sanctum

Mitra Broker

CRUD

/api/mitra-broker/{id}

Auth: Sanctum

... (dan lainnya)







