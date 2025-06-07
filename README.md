Sistem ini mengelola stok produk di berbagai lokasi fisik dan mencatat mutasi barang masuk/keluar berdasarkan lokasi. Dikembangkan dengan arsitektur REST API berbasis Laravel 11 dan PostgreSQL, sistem ini mendukung autentikasi menggunakan Laravel Sanctum (Bearer Token Authentication) serta dapat dijalankan dalam lingkungan Docker.

## Tech Stack

- Laravel 11
- Laravel Sanctum (Autentikasi berbasis token)
- PostgreSQL
- Docker

## Cara Install & Jalankan

1. Clone
2. Copy File .env -> cp .env.example .env
  pastikan sama dengan yang dibawah ini agar matching dengan docker
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=id-grow
DB_USERNAME=postgres
DB_PASSWORD=postgres

3. Jalankan dengan Docker ->  docker compose up -d --build
4. Masuk ke Container & Jalankan Migrasi + Seeder -> docker exec -it techtest_app bash -> php artisan migrate --seed
5. Generate Application Key -> php artisan key:generate -> php artisan storage:link
6. Selesai

Untuk dokumentasi postman yang sudah dipublish saya ada kendala, saya diblock oleh postman jadi tidak memungkinkan untuk mempublish suatu collection / workspace. jadi saya menaruh link untuk guest saja, namun saya juga bisa memberi file json nya agar nanti bisa langsung di import lalu langsung digunakan, saya akan call Tim HR untuk memberi file json tersebut jika diperlukan.
https://komang-team.postman.co/workspace/Test-Software-Engineer---ID-GRO~240016d4-217b-4fb2-acb3-8e487ae0a0c8/collection/31047827-07697a66-de4d-40cb-aa32-6c11184947d0?action=share&creator=31047827
