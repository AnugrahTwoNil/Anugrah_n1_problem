# PRD Mini: Demo N+1 Problem - Blog Laravel

## Tujuan

Membangun aplikasi blog Laravel yang secara sengaja mendemonstrasikan N+1 query problem, lalu membandingkannya dengan eager loading (`with()`). UI menampilkan jumlah query dan total durasi request agar dampaknya terlihat langsung.

## Model dan Relasi

| Model | Relasi |
| --- | --- |
| `User` | Penulis untuk `Post` dan `Comment` |
| `Category` | Memiliki banyak `Post` |
| `Post` | Milik `User` dan `Category`, memiliki banyak `Comment`, dan memiliki banyak `Tag` |
| `Tag` | Memiliki banyak `Post` |
| `Comment` | Milik `Post` dan `User` |

Migration yang diperlukan: `categories`, `posts`, `tags`, `post_tag`, dan `comments`.

## Data Seeder

- 8 kategori
- 25 user sebagai penulis dan pemberi komentar
- 20 tag
- 800 post, masing-masing berelasi dengan satu user dan satu kategori
- Sekitar 2.000 komentar, terutama pada 200 post pertama
- Setiap post memiliki 1 sampai 4 tag acak

## Halaman Demo

### Daftar Post: `/posts`

- Menampilkan daftar post dengan pagination.
- Menampilkan nama author untuk setiap post.
- Mode N+1 menggunakan `Post::latest()->paginate(20)` dan mengakses `$post->user->name` pada view.
- Mode optimal menggunakan `Post::with('user')->latest()->paginate(20)`.
- Peralihan mode menggunakan parameter `?optimized=1` atau toggle pada antarmuka.

### Laporan Relasi: `/posts-report`

- Menampilkan 200 post.
- Menampilkan author, category, daftar tag, dan jumlah komentar.
- Mode N+1 tidak menggunakan eager loading sehingga relasi `user`, `category`, `tags`, dan `comments` menghasilkan query berulang.
- Mode optimal menggunakan `Post::with(['user', 'category', 'tags'])->withCount('comments')->limit(200)->get()`.

## Query Counter

- Middleware atau service berbasis `DB::listen()` menghitung jumlah query dan total waktu query per request.
- Ringkasan ditampilkan sebagai badge sticky pada halaman.
- Contoh perbandingan: `Queries: 823 | 145 ms` untuk mode N+1 dan `Queries: 3 | 4 ms` untuk mode optimal.

## Antarmuka

- Menggunakan Tailwind CSS v4 yang sudah tersedia.
- Menambahkan Flowbite untuk navbar, card, badge, pagination, dan toggle switch.
- Struktur Blade: layout utama, komponen badge query, halaman daftar post, dan halaman laporan relasi.

## File yang Direncanakan

```text
app/Models/Category.php
app/Models/Post.php
app/Models/Tag.php
app/Models/Comment.php
app/Http/Controllers/PostController.php
app/Http/Middleware/QueryCounter.php
database/factories/CategoryFactory.php
database/factories/PostFactory.php
database/factories/TagFactory.php
database/factories/CommentFactory.php
database/migrations/*_create_categories_table.php
database/migrations/*_create_posts_table.php
database/migrations/*_create_tags_table.php
database/migrations/*_create_post_tag_table.php
database/migrations/*_create_comments_table.php
database/seeders/CategorySeeder.php
database/seeders/PostSeeder.php
database/seeders/TagSeeder.php
database/seeders/CommentSeeder.php
resources/views/layouts/app.blade.php
resources/views/components/query-badge.blade.php
resources/views/posts/index.blade.php
resources/views/posts/report.blade.php
routes/web.php
tests/Feature/PostN1Test.php
```

## Pengujian

- Feature test membandingkan jumlah query mode N+1 dan mode optimal.
- Mode optimal harus berada di bawah ambang query yang ditetapkan.
- Factory dan seeder harus dapat menghasilkan relasi data tanpa error.

## Urutan Implementasi

1. Menambahkan Flowbite dan menyiapkan layout dasar.
2. Membuat migration, model, dan seluruh relasi Eloquent.
3. Membuat factory dan seeder untuk data demo.
4. Membuat controller dan route untuk dua halaman demo.
5. Menambahkan query counter.
6. Membuat antarmuka Blade dengan toggle perbandingan mode.
7. Menambahkan feature test.
8. Menjalankan migration, seeder, test, dan Laravel Pint.