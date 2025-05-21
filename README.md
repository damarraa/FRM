# 📦 Form Retur MDU (FRM) - PT PLN UID Riau dan Kepulauan Riau

Sistem **Form Retur MDU (FRM)** adalah aplikasi berbasis web (Progressive Web App) yang dikembangkan untuk mendukung pencatatan dan monitoring pengembalian material distribusi oleh petugas di lingkungan **PT PLN UID Riau dan Kepulauan Riau**. Aplikasi ini mempermudah proses pelaporan, validasi, dan pengelolaan data material yang dikembalikan dari lapangan ke gudang.

---

## 🧭 Tujuan Proyek

Menyediakan sistem pencatatan digital yang efisien, terstruktur, dan mudah digunakan untuk memantau proses **retur material distribusi (MDU)** seperti:

- kWh Meter
- MCB
- Kotak APP
- Cable Power
- Konduktor
- Trafo Distribusi
- Lightning Arrester
- Fuse Cut Out
- Isolator
- Cubicle
- PHBTR
- Current Transformer
- Potential Transformer
- Load Break Switch
- Tiang Listrik

---

## 👥 Pengguna Sistem

| Role         | Akses                                                                 |
|--------------|-----------------------------------------------------------------------|
| **Admin**     | Akses penuh ke seluruh sistem, termasuk manajemen pengguna & data.   |
| **PIC Gudang**| Melihat form retur dari petugas yang berada di bawah penempatan gudang. |
| **Petugas**   | Submit form retur material ke sistem, lengkap dengan validasi.       |

---

## 🛠️ Teknologi yang Digunakan

- **Laravel 11** (Fullstack Blade)
- **Tailwind CSS** (default Laravel preset)
- **Laravel Breeze** (Autentikasi)
- **Spatie Laravel Permission**
- **MySQL** (Database)
- **Progressive Web App (PWA)** support

---

## ✨ Fitur Utama

- ✅ Autentikasi Login & Role-Based Access Control (Admin, PIC, Petugas)
- 📄 Form input retur hingga 15 jenis material
- 🔍 Validasi form otomatis
- 📜 Riwayat retur berdasarkan user dan penempatan
- 👤 Edit Profil
- 👥 Manajemen pengguna (aktif/nonaktif, penempatan)
- 📊 Export laporan ke PDF & Excel
- 📱 Progressive Web App (installable)

---

## 🚀 Cara Instalasi

```bash
git clone https://github.com/damarraa/FRM.git
cd frm
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run build
php artisan serve
```
---

## 🔒 Lisensi
Proyek ini merupakan properti internal milik PT PLN (Persero) dan dikembangkan secara eksklusif oleh PT Prisan Artha Lestari. Segala bentuk penggunaan, distribusi ulang, atau pengembangan ulang di luar lingkup kerja sama resmi dilarang tanpa izin tertulis.

---

## 👨‍💻 Tim Pengembang
Proyek ini dikembangkan oleh Tim IT PT Prisan Artha Lestari.
Untuk informasi teknis, pelaporan bug, atau dukungan terkait sistem, silakan hubungi:

PT Prisan Artha Lestari
Jl. Tanjung Datuk No.145 A, Pesisir, Kec. Lima Puluh, Kota Pekanbaru, Riau 28155
Pekanbaru, Riau – Indonesia
📞 Telepon: (0761) 25494
✉️ Email: teknisi_it@prisan.co.id
