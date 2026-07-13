-- Jalankan pada database yang sudah dipilih di phpMyAdmin.
-- Migrasi ini tidak menghapus data.

ALTER TABLE programs
  MODIFY category VARCHAR(180) NOT NULL;
