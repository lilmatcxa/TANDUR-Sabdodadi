# TANDUR - Tata Lahan dan Data Urun Rancang
Sistem Informasi Geografis Pertanian Berbasis Web untuk Desa Sabdodadi, Bantul

## 📌 Deskripsi

**TANDUR** adalah sebuah proyek Sistem Informasi Geografis (SIG) berbasis web yang dibangun dengan Laravel dan PostgreSQL (PostGIS) untuk membantu pengelolaan lahan, data pertanian, dan sistem informasi petani di Desa Sabdodadi. Proyek ini dibuat sebagai latihan penerapan teknologi spasial dan pengembangan web modern untuk pertanian.

---

## 🎯 Tujuan dan Manfaat

* Memberikan **visualisasi spasial** lahan, tanaman, dan sistem perairan.
* Menyediakan **informasi statistik terkini** seputar pertanian desa.
* Memungkinkan **pendaftaran petani** dan pengelolaan musim tanam.
* Menjadi **platform kolaboratif** antara petani dan pengelola desa.

---

## 🧭 Alur Penggunaan TANDUR

1. **Pengunjung** membuka halaman utama dengan animasi dan informasi dasar.
2. **Petani** dapat mendaftar dan login untuk mengakses dashboard.
3. Di **dashboard**, pengguna melihat peta interaktif:

   * Polygon: lahan pertanian
   * Polyline: jalur perairan
   * Point: jenis tanaman
4. Pengguna bisa **menambah, mengedit, atau menghapus** data spasial dan atribut.
5. Terdapat juga fitur **kalender tanam**, cuaca real-time, dan statistik pertanian.

---

## 🗂️ Fitur Utama

### 🌾 1. Manajemen Lahan Pertanian (Polygon)

* Tambah/edit bentuk dan data lahan
* Hitung luas otomatis (dalam hektar)

### 💧 2. Sistem Perairan (Polyline)

* Catat jalur irigasi yang aktif

### 🌱 3. Jenis Tanaman (Point)

* Data jenis tanaman yang ditanam per lokasi

### 📊 4. Dashboard Statistik

* Menampilkan jumlah RT, lahan, petani, tanaman, dan perairan

### 👨‍🌾 5. Manajemen Petani

* Registrasi & login petani
* Setiap petani punya data musim tanam sendiri

### 🌤️ 6. Cuaca Real-Time

* Terintegrasi dengan OpenWeather API

### 🛰️ 7. Layer Tambahan

* NDVI & Citra Satelit
* Batas Administrasi Sabdodadi

---

## 🛠️ Teknologi yang Digunakan

| Komponen    | Teknologi                       |
| ----------- | ------------------------------- |
| Backend     | Laravel 10.x                    |
| Frontend    | Blade, Tailwind CSS, Leaflet.js |
| Database    | PostgreSQL + PostGIS            |
| Geo Tools   | GeoJSON, WKT, Terraformer       |
| Cuaca API   | OpenWeatherMap                  |
| UI Animasi  | LottiePlayer, AOS Animation     |
| File Upload | Laravel Storage (local image)   |

---

## 🚀 Instalasi & Setup Lokal

### 1. Clone Repo

```bash
git clone https://github.com/lilmatcxa/TANDUR_Zidni-Anasa-Ni-Da-i_518936.git
cd TANDUR_Zidni-Anasa-Ni-Da-i_518936
```

### 2. Install Dependency

```bash
composer install
npm install && npm run dev
```

### 3. Setup .env

Salin file `.env.example` ke `.env` dan sesuaikan:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=AgriMap
DB_USERNAME=postgres
DB_PASSWORD=admin
OPENWEATHER_API_KEY= (sesuai kode log in)
```

### 4. Migrasi Database

```bash
php artisan migrate
```

### 5. Jalankan Aplikasi

```bash
php artisan serve
```

---

## 🙌 Kontribusi

Proyek ini dibuat sebagai bagian dari responsi mata kuliah Praktikum Pemrograman Geospasial: Web Lanjut SIG.

---

Terima kasih telah menggunakan **TANDUR** 🌿
