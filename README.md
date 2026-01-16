# Membership App

Sebuah aplikasi web sederhana berbasis Laravel untuk mengelola membership dengan fitur login media sosial, pembatasan akses konten berdasarkan tipe membership, dan panel administrasi.

## Fitur Utama

*   **Autentikasi:**
    *   Register dan Login manual menggunakan email dan password.
    *   Login menggunakan akun Google (melalui Laravel Socialite).
    *   (Struktur untuk Login Facebook telah dibuat, tetapi perlu konfigurasi aplikasi Facebook Developer untuk diaktifkan).
*   **Sistem Membership:**
    *   Mendukung tiga tipe membership: Type A, Type B, Type C.
    *   Pembatasan akses konten (artikel dan video) berdasarkan batas yang ditentukan untuk masing-masing tipe membership.
*   **Panel Administrasi:**
    *   Akses terbatas hanya untuk pengguna dengan role `admin`.
    *   CRUD (Create, Read, Update, Delete) untuk Tipe Membership.
    *   CRUD untuk Artikel.
    *   CRUD untuk Video.
    *   CRUD untuk User, termasuk kemampuan untuk menetapkan tipe membership kepada user.
*   **Frontend:**
    *   Menggunakan Tailwind CSS untuk styling.
    *   Responsive design (menggunakan kelas-kelas Tailwind).
*   **Backend:**
    *   Dibangun dengan framework Laravel 12.
    *   Menggunakan database MySQL (dapat disesuaikan).

## Prasyarat

Sebelum menjalankan aplikasi ini, pastikan kamu memiliki:

*   PHP >= 8.2
*   Composer
*   Node.js & npm
*   Web Server (misalnya Apache atau Nginx)
*   Database (misalnya MySQL)

## Instalasi

1.  **Clone Repository:**
    ```bash
    git clone https://github.com/[USERNAME_KAMU]/[NAMA_REPOSITORY_MEMBERSHIP_APP].git
    cd [NAMA_REPOSITORY_MEMBERSHIP_APP]
    ```

2.  **Install Dependencies:**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment:**
    *   Salin file `.env.example` menjadi `.env`:
        ```bash
        cp .env.example .env
        ```
    *   Edit file `.env` dan sesuaikan konfigurasi database:
        ```ini
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=[NAMA_DATABASE_KAMU]
        DB_USERNAME=[USERNAME_DATABASE]
        DB_PASSWORD=[PASSWORD_DATABASE]
        ```
    *   *(Opsional - Untuk Login Google/Facebook)* Jika kamu ingin mengaktifkan login Google/Facebook, tambahkan juga konfigurasi Socialite di `.env`:
        ```ini
        # Google Socialite (isi dengan Client ID dan Secret dari Google Cloud Console)
        GOOGLE_CLIENT_ID=
        GOOGLE_CLIENT_SECRET=
        GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

        # Facebook Socialite (isi dengan App ID dan Secret dari Meta for Developers)
        FACEBOOK_CLIENT_ID=
        FACEBOOK_CLIENT_SECRET=
        FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/facebook/callback
        ```

4.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Migrate Database:**
    ```bash
    php artisan migrate
    ```
    *(Opsional)* Jika kamu ingin menggunakan data dummy untuk testing:
    ```bash
    php artisan db:seed
    ```

6.  **Build Assets (Tailwind CSS):**
    ```bash
    npm run build
    ```
    Atau, untuk mode watch selama development:
    ```bash
    npm run dev
    ```

7.  **Jalankan Server:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan berjalan di `http://localhost:8000`.

## Penggunaan

1.  Buka `http://localhost:8000` di browser kamu.
2.  Untuk login sebagai admin (jika menggunakan seeder), gunakan:
    *   Email: `admin@example.com`
    *   Password: `password`
3.  Untuk login sebagai member (jika menggunakan seeder), gunakan:
    *   Email: `member1@example.com`
    *   Password: `password`
4.  Akses panel admin di `http://localhost:8000/admin`.
5.  Akses halaman member setelah login di `http://localhost:8000/member`.

## Kontribusi

Kontribusi sangat diterima! Silakan buka _issue_ atau kirim _pull request_ jika kamu ingin membantu mengembangkan proyek ini.

## Lisensi

Proyek ini dilisensikan di bawah lisensi [MIT License](https://opensource.org/licenses/MIT).
