# 🐄 JatahQurban

Sistem pencatatan pembagian daging qurban berbasis QR Code. Aplikasi ini memudahkan panitia qurban dalam mendata, mengelola, dan mendistribusikan daging qurban kepada mustahiq dengan sistem scan QR Code.

## ✨ Fitur Utama

- 📱 **Scan QR Code** - Distribusi daging dengan scan QR Code menggunakan kamera
- 📊 **Manajemen Data Mustahiq** - Kelola data penerima qurban
- 🔐 **Multi-level User** - Role untuk admin, panitia, dan pengawas
- 📤 **Export Data** - Export laporan ke Excel/PDF
- 📤 **Import Data** - Import data warga dari CSV
- 📤 **Send Email** - Send QR ke Gmail warga.
- 📤 **Formulir Warga** - Bagikan dan biarkan warga mengisi datanya sendiri.

## 🛠️ Teknologi yang Digunakan

- **Laravel 12** - PHP Framework
- **Livewire 3** - Full-stack framework untuk Laravel
- **TailwindCSS** - CSS Framework
- **MySQL** - Database
- **HTML5 QR Code** - Library untuk generate dan scan QR

## 📋 Prasyarat

Sebelum memulai instalasi, pastikan komputer Anda memiliki:

- **PHP** (versi 8.4 atau lebih tinggi)
- **Composer** (versi 2.x)
- **Node.js & NPM** (versi 18.x atau lebih tinggi)
- **MySQL** (versi 8 atau lebih tinggi) / MariaDB
- **Git** (untuk cloning repository)
- **Web Server** (XAMPP/Laragon/)

## 🚀 Cara Installasi

### 1. Clone Repository

```bash
git clone https://github.com/Ferdinand05/jatah_qurban
cd jatah_qurban
```
```bash
composer install
```

Copy paste environment dan generate key
```bash
copy .env.example .env
php artisan key:generate
```

Edit file .env. buat database dan sesuaikan dengan config di env. contoh : 
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jatah_qurban
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi 
```bash
php artisan migrate
php artisan db:seed
php artisan db:seed --class=HouseholdSeeder
```
konfigurasi email smtp di .env untuk send qr code lewat gmail 
```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=emailanda@gmail.com
MAIL_PASSWORD=passwordaplikasianda
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=emailanda@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```
untuk lebih jelasnya bisa lihat disini : https://qadrlabs.com/post/tutorial-laravel-kirim-email-menggunakan-smtp-gmail

Jalankan :
```bash 
npm install
npm run build
```

jalankan aplikasi 
```bash
composer run dev
```

buka di browser http://127.0.0.1:8000/
