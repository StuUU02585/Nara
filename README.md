# Sistem Informasi Sahabat Nara

Sistem ini disiapkan untuk kebutuhan website profil dan pendaftaran program Nara-HR/Sahabat Nara dengan pola folder CodeIgniter 3.

## Alur Utama

1. Pengunjung melihat program training, in-house training, sertifikasi, konsultansi, trainer, dan artikel.
2. Peserta mengisi form pendaftaran.
3. Data pendaftaran masuk ke dashboard admin.
4. Admin menghubungi peserta via WhatsApp.
5. Materi tidak disimpan di sistem; semua materi dibagikan melalui grup WhatsApp.

## Konsep ERD Training

Struktur data training dibuat bertingkat:

- `services`: kelompok layanan, contoh `HR Training`.
- `programs`: program di bawah service, contoh `Human Resources Basic Training (HR for Non HR)`.
- `trainings`: topik/kelas training di bawah program, contoh `Interviewing Skill`.
- `trainers`: pengajar yang dapat dipilih untuk setiap training.
- `market_segments`: segment pasar, contoh `HRD Staff / Non HR`.
- `registrations`: pendaftaran peserta, terhubung ke `programs` dan opsional ke `trainings`.

Admin dapat mengelola data tersebut melalui menu `Admin > Data Training`.
Data pendaftaran dapat diunduh dari dashboard admin dalam format Excel (`.xls`) dan PDF. Export PDF dibuat dengan generator lokal di source code, sehingga tidak membutuhkan library/vendor tambahan saat project dipindahkan.

Dokumen ERD tersedia di `database/ERD.md`.

## Instalasi Database

1. Buat database lalu pilih database tersebut di phpMyAdmin.
2. Jalankan `database/schema.sql`.
3. Jalankan `database/seed.sql`.
4. Sesuaikan koneksi database melalui environment variable seperti contoh `.env.example`, atau edit `application/config/database.php`.
5. Sesuaikan nomor WhatsApp melalui tabel `site_settings` atau environment/config sesuai kebutuhan.

`base_url` akan dideteksi otomatis dari folder proyek, sehingga folder bisa dipindahkan ke komputer lain selama database sudah dibuat dan folder tetap berada di web root.

## Hosting Rumahweb / cPanel

Panduan update produksi lengkap tersedia di `DEPLOYMENT-CPANEL.md`.

Untuk instalasi baru:

1. Upload isi folder project ke `public_html` atau subfolder domain yang dipakai.
2. Gunakan salah satu cara konfigurasi berikut:
   - Buat file `.env` dari `.env.example`; atau
   - Jika hosting tidak menggunakan `.env`, isi kredensial database langsung pada `application/config/database.php`.
3. Jika memakai `.env`, isi:
   - `APP_ENV="production"`
   - `APP_BASE_URL="https://domain-anda.com/"` atau kosongkan jika ingin otomatis.
   - `APP_KEY` dengan teks acak yang kuat.
   - `DB_HOST`, `DB_USER`, `DB_PASS`, dan `DB_NAME` sesuai database cPanel.
4. Import database lengkap yang sudah dipakai lokal melalui phpMyAdmin cPanel. Jika database hosting masih kosong dari nol, pilih database lalu import `database/schema.sql` dan `database/seed.sql`.
5. Pastikan folder `uploads` ikut diupload dan permission foldernya dapat ditulis oleh PHP.
6. Setelah online, buka halaman utama, halaman konsultasi, portal peserta, dan admin.

File `.htaccess` sudah memblokir akses langsung ke folder sensitif seperti `application`, `system`, `database`, `tools`, serta file `.env`.

Untuk update website yang sudah berjalan, jangan import ulang `schema.sql` atau `seed.sql`. Gunakan hanya file migrasi yang disebutkan pada catatan rilis.

## Aset Visual

File visual disimpan di:

- `uploads/trainers` untuk foto trainer.
- `uploads/logos` untuk logo mitra.
- `uploads/flyers` untuk flyer program.
- `uploads/slides` untuk foto slider halaman utama.
- `uploads/socials` untuk icon media sosial.

Admin dapat mengunggah file melalui menu:

- `Admin > Slide Beranda`
- `Admin > Media Sosial`
- `Admin > Data Program Unggulan`
- `Admin > Data Trainning`
- `Admin > Data Mentor`
- `Admin > Data Perusahaan`

Format yang didukung: JPG, JPEG, PNG, WEBP untuk foto/logo/icon/slide, serta JPG, JPEG, PNG, WEBP, PDF untuk flyer.

## Membuat Admin

Buat admin dari terminal:

```bash
php tools/create_admin.php "Administrator" admin@nara-hr.com "password-yang-kuat"
```

## Catatan Portabilitas

- Tidak ada path absolut yang wajib dipertahankan; project dapat dicopy ke folder web root lain.
- Pastikan folder `uploads` ikut dicopy karena berisi file yang dirujuk database.
- Jika menggunakan database baru, jalankan `schema.sql` lalu `seed.sql`.
- Jika menggunakan database lama, pastikan tabel terbaru seperti `home_slides`, `program_categories`, dan `social_links` sudah ada.
