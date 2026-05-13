# 🔐 Environment Variables (.env) - Quick Reference

File `.env` ini adalah konfigurasi utama aplikasi. Semua nilai di bawah perlu dikonfigurasi sesuai environment Anda.

---

## ✅ .env Template - Development (COPY & PASTE)

```env
# Application
APP_NAME=Exitem
APP_ENV=local
APP_KEY=(Generate key laravel)
APP_DEBUG=true
APP_URL=http://localhost:8000

# Locale
APP_LOCALE=id
APP_FALLBACK_LOCALE=id
APP_FAKER_LOCALE=id_ID

# Maintenance
APP_MAINTENANCE_DRIVER=file

# Encryption
BCRYPT_ROUNDS=12

# Logging
LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

# ==================== DATABASE ====================
# Sesuaikan dengan konfigurasi MySQL Anda
DB_CONNECTION=mysql
DB_HOST=127.0.0.1          # Host MySQL (default: localhost)
DB_PORT=3306               # Port MySQL (default: 3306)
DB_DATABASE=exitem         # Nama database (HARUS SUDAH DIBUAT)
DB_USERNAME=root           # Username MySQL
DB_PASSWORD=     # Password MySQL - UBAH KE PASSWORD YANG AMAN!

# ==================== SESSION ====================
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

# ==================== BROADCAST ====================
BROADCAST_CONNECTION=log

# ==================== FILE STORAGE ====================
FILESYSTEM_DISK=public

# ==================== QUEUE ====================
QUEUE_CONNECTION=database

# ==================== CACHE ====================
CACHE_STORE=database
# CACHE_PREFIX=

# ==================== REDIS (Optional) ====================
MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# ==================== MAIL ====================
MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="noreply@exitem.com"
MAIL_FROM_NAME="${APP_NAME}"

# ==================== AWS S3 (Optional) ====================
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

# ==================== VITE ====================
VITE_APP_NAME="${APP_NAME}"
```

---

## 🔄 .env Template - Production

```env
# Application
APP_NAME=Exitem
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
APP_DEBUG=false
APP_URL=https://yoursite.com

# Locale
APP_LOCALE=id
APP_FALLBACK_LOCALE=id
APP_FAKER_LOCALE=id_ID

# Maintenance
APP_MAINTENANCE_DRIVER=file

# Encryption
BCRYPT_ROUNDS=12

# Logging
LOG_CHANNEL=stack
LOG_STACK=daily
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=warning

# ==================== DATABASE ====================
DB_CONNECTION=mysql
DB_HOST=your-db-host.com
DB_PORT=3306
DB_DATABASE=exitem_prod
DB_USERNAME=exitem_user
DB_PASSWORD=SuperSecurePassword123!

# ==================== SESSION ====================
SESSION_DRIVER=database
SESSION_LIFETIME=1440
SESSION_ENCRYPT=true
SESSION_PATH=/
SESSION_DOMAIN=.yoursite.com

# ==================== BROADCAST ====================
BROADCAST_CONNECTION=redis

# ==================== FILE STORAGE ====================
FILESYSTEM_DISK=public
# Atau jika menggunakan S3:
# FILESYSTEM_DISK=s3

# ==================== QUEUE ====================
QUEUE_CONNECTION=redis

# ==================== CACHE ====================
CACHE_STORE=redis
CACHE_PREFIX=exitem_prod_

# ==================== REDIS ====================
MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=your-redis-host.com
REDIS_PASSWORD=secure-redis-password
REDIS_PORT=6379

# ==================== MAIL ====================
MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_FROM_ADDRESS="noreply@exitem.com"
MAIL_FROM_NAME="Exitem"

# ==================== AWS S3 ====================
AWS_ACCESS_KEY_ID=your-aws-key
AWS_SECRET_ACCESS_KEY=your-aws-secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
AWS_USE_PATH_STYLE_ENDPOINT=false

# ==================== VITE ====================
VITE_APP_NAME="${APP_NAME}"
```

---

## 📚 Penjelasan Setiap Variabel

### 🎯 APPLICATION SETTINGS

