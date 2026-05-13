# ⚡ Quick Start - Exitem

Panduan tercepat untuk langsung menjalankan project Exitem.

---

## 🎯 5 Menit Setup (Copy-Paste)

### Prerequisites (install dulu jika belum):
```bash
# Cek versi
php -v          # PHP 8.2+
composer -v     # Latest
node -v         # Node.js 18+
npm -v          # Latest
mysql --version # MySQL 8.0+
```

### 1. Clone & Install

```bash
# Clone project
git clone https://github.com/Lyon-Athaly/Exitem.git
cd Exitem

# Install dependencies
composer install
npm install
```

### 2. Configure .env

```bash
# Copy env file
cp .env.example .env

# Generate app key
php artisan key:generate
```

**Edit `.env` - ubah bagian DATABASE:**
```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=exitem
DB_USERNAME=root
DB_PASSWORD=p455w0rd  # UBAH KE PASSWORD MYSQL ANDA
```

### 3. Create Database

```bash
# Masuk ke MySQL
mysql -u root -p

# Paste ini di MySQL prompt:
CREATE DATABASE exitem;
EXIT;
```

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Start Server

**Terminal 1:**
```bash
php artisan serve
```

**Terminal 2:**
```bash
npm run dev
```

✅ **Buka:** http://localhost:8000

---

## 🔓 First Admin Access

```bash
# Generate admin user
php artisan tinker

# Paste ini:
User::create(['name' => 'Admin', 'email' => 'admin@exitem.com', 'password' => bcrypt('password')]);
exit
```

**Login ke admin:**
- URL: http://localhost:8000/admin
- Email: `admin@exitem.com`
- Password: `password`

---

## 🛠️ Sering Digunakan

```bash
# Database
php artisan migrate              # Run migrations
php artisan migrate:fresh        # Reset & run all migrations
php artisan db:seed              # Seed data
php artisan tinker               # Interactive PHP shell

# Cache/Config
php artisan cache:clear          # Clear cache
php artisan config:clear         # Clear config cache
php artisan view:clear           # Clear compiled views

# Serve
php artisan serve                # Start server (port 8000)
npm run dev                       # Start Vite dev server

# Build
npm run build                     # Production build

# Storage
php artisan storage:link         # Create public storage link
chmod -R 775 storage/            # Fix permissions
```

---

## 📋 Checklist

- [ ] PHP 8.2+, Composer, Node.js, npm installed
- [ ] Project cloned
- [ ] `composer install` ran
- [ ] `npm install` ran
- [ ] `.env` copied & configured
- [ ] `php artisan key:generate` ran
- [ ] Database created
- [ ] `php artisan migrate` ran
- [ ] Server started: `php artisan serve`
- [ ] Browser: http://localhost:8000 ✅

---

## 🆘 Troubleshooting

| Error | Solution |
|---|---|
| No encryption key | `php artisan key:generate` |
| Database error | Check `.env` DB config, create database |
| Port 8000 in use | `php artisan serve --port=8001` |
| npm ERR! | `npm install --legacy-peer-deps` |
| MySQL not found | Start MySQL service |
| Files not uploading | `php artisan storage:link` |

---

## 📚 Full Documentation

- [Setup Guide](SETUP.md)
- [.env Variables](ENV_VARIABLES.md)
- [Laravel Docs](https://laravel.com/docs)
- [Filament Docs](https://filamentphp.com/docs)

---

**Ready?** Let's go! 🚀

```bash
php artisan serve
npm run dev
# Then open http://localhost:8000
```
