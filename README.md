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
