# Update Produksi Nara-HR melalui cPanel

Dokumen ini digunakan untuk memperbarui website yang sudah aktif di `https://nara-hr.com`.

## 1. Backup sebelum update

1. Buka cPanel lalu buat backup folder website melalui File Manager.
2. Download backup database aktif melalui phpMyAdmin menu **Export > Quick > SQL**.
3. Simpan salinan file `application/config/database.php` dari hosting.
4. Simpan salinan folder `uploads`, terutama `uploads/certificates`.

Jangan lanjut sebelum backup file dan database selesai.

## 2. File yang tidak boleh tertimpa

Saat update, pertahankan file dan folder produksi berikut:

- `application/config/database.php`
- `.env`, jika ada
- `uploads/`

Folder `uploads` berisi flyer, logo, foto trainer, slide, ikon media sosial, dan sertifikat peserta. Mengganti folder ini dengan salinan lama dapat menghilangkan file produksi terbaru.

## 3. Migrasi database update ini

Pilih database produksi di phpMyAdmin, lalu import:

`database/migrations/2026_06_06_production_hardening.sql`

Migrasi hanya mengubah kolom kategori program menjadi dinamis dan tidak menghapus data.

Jangan import ulang:

- `database/schema.sql`
- `database/seed.sql`
- `sahabat_nara.sql`

Ketiga file tersebut digunakan untuk instalasi baru atau pemulihan penuh, bukan update website aktif.

## 4. Upload source code

1. Aktifkan maintenance singkat atau lakukan update pada jam trafik rendah.
2. Buka **File Manager** dan masuk ke document root domain, biasanya `public_html`.
3. Upload arsip update lalu ekstrak di document root.
4. Pastikan struktur akhirnya langsung berisi `index.php`, `.htaccess`, `application`, `system`, `assets`, dan `uploads`; jangan sampai terbentuk folder ganda seperti `public_html/sahabat_nara/sahabat_nara`.
5. Jangan menimpa file database produksi dan folder upload yang disebutkan pada bagian 2.
6. Pastikan `.htaccess` ikut terunggah. Aktifkan tampilan hidden files pada File Manager.

## 5. Permission

Gunakan permission:

- Folder: `755`
- File: `644`
- Folder `uploads` dan subfoldernya: mulai dari `755`; gunakan `775` hanya jika PHP tidak dapat mengunggah file.

Jangan menggunakan permission `777`.

## 6. Pemeriksaan setelah update

Buka dan uji:

- `/`
- `/galeri`
- `/daftar`
- `/auth/login`
- `/admin`
- `/peserta/login`
- `/peserta/dashboard` setelah login

Lakukan satu pengujian tambah/edit data admin, upload gambar kecil, login peserta, dan download sertifikat.

Pastikan:

- HTTPS aktif dan tidak ada mixed content.
- Login salah tidak menampilkan detail database.
- URL `/database/schema.sql`, `/application/config/database.php`, dan `/uploads/certificates/nama-file.pdf` menghasilkan akses ditolak.
- Galeri menampilkan seluruh gambar tanpa label.

## 7. Rollback

Jika terjadi error:

1. Kembalikan arsip folder website dari backup.
2. Jika migrasi/database ikut bermasalah, import file SQL hasil backup.
3. Kembalikan `application/config/database.php`.
4. Periksa kembali versi PHP dan extension `mysqli`, `fileinfo`, dan `mbstring`.

## Kontrol keamanan

Source code menerapkan:

- **Confidentiality:** autentikasi admin/peserta, password hash, cookie HttpOnly/SameSite, pembatasan login, proteksi sertifikat, dan pemblokiran file konfigurasi.
- **Integrity:** prepared statements, CSRF token, validasi metode POST, validasi MIME upload, nama file acak, serta foreign key/unique key database.
- **Availability:** halaman error tidak membuka detail kredensial, struktur portable, backup/rollback terdokumentasi, dan file upload dipisahkan dari source code.

Keamanan produksi tetap bergantung pada SSL, password cPanel/database yang kuat, backup berkala, versi PHP yang didukung, dan pembaruan server dari penyedia hosting.
