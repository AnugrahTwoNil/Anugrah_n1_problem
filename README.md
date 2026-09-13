# LKPD: Optimasi N+1 Query pada Laravel

## Identitas Peserta

- Nama: ........................................................
- Kelas: ........................................................
- Tanggal pengumpulan: ...........................................

## Tujuan Pembelajaran

Setelah menyelesaikan tugas ini, siswa mampu:

1. Mengidentifikasi pola N+1 query pada relasi Eloquent.
2. Menganalisis jumlah query yang terjadi pada sebuah halaman Laravel.
3. Mengoptimalkan pengambilan data relasional tanpa mengubah hasil tampilan.
4. Membuktikan hasil optimasi melalui pengujian.

## Gambaran Project

Project ini adalah blog bernama **N+1 Lab** yang sengaja dibuat tidak efisien. Data yang tersedia meliputi:

- 25 user
- 8 kategori
- 20 tag
- 800 post
- 2.000 komentar
- Relasi post dengan author, category, tag, dan comment

Halaman latihan:

| Halaman | URL | Fokus |
| --- | --- | --- |
| Latihan 01 | `/posts` | Relasi author pada daftar post |
| Latihan 02 | `/posts-report` | Relasi author, category, tag, dan comment |

Badge merah pada tiap halaman menunjukkan jumlah query yang dijalankan. Nilainya sengaja tinggi.

## Persiapan

Jalankan perintah berikut dari root project:

```bash
composer install
npm install
php artisan migrate:fresh --seed
npm run build
php artisan serve
```

Buka aplikasi pada alamat yang ditampilkan oleh Laravel, lalu akses halaman `/posts` dan `/posts-report`.

## Laravel Debugbar

Gunakan Laravel Debugbar untuk melihat daftar query pada setiap halaman. Instal terlebih dahulu pada branch pengerjaan:

```bash
composer require barryvdh/laravel-debugbar --dev
```

Setelah aplikasi dibuka, pilih panel **Queries** pada Debugbar. Gunakan panel tersebut untuk membandingkan jumlah dan pola query sebelum dan setelah optimasi.

## Tugas Siswa

### Tugas 1: Analisis Awal

1. Buka halaman `/posts`.
2. Catat jumlah query pada badge merah dan panel **Queries** Laravel Debugbar.
3. Temukan model, controller, dan view yang terlibat dalam halaman tersebut.
4. Jelaskan mengapa jumlah query meningkat ketika jumlah post bertambah.

### Tugas 2: Optimasi Daftar Post

1. Optimalkan halaman `/posts` agar jumlah query berkurang signifikan.
2. Tampilan artikel, nama author, pagination, dan data yang ditampilkan harus tetap sama.
3. Catat jumlah query sebelum dan setelah optimasi menggunakan Laravel Debugbar.

### Tugas 3: Optimasi Laporan Relasi

1. Buka halaman `/posts-report`.
2. Identifikasi semua relasi yang diakses pada setiap post.
3. Optimalkan halaman tersebut agar jumlah query berkurang signifikan.
4. Data author, kategori, tag, dan jumlah komentar harus tetap tampil benar.
5. Catat jumlah query sebelum dan setelah optimasi menggunakan Laravel Debugbar.

### Tugas 4: Pengujian

1. Perbarui atau tambahkan feature test yang relevan.
2. Jalankan test dengan perintah berikut:

```bash
php artisan test --compact
```

3. Pastikan test berhasil dan jumlah query pada halaman yang dioptimalkan berada di bawah batas yang masuk akal.

## Batasan Pengerjaan

- Jangan menghapus relasi model, data seeder, halaman, atau badge query.
- Jangan mengurangi jumlah data seeder untuk membuat angka query terlihat kecil.
- Jangan mengubah tampilan atau menghapus informasi relasi dari halaman.
- Fokus perbaikan hanya pada cara data relasional diambil.
- Jangan menonaktifkan query counter atau memalsukan nilainya.

## Kriteria Keberhasilan

| Kriteria | Bobot |
| --- | ---: |
| Analisis penyebab N+1 query benar | 25% |
| Optimasi halaman `/posts` berhasil | 25% |
| Optimasi halaman `/posts-report` berhasil | 30% |
| Test berjalan dan perubahan kode rapi | 20% |

Optimasi dinilai berhasil apabila jumlah query turun nyata dibanding kondisi awal, seluruh relasi tetap tampil, dan test proyek lulus.

## Pengumpulan

Buat branch baru dengan format berikut, menggunakan nama siswa dalam huruf kecil:

```text
nama_n1_problem
```

Contoh untuk siswa bernama Budi Santoso:

```bash
git checkout -b budi_santoso_n1_problem
```

Commit seluruh perubahan tugas ke branch tersebut, lalu push ke repository remote:

```bash
git add .
git commit -m "Selesaikan optimasi N+1 query"
git push -u origin nama_n1_problem
```

Sertakan file `LAPORAN.md` atau `LAPORAN.pdf` di branch pengumpulan yang berisi:

1. Nama dan kelas.
2. Penjelasan singkat penyebab N+1 pada kedua halaman.
3. File serta bagian kode yang diubah.
4. Jumlah query sebelum dan sesudah optimasi untuk setiap halaman.
5. Screenshot panel **Queries** Laravel Debugbar sebelum dan sesudah optimasi.
6. Screenshot atau hasil perintah `php artisan test --compact`.

Pastikan migration dan seeder dapat dijalankan kembali dengan:

```bash
php artisan migrate:fresh --seed
```

Kirimkan tautan branch `nama_n1_problem` melalui media pengumpulan yang ditentukan guru sebelum batas waktu.

## Refleksi

Jawab pertanyaan berikut pada laporan:

1. Apa perbedaan jumlah query sebelum dan sesudah optimasi?
2. Mengapa masalah N+1 lebih berbahaya ketika data bertambah banyak?
3. Kapan relasi perlu diambil sejak awal, dan kapan tidak diperlukan?