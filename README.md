<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Poliklinik Management System

Proyek ini adalah sebuah aplikasi berbasis web untuk mengelola sistem poliklinik, dibangun menggunakan Laravel, framework PHP yang powerful dan elegan.

## Fitur Utama

Manajemen Pasien: Tambah, lihat, edit, dan hapus data pasien.

Manajemen Dokter: Kelola data dokter dan jadwal praktik.

Janji Temu: Sistem untuk membuat dan mengelola janji temu antara pasien dan dokter.

Rekam Medis: Catat riwayat medis pasien.


## Persyaratan Sistem

PHP versi 8.1 atau lebih baru

Composer

MySQL atau database lain yang kompatibel

Node.js (untuk pengelolaan dependensi frontend)

## Instalasi

Clone repositori ini:
```
git clone https://github.com/ChariotGG/poliklink-janjitemu-bengkelkoding
cd poliklink-janjitemu-bengkelkoding
```
Install dependensi backend menggunakan Composer:
```
composer install
```
Install dependensi frontend menggunakan npm:
```
npm install
```
Build NPM:
```
npm run build
```
Salin file .env.example menjadi .env dan sesuaikan konfigurasi database Anda:
```
cp .env.example .env
```
Generate application key:
```
php artisan key:generate
```
Jalankan migrasi database:
```
php artisan migrate
```
Jalankan Seeder (Optional):
```
php artisan db:seed
php artisan db:seed --class=PasienSeeder
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=DokterSeeder
```
Clear Config, Cache dan Route:
```
php artisan config:clear     
php artisan cache:clear     
php artisan route:clear     
```
Jalankan server lokal:
```
php artisan serve
```
Akses aplikasi di browser melalui http://localhost:8000.

## Panduan Pengembangan

Jalankan perintah berikut untuk membangun ulang asset frontend:
```
npm run dev
```
Gunakan perintah berikut untuk menjalankan pengujian:
```
php artisan test
```

## Lisensi

Proyek ini dilisensikan di bawah lisensi MIT.
