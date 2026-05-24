# Sistem Presensi Sekolah — Laravel 10

Aplikasi web presensi siswa berbasis Laravel 10 untuk tugas akhir SMK. Mendukung manajemen data guru, siswa, kelas, mata pelajaran, jurusan, dan absensi dengan role-based access control.

---

## Tech Stack

- **Laravel 10**
- **PHP 8.x**
- **MySQL**
- **Bootstrap 5** + SB Admin template
- **Blade Templating Engine**
- **Laravel Auth** (session-based)
- **Maatwebsite Excel** — import data siswa
- **Carbon** — manipulasi tanggal

---

## Fitur Utama

- Login/logout dengan autentikasi Laravel
- Role-based access control via `$this->authorize()`
- Dashboard dengan statistik jumlah siswa, guru, kelas, mapel, dan jurusan
- CRUD Guru, Siswa, Kelas, Jurusan, Mata Pelajaran
- Presensi siswa per kelas per mata pelajaran
- Filter presensi berdasarkan tanggal & mata pelajaran
- Rekap kehadiran (Hadir / Izin / Sakit / Alpha)
- Laporan/export presensi
- Import data siswa via Excel

---

## Struktur Folder Penting

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   │   └── LoginController.php
│   │   ├── DashboardController.php
│   │   ├── GuruController.php
│   │   ├── JurusanController.php
│   │   ├── KelasController.php
│   │   ├── MapelController.php
│   │   ├── SiswaController.php
│   │   ├── AbsenController.php
│   │   └── PresensiController.php
│   └── Requests/
│       ├── LoginRequest.php
│       ├── GuruStoreRequest.php
│       ├── UpdateGuruRequest.php
│       ├── JurusanRequest.php
│       ├── UpdateJurusanRequest.php
│       ├── KelasRequest.php
│       ├── UpdateKelasRequest.php
│       ├── MapelRequest.php
│       ├── UpdateMapelRequest.php
│       ├── StorePostRequest.php       (Siswa)
│       ├── UpdatePostRequest.php      (Siswa)
│       ├── AbsenRequest.php
│       └── AbsenUpdateRequest.php
├── Imports/
│   └── SiswaImport.php
└── Models/
    ├── User.php
    ├── Guru.php
    ├── Siswa.php
    ├── Kelas.php
    ├── Jurusan.php
    ├── Mapel.php
    └── Absen.php

resources/views/
├── layouts/
│   └── main.blade.php
├── Login/
│   └── login.blade.php
├── dashboard/
│   └── jumlah.blade.php
├── gurus/
│   ├── read.blade.php
│   ├── createGuru.blade.php
│   └── editGuru.blade.php
├── siswas/
│   ├── create.blade.php
│   └── edit.blade.php
├── Kelas/
│   ├── table.blade.php
│   ├── show.blade.php
│   ├── createK.blade.php
│   └── editK.blade.php
├── Jurusan/
│   ├── createj.blade.php
│   └── editj.blade.php
├── Mapel/
│   ├── view.blade.php
│   ├── createM.blade.php
│   └── editM.blade.php
├── Presensi/
│   ├── menu.blade.php
│   ├── show.blade.php
│   ├── create.blade.php
│   └── update.blade.php
└── cetak/
    └── excel.blade.php
```

---

## Instalasi

```bash
# Clone project
git clone <repo-url>
cd <nama-project>

# Install dependencies
composer install

# Salin environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Konfigurasi database di .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=

# Jalankan migrasi dan seeder
php artisan migrate --seed