| Variabel | Default | Penjelasan | Kapan Ubah |
|---|---|---|---|
| `APP_NAME` | Laravel | Nama aplikasi yang ditampilkan di berbagai tempat | Development |
| `APP_ENV` | local | Environment: `local`, `staging`, `production` | Saat deploy |
| `APP_DEBUG` | true | Tampilkan debug info jika ada error | Set `false` di production |
| `APP_URL` | http://localhost:8000 | URL aplikasi untuk generate links | Saat deploy |
| `APP_KEY` | - | Encryption key (auto-generate via artisan) | Jangan ubah manual |
| `BCRYPT_ROUNDS` | 12 | Rounds untuk password hashing (semakin tinggi = semakin aman tapi lambat) | Jarang perlu ubah |

**Contoh ubahan:**
```env
# Development
APP_NAME=Exitem
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Production
APP_NAME=Exitem
APP_ENV=production
APP_DEBUG=false
APP_URL=https://exitem.com
```

---

### 🌍 LOCALIZATION

| Variabel | Default | Penjelasan | Opsi |
|---|---|---|---|
| `APP_LOCALE` | en | Bahasa default aplikasi | `en`, `id`, `fr`, `de`, dll |
| `APP_FALLBACK_LOCALE` | en | Fallback jika translation tidak ada | `en`, `id`, `fr`, `de`, dll |
| `APP_FAKER_LOCALE` | en_US | Locale untuk fake data | `en_US`, `id_ID`, `fr_FR`, dll |

**Contoh untuk Indonesia:**
```env
APP_LOCALE=id
APP_FALLBACK_LOCALE=id
APP_FAKER_LOCALE=id_ID
```

---

### 🗄️ DATABASE CONFIGURATION

⚠️ **PENTING**: Database HARUS sudah dibuat sebelum migration!

| Variabel | Default | Penjelasan | Contoh |
|---|---|---|---|
| `DB_CONNECTION` | mysql | Database driver | `mysql`, `sqlite`, `pgsql` |
| `DB_HOST` | 127.0.0.1 | Host database | `localhost`, `192.168.1.100` |
| `DB_PORT` | 3306 | Port database | `3306` (MySQL), `5432` (PostgreSQL) |
| `DB_DATABASE` | exitem | Nama database | `exitem`, `exitem_prod` |
| `DB_USERNAME` | root | Username database | `root`, `exitem_user` |
| `DB_PASSWORD` | p455w0rd | Password database | Password MySQL Anda |

**Buat database di MySQL:**
```sql
CREATE DATABASE exitem;
-- Verifikasi
SHOW DATABASES;
```

**Contoh berbagai database:**
```env
# MySQL Local
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=exitem
DB_USERNAME=root
DB_PASSWORD=

# MySQL Remote
DB_CONNECTION=mysql
DB_HOST=db.yourserver.com
DB_PORT=3306
DB_DATABASE=exitem_prod
DB_USERNAME=exitem_user
DB_PASSWORD=SecurePassword123!

# PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=exitem
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

---

### 📝 LOGGING & CACHING

| Variabel | Development | Production | Penjelasan |
|---|---|---|---|
| `LOG_CHANNEL` | stack | stack | Channel untuk logging |
| `LOG_STACK` | single | daily | Stack type: `single` atau `daily` |
| `LOG_LEVEL` | debug | warning | Level: `debug`, `info`, `notice`, `warning`, `error` |
| `CACHE_STORE` | database | redis | Cache driver: `file`, `database`, `redis` |

**Development:**
```env
LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=debug
CACHE_STORE=database
```

**Production:**
```env
LOG_CHANNEL=stack
LOG_STACK=daily
LOG_LEVEL=warning
CACHE_STORE=redis
```

---

### 📧 SESSION CONFIGURATION

| Variabel | Development | Production | Penjelasan |
|---|---|---|---|
| `SESSION_DRIVER` | database | database | Driver: `file`, `cookie`, `database`, `redis` |
| `SESSION_LIFETIME` | 120 | 1440 | Durasi session dalam menit |
| `SESSION_ENCRYPT` | false | true | Encrypt session data? |
| `SESSION_DOMAIN` | null | .yoursite.com | Domain cookie session |

**Development:**
```env
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
```

**Production:**
```env
SESSION_DRIVER=redis
SESSION_LIFETIME=1440
SESSION_ENCRYPT=true
SESSION_PATH=/
SESSION_DOMAIN=.exitem.com
```

---

### 📦 FILE STORAGE

| Variabel | Penjelasan | Opsi |
|---|---|---|
| `FILESYSTEM_DISK` | Disk untuk upload files | `public`, `local`, `s3` |

**Menggunakan public storage:**
```env
FILESYSTEM_DISK=public
# Files disimpan di: storage/app/public/
# Akses via: http://localhost:8000/storage/filename
```

**Menggunakan S3:**
```env
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your-key
AWS_SECRET_ACCESS_KEY=your-secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket
```

---

### 📧 MAIL CONFIGURATION

**Development (Log emails ke file):**
```env
MAIL_MAILER=log
# Emails akan disimpan di: storage/logs/laravel.log
```

**Production (SMTP):**
```env
MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS=noreply@exitem.com
MAIL_FROM_NAME=Exitem
```

**Konfigurasi Provider Populer:**

**Gmail:**
```env
MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password  # Generate di Security Settings
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME=Exitem
```

**Mailtrap (Testing):**
```env
MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=hello@exitem.com
MAIL_FROM_NAME=Exitem
```

**Mailgun:**
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=mg.yoursite.com
MAILGUN_SECRET=mg-your-secret
MAIL_FROM_ADDRESS=hello@exitem.com
MAIL_FROM_NAME=Exitem
```

