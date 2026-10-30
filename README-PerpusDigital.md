# PerpusDigital

Aplikasi web manajemen perpustakaan digital yang dibuat menggunakan **Laravel 13**, **PHP 8.3 atau lebih baru**, dan database relasional (MySQL atau SQLite).

PerpusDigital membantu pengelolaan koleksi buku, kategori, anggota, serta proses peminjaman dan pengembalian buku.

## Fitur Aplikasi

### 1. Autentikasi
- Login menggunakan email dan password.
- Registrasi anggota baru.
- Logout dengan mengakhiri sesi login.

### 2. Dashboard
- Menampilkan jumlah seluruh buku.
- Menampilkan jumlah kategori.
- Menampilkan jumlah anggota.
- Menampilkan jumlah transaksi peminjaman.
- Menyediakan akses cepat ke menu Buku, Kategori, dan Peminjaman.
- Menampilkan informasi akun yang sedang login.

### 3. Manajemen Buku
- Melihat daftar buku dengan pagination.
- Melihat detail buku.
- Menambahkan buku.
- Mengubah data buku.
- Menghapus buku (buku yang memiliki riwayat peminjaman tidak dapat dihapus).
- Menyimpan informasi judul, penulis, ISBN, kategori, stok, penerbit, dan tahun terbit.

### 4. Manajemen Kategori
- Melihat daftar dan detail kategori.
- Menambahkan kategori.
- Mengubah kategori.
- Menghapus kategori (kategori yang masih memiliki buku tidak dapat dihapus).

### 5. Peminjaman Buku
- Anggota dapat mengajukan peminjaman buku.
- Permintaan peminjaman memiliki status **menunggu**.
- Admin atau petugas dapat menyetujui atau menolak permintaan.
- Saat disetujui, stok buku berkurang.
- Saat buku dikembalikan, stok bertambah kembali.
- Anggota dapat melihat transaksi peminjamannya sendiri.
- Lama peminjaman yang ditetapkan aplikasi adalah 7 hari.

## Teknologi yang Digunakan

- **Backend:** PHP dan Laravel 13
- **Frontend:** Blade Template, HTML, CSS
- **Database:** MySQL atau SQLite (sesuai konfigurasi `.env`)
- **Dependency manager:** Composer
- **Local development:** Laragon atau PHP development server

## Akun Tester

Gunakan akun berikut untuk mencoba aplikasi:

| Peran / Penggunaan | Email | Password |
|---|---|---|
| Admin | `admin@perpus.test` | `GantiPassword123!` |
| Anggota / tester | `naufalihtaza@gmail.com` | `12345678` |

> Catatan: Akun admin dibuat oleh `AdminSeeder`. Akun anggota di atas adalah akun tester yang disediakan untuk pengujian. Jika akun anggota belum tersedia pada database yang digunakan, daftarkan akun tersebut melalui halaman Register atau tambahkan melalui database.

**Keamanan:** Akun di atas adalah akun untuk pengujian. Ganti password sebelum aplikasi digunakan di lingkungan produksi dan jangan gunakan password yang sama dengan akun pribadi.

## Persyaratan

Pastikan perangkat sudah memiliki:
- PHP **8.3 atau lebih baru**.
- Composer.
- MySQL/MariaDB (jika menggunakan MySQL).
- Node.js dan npm (hanya diperlukan jika ingin memasang atau membangun asset frontend melalui Vite).
- Laragon (opsional, untuk lingkungan Windows lokal).

## Cara Menjalankan di Komputer Lokal

### 1. Ekstrak project
Ekstrak folder project ke direktori web server. Contoh jika menggunakan Laragon:

```text
C:\laragon\www\perpus-digital
```

Buka terminal pada folder tersebut.

### 2. Pasang dependency PHP

```bash
composer install
```

### 3. Siapkan file environment

Jika file `.env` belum tersedia, salin `.env.example` menjadi `.env`.

Windows CMD:

```cmd
copy .env.example .env
```

PowerShell:

```powershell
Copy-Item .env.example .env
```

### 4. Atur database

Buka file `.env`, lalu pilih salah satu konfigurasi berikut.

**Pilihan A — MySQL (misalnya melalui Laragon)**

Buat database baru melalui phpMyAdmin atau HeidiSQL, misalnya `perpus_digital`. Sesuaikan bagian database di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpus_digital
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan username dan password dengan konfigurasi MySQL di komputer masing-masing.

**Pilihan B — SQLite**

Jika ingin menggunakan SQLite, pastikan file database tersedia, lalu atur:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Jangan mengisi konfigurasi MySQL dan SQLite secara bersamaan. Gunakan satu jenis database yang dipilih.

### 5. Buat application key

```bash
php artisan key:generate
```

### 6. Jalankan migration dan seeder

Untuk membuat tabel database:

```bash
php artisan migrate
```

Untuk membuat akun admin dari `AdminSeeder`:

```bash
php artisan db:seed --class=AdminSeeder
```

Jika database masih kosong dan ingin menjalankan seluruh seeder:

```bash
php artisan db:seed
```

Seeder utama saat ini membuat akun `Test User` (`test@example.com`). `AdminSeeder` dijalankan terpisah untuk membuat akun admin. Jangan menjalankan `migrate:fresh` pada database yang berisi data penting karena perintah tersebut menghapus tabel dan membuatnya kembali.

### 7. Jalankan aplikasi

```bash
php artisan serve
```

Buka browser:

```text
http://127.0.0.1:8000
```

Halaman awal akan mengarahkan pengguna ke Dashboard jika sudah login, atau ke halaman Login jika belum login.

## Alur Penggunaan Singkat

1. Login menggunakan akun Admin atau akun Anggota.
2. Admin dapat membuka menu Buku dan Kategori untuk mengelola koleksi perpustakaan.
3. Anggota dapat melihat buku dan mengajukan peminjaman.
4. Admin atau petugas membuka menu Peminjaman untuk memproses permintaan.
5. Setelah peminjaman disetujui, stok buku otomatis berkurang.
6. Setelah buku dikembalikan, admin atau petugas memproses pengembalian dan stok otomatis bertambah.

## Struktur Menu

- **Dashboard** — ringkasan data perpustakaan.
- **Daftar Buku** — daftar dan detail koleksi buku.
- **Kategori** — pengelompokan koleksi buku.
- **Peminjaman** — pengajuan, persetujuan, penolakan, dan pengembalian buku.

## Perintah Bantuan

Membersihkan cache tampilan Blade:

```bash
php artisan view:clear
```

Membersihkan cache konfigurasi dan aplikasi:

```bash
php artisan optimize:clear
```

Melihat daftar route:

```bash
php artisan route:list
```

Menjalankan pengujian aplikasi:

```bash
php artisan test
```

## Catatan Keamanan dan Pengumpulan

- Jangan mengunggah file `.env` ke GitHub atau membagikannya kepada orang lain. File tersebut dapat berisi password database dan konfigurasi rahasia.
- Pastikan `.env` masuk ke `.gitignore`.
- Untuk pengumpulan tugas, sertakan source code, file README ini, dan bukti tampilan aplikasi sesuai instruksi dosen.
- Akun tester di README ditujukan untuk demo/pengujian, bukan penggunaan produksi.

---
**PerpusDigital — Sistem Informasi Perpustakaan**