# Jalankan server
php artisan serve
```

---

## Database — Relasi Antar Tabel

```
users          → login admin/guru
jurusan        → id, jurusan
mapel          → id, mapel
guru           → id, nama, gender, kode_mapel, mapel_id (FK → mapel)
kelas          → id, kelas, kategory, jurusan_id (FK), guru_id (FK)
siswa          → id, nisn, nama, gender, kelas_id (FK → kelas)
absen          → id, siswa_id, kelas_id, mapel_id, waktu, status, deskripsi
```

---

## Routes

### Auth

| Method | URL | Controller | Keterangan |
|--------|-----|------------|------------|
| GET | `/` | `LoginController@Login` | Halaman login |
| POST | `/login_proses` | `LoginController@login_proses` | Proses login |
| GET | `/logout` | `LoginController@logout` | Logout |

### Dashboard

| Method | URL | Keterangan |
|--------|-----|------------|
| GET | `/dashboard` | Statistik jumlah data |

### Siswa

| Method | URL | Keterangan |
|--------|-----|------------|
| GET | `/siswas/create` | Form tambah siswa |
| POST | `/siswas/store` | Simpan siswa baru |
| GET | `/siswas/{id}/edit` | Form edit siswa |
| PUT | `/siswas/{id}/update` | Update data siswa |
| DELETE | `/siswas/{id}/delete` | Hapus siswa |

### Guru

| Method | URL | Keterangan |
|--------|-----|------------|
| GET | `/read` | Tabel data guru |
| GET | `/create` | Form tambah guru |
| POST | `/guru` | Simpan guru baru |
| GET | `/guru/{id}/edit` | Form edit guru |
| PUT | `/guru/{id}/update` | Update data guru |
| DELETE | `/guru/{id}/delete` | Hapus guru |

### Jurusan

| Method | URL | Keterangan |
|--------|-----|------------|
| GET | `/jurusan` | Tampil + form jurusan |
| POST | `/jurusan` | Simpan jurusan baru |
| GET | `/jurusan/{id}/edit` | Form edit jurusan |
| PUT | `/jurusan/{id}/update` | Update jurusan |
| DELETE | `/jurusan/{id}/delete` | Hapus jurusan |

### Kelas

| Method | URL | Keterangan |
|--------|-----|------------|
| GET | `/kelas` | Tabel kelas |
| GET | `/kelas/create` | Form tambah kelas |
| POST | `/kelas/store` | Simpan kelas baru |
| GET | `/kelas/{id}/show` | Detail siswa per kelas |
| GET | `/kelas/{id}/edit` | Form edit kelas |
| PUT | `/kelas/{id}/update` | Update kelas |
| DELETE | `/kelas/{id}/delete` | Hapus kelas |

### Mata Pelajaran

| Method | URL | Keterangan |
|--------|-----|------------|
| GET | `/mapel` | Tabel mapel |
| GET | `/mapel/create` | Form tambah mapel |
| POST | `/mapel/store` | Simpan mapel baru |
| GET | `/mapel/{id}/edit` | Form edit mapel |
| PUT | `/mapel/{id}/update` | Update mapel |
| DELETE | `/mapel/{id}/delete` | Hapus mapel |

### Absensi / Presensi

| Method | URL | Keterangan |
|--------|-----|------------|
| GET | `/absens` | Menu pilih kelas untuk presensi |
| GET | `/absens/{id}/kelas` | Lihat presensi hari ini per kelas |
| GET | `/absens/{id}/create` | Form input presensi kelas |
| POST | `/absens/store` | Simpan presensi |
| GET | `/absens/{id}/edit` | Form edit data presensi |
| PUT | `/absens/{id}/update` | Update presensi |
| POST | `/absens/delete` | Hapus satu / semua presensi per mapel & waktu |
| GET | `/absensi/{id}/filter` | Filter presensi per kelas (tanggal + mapel) |
| GET | `/absensi/laporan` | Halaman laporan/export presensi |
| GET | `/absensi/filter` | Filter laporan lintas kelas |

---

## Controllers

### LoginController
- `Login()` — tampilkan form login
- `login_proses(LoginRequest)` — validasi & proses `Auth::attempt()`
- `logout()` — `Auth::logout()` dan redirect ke login

### DashboardController
- `index()` — hitung jumlah Jurusan, Kelas, Siswa, Mapel, Guru → view `dashboard.jumlah`

### GuruController
- `read()` — paginate 10, with `mapel`; require `authorize('presensi')`
- `create()` — form tambah; require `authorize('create')`
- `store()` — cek duplikat `kode_mapel`, simpan guru
- `edit($id)` — require `authorize('edit')`
- `update()` — cek duplikat kode (exclude id sendiri)
- `destroy()` — require `authorize('delete')`

### SiswaController
- `create()` — ambil semua kelas, tampilkan form
- `store()` — cek duplikat NISN, simpan, redirect ke detail kelas
- `edit($id)` — form edit siswa
- `update()` — cek duplikat NISN (exclude id), update & redirect
- `destroy()` — hapus siswa, redirect ke detail kelas asal

### KelasController
- `index()` — paginate 3, with `jurusan` dan `guru`
- `create()` — ambil semua jurusan & guru
- `input()` — cek duplikat kombinasi `kelas + jurusan_id + kategory`
- `show($id)` — tampil daftar siswa per kelas (paginate 3)
- `update()` — cek duplikat (exclude id)
- `destroy()` — hapus kelas

### JurusanController
- `tampilanj()` — paginate 5 + form di satu view
- `storej()` — cek duplikat nama jurusan
- `updatej()` — update jurusan
- `destroyj()` — hapus jurusan

### MapelController
- `tampilanM()` — paginate 4
- `storeM()` — cek duplikat nama mapel
- `updateM()` — cek duplikat (exclude id)
- `destroyM()` — hapus mapel

### AbsenController
- `index()` — tampil menu pilih kelas (paginate 3)
- `show($id)` — absensi hari ini per kelas, with mapel
- `filter(Request, $id)` — filter by tanggal & mapel; hitung rekap Hadir/Izin/Sakit/Alpha per NISN
- `create($id)` — form input absen, daftar siswa paginate 10
- `store()` — cek duplikat, loop `siswa_id[]` → buat record `Absen` per siswa
- `edit($id)` — form edit satu record absen
- `update()` — cek duplikat (exclude id), update record
- `destroy()` — hapus satu record (by `id`) atau semua record (by `mapel_id + waktu`)

### PresensiController
- `cetak()` — laporan global, default tampil hari ini
- `filterP()` — filter by mapel, kelas, tanggal; rekap kehadiran per NISN jika filter lengkap

---

## Logic Filter & Rekap Kehadiran

Ketika filter menggunakan **mapel + tanggal_awal + tanggal_akhir** sekaligus, view menampilkan kolom rekap (Hadir, Izin, Sakit, Alpha) per siswa — satu baris per siswa (duplikat disaring dengan `$siswaCetak[$nisn]`).

Tanpa filter lengkap, view menampilkan detail baris per record absen beserta kolom Waktu, Status, Keterangan, dan tombol Aksi.

```php
// Hitung rekap di controller
foreach ($absensi as $absen) {
    $nisn = $absen->siswa->nisn;
    $jumlahKehadiran[$nisn]['hadir']++;  // atau izin/sakit/alpha
}
```

---

## Role & Otorisasi

Otorisasi menggunakan `$this->authorize('nama_policy')` di setiap controller. Policy yang digunakan:

| Policy Key | Siapa yang bisa |
|------------|-----------------|
| `presensi` | Semua user login |
| `create` | Admin / super admin |
| `edit` | Admin / super admin |
| `update` | Admin / super admin |
| `delete` | Admin / super admin |

Di blade, gunakan `@can('create') ... @endcan` untuk menyembunyikan tombol aksi dari user tanpa izin.

---

## Import Data Siswa (Excel)

Menggunakan package **Maatwebsite Excel**. Class `SiswaImport` membaca kolom:

| Index | Kolom |
|-------|-------|
| `[1]` | nisn |
| `[2]` | nama |
| `[3]` | gender |
| `[4]` | kelas_id |

---

## Validasi (Form Request)

Setiap form memiliki Form Request class tersendiri di `app/Http/Requests/`. Cek duplikat dilakukan di controller sebelum menyimpan untuk memberikan pesan error yang lebih informatif via `->with('eror', '...')`.

---

## Flash Message

| Key | Warna | Keterangan |
|-----|-------|------------|
| `success` | Hijau | Operasi berhasil |
| `eror` | Merah | Data duplikat / gagal |
| `failed` | Merah | Login gagal |

Tampilkan di Blade:
```blade
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('eror'))
    <div class="alert alert-danger">{{ session('eror') }}</div>
@endif
```

---

## Catatan Pengembangan

- Semua route dilindungi middleware `auth` kecuali halaman login.
- Redirect setelah operasi siswa mengarah ke `/kelas/{kelas_id}/show` (halaman detail kelas asal siswa).
- Redirect setelah operasi absen mengarah ke `/absens/{kelas_id}/kelas`.
- Field `hasil` di model `Kelas` adalah accessor/computed yang menggabungkan `kelas + jurusan + kategory`.
- Gunakan `Carbon::today()->toDateString()` sebagai default tanggal filter di halaman presensi dan laporan.
- Hapus presensi mendukung dua mode: hapus satu record (kirim `id`) atau hapus semua record dalam satu sesi mapel+waktu (kirim `mapel_id + waktu`).