---

### 🔄 QUEUE CONFIGURATION

| Driver | Development | Production | Penjelasan |
|---|---|---|---|
| `database` | ✅ | ❌ | Menyimpan jobs di database (lambat) |
| `redis` | ❌ | ✅ | Menyimpan jobs di Redis (cepat) |
| `sqs` | ❌ | ✅ | AWS SQS (managed service) |

**Development:**
```env
QUEUE_CONNECTION=database
# Run: php artisan queue:work
```

**Production:**
```env
QUEUE_CONNECTION=redis
# Run: php artisan queue:work --daemon
```

---

### 💾 BROADCAST CONFIGURATION

| Driver | Penjelasan | Kapan Gunakan |
|---|---|---|
| `log` | Log ke file (testing) | Development |
| `redis` | Real-time broadcasting | Production |
| `pusher` | Third-party service | Real-time features |

```env
# Development
BROADCAST_CONNECTION=log

# Production
BROADCAST_CONNECTION=redis
```

---

### 🔐 REDIS CONFIGURATION (Optional)

Digunakan untuk caching, queue, session yang lebih cepat.

```env
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Production
REDIS_HOST=redis.yourserver.com
REDIS_PASSWORD=secure-redis-password
REDIS_PORT=6379
```

---

### ☁️ AWS S3 CONFIGURATION (Optional)

Untuk menyimpan files di AWS S3 instead of local storage.

```env
AWS_ACCESS_KEY_ID=AKIAIOSFODNN7EXAMPLE
AWS_SECRET_ACCESS_KEY=wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=my-app-bucket
AWS_USE_PATH_STYLE_ENDPOINT=false
```

---

## ⚡ Quick Setup Commands

```bash
# 1. Copy .env dari .env.example
cp .env.example .env

# 2. Generate APP_KEY
php artisan key:generate

# 3. Create database
mysql -u root -p -e "CREATE DATABASE exitem;"

# 4. Run migrations
php artisan migrate

# 5. Start development server
php artisan serve
```

---

## ⚠️ Penting: Keamanan

### DO:
- ✅ Ubah `APP_DEBUG=false` di production
- ✅ Gunakan password yang kuat untuk database
- ✅ Gunakan `.gitignore` untuk file `.env`
- ✅ Generate `APP_KEY` baru untuk setiap deployment
- ✅ Gunakan environment variables untuk secrets

### DON'T:
- ❌ Commit `.env` ke repository
- ❌ Gunakan default passwords
- ❌ Expose sensitive data di logs
- ❌ Ubah `APP_KEY` setelah ada user (akan merusak session)
- ❌ Set `APP_DEBUG=true` di production

---

## 🔍 Verify .env Configuration

Jalankan command ini untuk verify setup:

```bash
# Check app status
php artisan about

# Check database connection
php artisan tinker
# Kemudian di Tinker:
DB::connection()->getPdo();
// Output: PDOStatement jika berhasil

exit
```

---

## 📞 Troubleshooting .env

**Error: "No application encryption key"**
```bash
php artisan key:generate
```

**Error: "Access denied for database"**
- Check `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`
- Pastikan MySQL service sudah jalan

**Error: "Unknown database"**
```sql
CREATE DATABASE exitem;
```

**Variables tidak terbaca di application**
```bash
# Clear config cache
php artisan config:clear

# Restart server
php artisan serve
```

---

**Last Updated**: May 2026
