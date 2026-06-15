# Spesifikasi Desain: Impor Database `gereja_tegif.sql`

Dokumen ini merinci langkah-langkah untuk mengganti database saat ini dengan isi dari file `gereja_tegif.sql` menggunakan Opsi 1 (Laravel `db:wipe` + MySQL Import).

## 1. Tujuan
Mengganti seluruh skema dan data dalam database `gereja_tegif` dengan data terbaru dari file SQL yang disediakan.

## 2. Pendekatan: Opsi 1 (Laravel `db:wipe` + MySQL Import)
Kami akan menggunakan perintah `artisan db:wipe` untuk membersihkan semua tabel, view, dan fungsi yang ada tanpa menghapus database itu sendiri. Setelah bersih, kami akan mengimpor file SQL menggunakan command-line client MySQL.

## 3. Langkah-langkah Teknis

### Fase 1: Pembersihan (Wipe)
Menjalankan perintah:
```bash
php artisan db:wipe --force
```
*Tujuan: Memastikan tidak ada konflik tabel saat proses impor.*

### Fase 2: Impor
Menjalankan perintah impor MySQL (mengambil kredensial dari `.env`):
```bash
mysql -u root gereja_tegif < gereja_tegif.sql
```
*Catatan: Karena DB_PASSWORD kosong di .env, kita tidak menyertakan flag -p.*

### Fase 3: Verifikasi
1. Menghitung jumlah tabel yang terimpor.
2. Memeriksa keberadaan data pada tabel utama (misal: `users` atau `jemaat`).
3. Memeriksa log error (jika ada).

## 4. Rencana Pengujian
- Menjalankan `php artisan migrate:status` untuk melihat daftar tabel setelah impor.
- Menjalankan query sederhana `SELECT COUNT(*) FROM users` untuk memastikan data masuk.

## 5. Mitigasi Risiko
- Jika impor gagal, database akan berada dalam status kosong (setelah wipe). Solusinya adalah memperbaiki error pada file SQL dan menjalankan ulang perintah impor.
