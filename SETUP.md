# 📋 Setup dan Installation Guide - Exitem

Panduan lengkap untuk menjalankan project **Exitem** (Platform E-commerce dengan Laravel 12, Filament Admin Panel, dan Livewire).

---

## 📋 Daftar Isi
1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Environment Variables (.env)](#environment-variables)
4. [Menjalankan Project](#menjalankan-project)
5. [Database Setup](#database-setup)
6. [Troubleshooting](#troubleshooting)

---

## 🔧 Requirements

Pastikan komputer Anda telah menginstall:

| Requirement | Versi | Status |
|---|---|---|
| **PHP** | 8.2+ | ✅ Required |
| **Composer** | Latest | ✅ Required |
| **Node.js** | 18+ | ✅ Required |
| **npm** atau **yarn** | Latest | ✅ Required |
| **MySQL** | 8.0+ | ✅ Required |
| **Git** | Latest | ✅ Required |

### Verifikasi Instalasi
```bash
# Cek PHP
php -v

# Cek Composer
composer --version

# Cek Node.js
node -v

# Cek npm
npm -v

# Cek MySQL
mysql --version
```

---

## 🚀 Installation

### Step 1: Clone Repository
```bash
# Clone project dari GitHub
git clone https://github.com/Lyon-Athaly/Exitem.git
cd Exitem

# Atau jika sudah ada, cukup navigasi ke folder project
cd /path/to/Exitem
```

### Step 2: Install PHP Dependencies
```bash
# Install composer packages
composer install
```

### Step 3: Setup Environment File
```bash
# Copy .env.example ke .env (jika belum ada)
cp .env.example .env

# Atau jika file sudah ada, lanjut ke step berikutnya
```

### Step 4: Generate Application Key
```bash
# Generate APP_KEY untuk encryption
php artisan key:generate
```

### Step 5: Install Node Dependencies
```bash
# Install npm packages
npm install
```

### Step 6: Setup Database
```bash
# Buat database MySQL (buka MySQL client terlebih dahulu)
mysql -u root -p
# Masukkan password (default: p455w0rd atau sesuai konfigurasi Anda)

# Lalu jalankan query:
CREATE DATABASE exitem;
EXIT;
```

### Step 7: Run Database Migrations
```bash
# Jalankan migrations untuk membuat semua tabel
php artisan migrate

# Atau jika ingin dengan seed data:
php artisan migrate:seed
```

### Step 8: Create Storage Link
```bash
# Buat symbolic link untuk public storage
php artisan storage:link
```

### Instalasi Otomatis (Alternative)
Atau gunakan script setup yang sudah ada di composer.json:
```bash
composer run-script setup
```

---

## 🔐 Environment Variables

File `.env` adalah file konfigurasi yang **SANGAT PENTING**. Berikut adalah penjelasan setiap variabel:

### 📱 Application Settings

```env
APP_NAME=Laravel
# Nama aplikasi yang akan ditampilkan di berbagai tempat (email, sidebar, dll)
# ⚙️ Ubah ke: Exitem

APP_ENV=local
# Environment: local, staging, atau production
# local = development (debug ON), production = production (debug OFF)
# ⚙️ Gunakan: local (untuk development)

APP_KEY=
# Encryption key untuk session, cookies, dll. JANGAN UBAH MANUAL!
# Generate otomatis dengan: php artisan key:generate

APP_DEBUG=true
# Tampilkan debug information jika ada error
# ⚙️ Ubah ke: false (untuk production)

APP_URL=http://localhost:8000
# URL aplikasi untuk generate links, etc
# ⚙️ Ubah sesuai domain: https://yoursite.com
```

### 🌍 Localization

```env
APP_LOCALE=en
# Default locale (en, id, fr, etc)
# ⚙️ Ubah ke: id (untuk Indonesia)

APP_FALLBACK_LOCALE=en
# Fallback locale jika translation tidak ditemukan
# ⚙️ Ubah ke: id

APP_FAKER_LOCALE=en_US
# Locale untuk fake data generator
# ⚙️ Ubah ke: id_ID
```

### 🗄️ Database Configuration

```env
DB_CONNECTION=mysql
# Database driver: mysql, sqlite, pgsql, sqlsrv
# ⚙️ Gunakan: mysql (default)

DB_HOST=127.0.0.1
# Host/IP address database server
# ⚙️ Ubah jika menggunakan host berbeda

DB_PORT=3306
# Port MySQL (default 3306)
# ⚙️ Ubah jika port MySQL berbeda

DB_DATABASE=exitem
# Nama database yang digunakan
# ⚙️ Sesuaikan dengan nama database yang Anda buat
# ⚠️ PENTING: Database HARUS sudah dibuat sebelumnya!

DB_USERNAME=root
# Username untuk login ke database
# ⚙️ Ubah sesuai konfigurasi MySQL Anda

DB_PASSWORD=
# Password untuk login ke database
# ⚙️ UBAH ke password yang aman!
# Jangan gunakan password default di production!
```

**Contoh alternatif jika MySQL berjalan di tempat lain:**
```env
DB_HOST=192.168.1.100
DB_PORT=3306
DB_DATABASE=exitem_prod
DB_USERNAME=exitem_user
DB_PASSWORD=SuperSecurePassword123!
```

### 🔐 Logging & Cache

```env
LOG_CHANNEL=stack
# Channel untuk logging: single, daily, syslog, stderr
# ⚙️ Gunakan: single (untuk development)

LOG_STACK=single
# Stack untuk logging
# ⚙️ Gunakan: single

LOG_LEVEL=debug
# Level logging: debug, info, notice, warning, error, critical, alert, emergency
# ⚙️ Ubah ke: info atau warning (untuk production)

CACHE_STORE=database
# Cache driver: file, database, redis, memcached
# ⚙️ Gunakan: database (untuk development)
```

### 📧 Session & Broadcasting

```env
SESSION_DRIVER=database
# Session driver: file, cookie, database, redis, memcached
# ⚙️ Gunakan: database (untuk development)

SESSION_LIFETIME=120
# Session lifetime dalam menit
# ⚙️ Ubah sesuai kebutuhan (default: 120 menit)

SESSION_ENCRYPT=false
# Encrypt session data?
# ⚙️ Ubah ke: true (untuk production)

BROADCAST_CONNECTION=log
# Broadcasting driver: log, redis, pusher
# ⚙️ Gunakan: log (untuk development)
```

### 💾 File Storage

```env
FILESYSTEM_DISK=public
# Disk untuk menyimpan file: public, local, s3, dll
# ⚙️ Gunakan: public (untuk development)
# File akan disimpan di: storage/app/public
```

### 🔄 Queue Processing

```env
QUEUE_CONNECTION=database
# Queue driver: database, redis, sqs, beanstalkd
# ⚙️ Gunakan: database (untuk development)

# Jalankan queue worker:
# php artisan queue:work
```

### 📧 Mail Configuration

```env
MAIL_MAILER=log
# Mail mailer: log, smtp, mailgun, postmark, ses, sendmail
# ⚙️ Gunakan: log (untuk development - log di file)
# ⚙️ Ubah ke: smtp atau mailgun (untuk production)

MAIL_SCHEME=null
# Encryption scheme: tls atau ssl (jika SMTP)

MAIL_HOST=127.0.0.1
# SMTP host (jika menggunakan SMTP)
# Contoh: smtp.gmail.com, smtp.mailtrap.io

MAIL_PORT=2525
# SMTP port (jika menggunakan SMTP)
# Contoh: 465 (SSL), 587 (TLS)

MAIL_USERNAME=null
# SMTP username

MAIL_PASSWORD=null
# SMTP password

MAIL_FROM_ADDRESS="hello@example.com"
# Email pengirim default
# ⚙️ Ubah ke email yang valid
# Contoh: noreply@exitem.com

MAIL_FROM_NAME="${APP_NAME}"
# Nama pengirim default (akan menggunakan APP_NAME)
```

**Contoh konfigurasi Gmail:**
```env
MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME=Exitem
```

### 🌐 Redis Configuration (Optional)

```env
REDIS_CLIENT=phpredis
# Redis client: phpredis atau predis

REDIS_HOST=127.0.0.1
# Redis host

REDIS_PASSWORD=null
# Redis password

REDIS_PORT=6379
# Redis port
```

### 🔐 AWS S3 Configuration (Optional)

```env
AWS_ACCESS_KEY_ID=
# AWS Access Key (jika menggunakan S3)

AWS_SECRET_ACCESS_KEY=
# AWS Secret Key (jika menggunakan S3)

AWS_DEFAULT_REGION=us-east-1
# AWS Region

AWS_BUCKET=
# S3 Bucket name

AWS_USE_PATH_STYLE_ENDPOINT=false
# Gunakan path-style endpoint
```

### 📦 Vite Frontend

```env
VITE_APP_NAME="${APP_NAME}"
# Nama aplikasi untuk frontend (JavaScript)
```

---

## 🏃 Menjalankan Project

### Option 1: Menggunakan Laravel Artisan (Recommended)

```bash
# Terminal 1: Jalankan development server
php artisan serve

# Akses di: http://localhost:8000
```

### Option 2: Menggunakan PHP Built-in Server

```bash
# Terminal 1: Jalankan PHP server
php -S localhost:8000 -t public

# Akses di: http://localhost:8000
```

### Option 3: Menggunakan Vite Dev Server (untuk Frontend)

```bash
# Terminal 1: Jalankan Laravel server
php artisan serve

# Terminal 2: Jalankan Vite dev server
npm run dev

# Akses di: http://localhost:8000
```

### 📋 Kombinasi Commands untuk Development

```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Vite dev server
npm run dev

# Terminal 3: Start Queue Worker (jika diperlukan)
php artisan queue:work

# Terminal 4: Optional - Tail logs
php artisan log:tail
```

---

## 🗄️ Database Setup

### Membuat Database Baru

**Menggunakan MySQL Command Line:**
```bash
mysql -u root -p
# Masukkan password

# Di MySQL prompt:
CREATE DATABASE exitem;
SHOW DATABASES; # Verifikasi
EXIT;
```

**Menggunakan MySQL Workbench:**
1. Buka MySQL Workbench
2. Klik "Create a new schema"
3. Nama: `exitem`
4. Klik "Apply"

### Menjalankan Migrations

```bash
# Jalankan semua migrations
php artisan migrate

# Rollback terakhir migration (undo)
php artisan migrate:rollback

# Rollback semua migrations
php artisan migrate:reset

# Migrate + Rollback + Re-run (Fresh)
php artisan migrate:refresh

# Migrate fresh + seed
php artisan migrate:fresh --seed
```

### Seeding Data (Optional)

```bash
# Jalankan semua seeders
php artisan db:seed

# Jalankan seeder spesifik
php artisan db:seed --class=RoleSeeder
```

### Melihat Database

**Menggunakan MySQL Command Line:**
```bash
mysql -u root -p exitem
# Masukkan password

# Di MySQL prompt:
SHOW TABLES;
DESCRIBE banners; # Lihat struktur tabel
SELECT * FROM users; # Lihat isi data
EXIT;
```

**Menggunakan Tools:**
- phpMyAdmin: http://localhost/phpmyadmin
- MySQL Workbench: GUI tool untuk MySQL
- HeidiSQL: Free MySQL GUI
- DBeaver: Universal database tool

---

## 🔑 Akses Admin Panel

### Login ke Filament Admin

1. Buka browser: `http://localhost:8000/admin`
2. Jika belum ada user, buat user baru via artisan:

```bash
# Buat user admin
php artisan tinker

# Di Tinker prompt:
$user = User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role_id' => 1, // Asumsikan role_id 1 adalah admin
]);

# Atau
User::create([
    'name' => 'Admin',
    'email' => 'admin@exitem.com',
    'password' => bcrypt('securePassword123'),
    'role_id' => 1,
]);

exit
```

3. Login dengan email dan password yang dibuat
4. Akses: http://localhost:8000/admin

---

## 📝 Checklist Setup

Pastikan semua langkah berikut sudah dikerjakan:

- [ ] PHP 8.2+ terinstall
- [ ] Composer terinstall
- [ ] Node.js 18+ terinstall
- [ ] MySQL 8.0+ terinstall dan berjalan
- [ ] Project di-clone
- [ ] `composer install` sudah dijalankan
- [ ] `.env` file sudah dikonfigurasi
- [ ] `php artisan key:generate` sudah dijalankan
- [ ] Database sudah dibuat: `CREATE DATABASE exitem;`
- [ ] `php artisan migrate` sudah dijalankan
- [ ] `npm install` sudah dijalankan
- [ ] Storage link sudah dibuat: `php artisan storage:link`
- [ ] Server sudah berjalan: `php artisan serve`
- [ ] Akses http://localhost:8000 sudah berhasil

---

## 🐛 Troubleshooting

### Error: "No application encryption key has been specified"
```bash
# Solution: Generate APP_KEY
php artisan key:generate
```

### Error: "Access denied for user 'root'@'localhost'"
```bash
# Check .env DB credentials
# Pastikan DB_PASSWORD sesuai dengan password MySQL Anda
# Default MySQL di XAMPP/WAMP biasanya kosong, jadi:
DB_PASSWORD=
```

### Error: "SQLSTATE[HY000] [2002] No such file or directory"
```bash
# MySQL tidak berjalan. Pastikan MySQL service sudah di-start:
# Windows: Services > MySQL > Start
# Linux: sudo systemctl start mysql
# macOS: brew services start mysql
```

### Error: "Class not found" atau "Undefined method"
```bash
# Run composer autoload
composer dump-autoload

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Error: "npm ERR! code ERESOLVE"
```bash
# Update npm
npm install -g npm@latest

# Atau gunakan legacy dependency resolution
npm install --legacy-peer-deps
```

### Assets tidak ter-compile
```bash
# Build assets
npm run build

# Atau jika development:
npm run dev

# Clear Vite cache
rm -rf node_modules/.vite
```

### File upload tidak berfungsi
```bash
# Create storage link
php artisan storage:link

# Check permissions
chmod -R 775 storage/
chmod -R 775 public/storage/
```

### Queue not processing
```bash
# Jalankan queue worker
php artisan queue:work

# Atau untuk daemon mode
php artisan queue:work --daemon
```

---

## 🚀 Production Deployment

### Pre-Deployment Checklist

```env
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=warning
SESSION_ENCRYPT=true
CACHE_STORE=redis  # Gunakan redis, bukan database
QUEUE_CONNECTION=redis  # Gunakan redis, bukan database
```

### Build untuk Production

```bash
# Install dependencies
composer install --no-dev --optimize-autoloader

# Generate optimized config
php artisan config:cache

# Compile views
php artisan view:cache

# Optimize routes
php artisan route:cache

# Build frontend assets
npm run build
```

---

## 📚 Useful Commands

```bash
# Clear all caches
php artisan cache:clear

# Clear config cache
php artisan config:clear

# Clear view cache
php artisan view:clear

# Clear route cache
php artisan route:clear

# Tinker (Interactive PHP shell)
php artisan tinker

# Run tests
php artisan test

# Generate API documentation
php artisan scribe:generate

# List all routes
php artisan route:list

# Optimize application
php artisan optimize

# Show application info
php artisan about
```

---

## 📖 Dokumentasi Tambahan

- [Laravel Documentation](https://laravel.com/docs)
- [Filament Documentation](https://filamentphp.com/docs)
- [Livewire Documentation](https://livewire.laravel.com)
- [Volt Documentation](https://livewire.laravel.com/docs/volt)
- [Tailwind CSS](https://tailwindcss.com/docs)

---

## 💬 Support

Jika ada pertanyaan atau masalah:

1. Cek error message dengan detail
2. Check `storage/logs/laravel.log` untuk error details
3. Jalankan `php artisan about` untuk system info
4. Buka issue di repository GitHub

---

**Last Updated**: May 2026  
**Laravel Version**: 12.0  
**PHP Version**: 8.2+
