# Penggajian

![Logo](/public/img/logo.png)

Sebuah aplikasi backoffice untuk perusahaan mengelola karyawan dan penggajian secara cepat dan mudah.

Fitur Utama:

- Pengelolaan Karyawan
- Penggajian Otomatis
- Slip Gaji Otomatis
- Dashboard

Screenshot:

![](/screeshot/dashboard.png)

## Alat Perlengkapan

1. [Node JS](https://nodejs.org/en)
1. [Laravel](https://laravel.com/)

Dimohon untuk download perlengkapan tersebut supaya software ini dapat dijalankan secara semestinya.


## Cara Menjalankan

Sebelum memulai atau menjalankan software ini diperlukan untuk menginstall dependensi yang diperlukan. Untuk menginstal dependensi berikut ini:

```sh
npm install
```

Langkah selanjutnya yaitu kita perlu setup database untuk software ini. Copy file `.env.example` menjadi `.env` dan ganti value/nilai beberapa variable ini:

```sh
DB_DATABASE=
DB_USERNAME=root
DB_PASSWORD=
```

Setelah database telah terhubung lankah selanjutnya yaitu setup atau inisialiasi project berikut dengan cara berikut ini:

```sh
php artisan migrate
php artisan db:seed
```

Untuk menjalankan software ini, gunakan perintah berikut ini:

```sh
npm run build && php artisan serve
```

Ketika berhasil, buka https://localhost:8000 di browser anda.

Default akun:

```
admin@example.com
rahasia123
```