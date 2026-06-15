# Database Import Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Mengganti database saat ini dengan isi dari file `gereja_tegif.sql`.

**Architecture:** Menggunakan Laravel Artisan untuk membersihkan database dan MySQL CLI untuk mengimpor data.

**Tech Stack:** Laravel Framework, MySQL.

---

### Task 1: Pembersihan Database

**Files:**
- Modify: Database (via command line)

- [ ] **Step 1: Jalankan perintah wipe**

Jalankan perintah berikut untuk menghapus semua tabel, view, dan fungsi di database `gereja_tegif`.

Run: `php artisan db:wipe --force`

Expected: `Database wiped successfully.`

### Task 2: Impor File SQL

**Files:**
- Modify: Database (via command line)

- [ ] **Step 1: Jalankan perintah impor mysql**

Gunakan MySQL CLI untuk mengimpor file `gereja_tegif.sql` ke database `gereja_tegif`.

Run: `mysql -u root gereja_tegif < gereja_tegif.sql`

Expected: Perintah selesai tanpa pesan error.

### Task 3: Verifikasi Data

**Files:**
- Modify: Database (via command line)

- [ ] **Step 1: Periksa status migrasi**

Gunakan Artisan untuk melihat apakah tabel-tabel sudah terdeteksi.

Run: `php artisan migrate:status`

Expected: Daftar tabel muncul, kemungkinan dengan status "Ran" atau sesuai dengan isi SQL dump.

- [ ] **Step 2: Cek jumlah data pada tabel utama**

Jalankan query untuk memastikan data `users` telah masuk.

Run: `php artisan tinker --execute="echo 'Total Users: ' . \App\Models\User::count()"`

Expected: Angka jumlah user yang lebih besar dari 0 (jika dump berisi data).

- [ ] **Step 3: Cek tabel jemaat**

Jalankan query untuk memastikan data `jemaat` telah masuk.

Run: `php artisan tinker --execute="echo 'Total Jemaat: ' . \App\Models\Jemaat::count()"`

Expected: Angka jumlah jemaat.
