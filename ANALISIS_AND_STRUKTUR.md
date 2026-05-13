# Analisis Proyek & Struktur Admin Panel

Dokumen ini berisi analisis lengkap tentang teknologi yang digunakan, struktur proyek, serta penjelasan langkah demi langkah tentang bagaimana admin panel dan sistem manajemen *user/role* dibangun dalam proyek ini.

## 1. Teknologi Utama yang Digunakan (Tech Stack)

Berdasarkan pengecekan konfigurasi `composer.json` dan struktur file, proyek ini menggunakan *stack* teknologi modern dalam ekosistem Laravel:

- **Laravel Framework (v12.0)**: Sebagai *core framework* *backend*.
- **PHP (v8.2+)**: Bahasa pemrograman utama.
- **Filament (v5.0)**: Digunakan sebagai *framework* utama untuk membangun Admin Panel yang cantik dan reaktif.
- **Livewire (v4.1) & Livewire Volt**: Menangani komponen reaktif di sisi server tanpa memerlukan konfigurasi JavaScript yang rumit.
- **Tailwind CSS (v4)**: Digunakan (secara bawaan oleh Filament) untuk penataan gaya visual UI yang rapi dan seragam.
- **Pest PHP**: *Framework* pengujian modern yang digunakan untuk *testing* proyek.

---

## 2. Struktur Proyek Terkait Admin Panel

Berikut adalah struktur direktori utama yang menggerakkan Admin Panel:

```text
app/
├── Filament/
│   ├── Pages/         # Halaman custom untuk Filament (contoh: Edit Profile)
│   ├── Resources/     # CRUD utama untuk mengelola data
│   │   ├── Banners/      # [NEW] Manajemen Hero Banner & Slider
│   │   ├── Brands/       # Manajemen Merek
│   │   ├── Categories/   # Manajemen Kategori
│   │   ├── Products/     # Manajemen Produk
│   │   ├── Transactions/ # Manajemen Transaksi
│   │   └── Users/        # Manajemen Pengguna (User) & Role
│   └── Widgets/       # Komponen statistik pada halaman Dashboard (IncomeChart, StatsOverview)
├── Models/
│   ├── Banner.php     # [NEW] Model untuk Hero Section / Slider
│   ├── User.php       # Model User (Role & Filament contracts)
│   └── ...            # Model lainnya (Product, Brand, Transaction, etc.)
└── Providers/
    └── Filament/
        └── AdminPanelProvider.php # Konfigurasi utama Admin Panel
```

---

## 3. Manajemen Banner & Hero Section (Slider)

Bagian *Hero Section* pada halaman utama kini telah sepenuhnya dinamis dan dapat dikelola melalui Admin Panel.

### Fitur Utama:
- **Slider Otomatis**: Menggunakan **Swiper.js** untuk merotasi banner promosi secara otomatis di halaman depan.
- **Relasi Produk**: Setiap banner dapat dihubungkan langsung ke produk tertentu. Tombol "Shop Now" akan secara otomatis mengarahkan pengunjung ke halaman detail produk yang dipilih.
- **Urutan Fleksibel (Reordering)**: Admin dapat mengubah urutan tampilan banner dengan fitur *drag-and-drop* di tabel Filament.
- **Ikon Brand**: Mendukung pengunggahan logo/ikon brand khusus untuk setiap banner dalam bentuk gambar.

### Struktur Data Banner:
- `brand_name`: Nama merk (contoh: iPhone 14 Series).
- `brand_icon`: Logo kecil brand (unggah gambar).
- `title`: Judul besar promosi (mendukung HTML/line break).
- `product_id`: Menghubungkan banner ke detail produk.
- `image`: Gambar latar belakang/produk utama banner.
- `is_active`: Mengontrol apakah banner muncul di slider atau tidak.

---

## 4. Cara Pembuatan Sistem User & Role

Alih-alih menggunakan *package* eksternal seperti Spatie Permission, proyek ini membangun sistem Role *custom* yang ringan dan efisien menggunakan relasi *Many-to-Many*.

### Langkah 1: Pembuatan Model dan Migrasi Role
- Dibuat Model `Role` (`app/Models/Role.php`) yang memiliki field `name`, `display_name`, dan `guard_name`.
- Dibuat *pivot table* `role_user` di *database* untuk menghubungkan tabel `users` dengan tabel `roles`.

### Langkah 2: Konfigurasi Relasi di Model User
Pada `app/Models/User.php`, ditambahkan relasi `belongsToMany` ke model `Role`:

```php
public function roles(): BelongsToMany
{
    return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
}
```

### Langkah 3: Membatasi Akses ke Admin Panel (Security)
Filament mewajibkan pengamanan panel agar tidak semua orang bisa login. Di `app/Models/User.php`, dilakukan implementasi *interface* `FilamentUser` dan ditambahkan method `canAccessPanel`:

```php
public function canAccessPanel(Panel $panel): bool
{
    // Hanya user dengan role 'super-admin' atau 'admin' yang bisa masuk panel
    return $this->hasRole('super-admin') || $this->hasRole('admin');
}
```

---

## 5. Dinamisasi Halaman Depan (Landing Page)

Halaman utama (`resources/views/front/index.blade.php`) telah dibuat dinamis agar konten selalu sinkron dengan data di Admin Panel:

- **New Arrival**: Bagian ini akan otomatis menampilkan **3 produk terbaru** yang baru saja ditambahkan ke database.
- **Hero Slider**: Menampilkan semua banner aktif yang diatur di menu Banners.
- **Product & Category**: List produk dan kategori diambil langsung dari tabel terkait.

---

## 6. Optimasi Database & Migrasi

Untuk menjaga kebersihan kode dan performa pengembangan, semua migrasi database telah **dioptimasi (squashed)**:

1. **Konsolidasi Perubahan**: Perubahan pada tabel `users` (seperti penambahan `avatar_url`) dan tabel `banners` telah digabungkan langsung ke dalam migrasi awal pembuatannya.
2. **Penghapusan Redundansi**: File migrasi "kecil" yang hanya berisi perubahan kolom (seperti `add_is_admin` atau `alter_banners`) telah dihapus untuk mengurangi jumlah file dan mempermudah pelacakan skema database.
3. **Hasil Akhir**: Database memiliki skema yang bersih dan linear, memudahkan developer baru untuk memahami struktur tabel hanya dari file migrasi utamanya.
   *Catatan: Setelah optimasi ini, disarankan menjalankan `php artisan migrate:fresh` untuk menyinkronkan status database.*

---

## Kesimpulan

Sistem Admin Panel pada Exitem dibangun secara modern menggunakan **Filament v5** di atas **Laravel 12**. 
Alih-alih bergantung pada pihak ketiga untuk hak akses, manajemen peran pengguna (Role) dibangun secara *native* menggunakan fitur relasi bawaan Eloquent Laravel. Hal ini menjadikan kode lebih bersih, mudah di-maintenance, dan sangat terintegrasi dengan arsitektur UI berbasis komponen milik Filament. Ditambah dengan fitur banner dinamis dan slider otomatis, Exitem siap digunakan sebagai platform e-commerce yang fleksibel.
