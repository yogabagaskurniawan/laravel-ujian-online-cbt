# Laravel 10 | PHP 8.2 | Livewire 3 - CBT Projects

## About

Membantu perusahaan, sekolah, organisasi lainnya dalam melakukan test kompentensi secara online, misalnya seorang Guru yang ingin menguji muridnya dalam subjek tertentu.

## Model databases

![alt text](https://github.com/yogabagaskurniawan/laravel-ujian-online-cbt/blob/master/public/dokumentasi/Model%20databases.png?raw=true)

## Tampilan List Kelas ( teacher )

![alt text](https://github.com/yogabagaskurniawan/laravel-ujian-online-cbt/blob/master/public/dokumentasi/1.png?raw=true)

## Tampilan Manage Pertanyaan ( teacher )

![alt text](https://github.com/yogabagaskurniawan/laravel-ujian-online-cbt/blob/master/public/dokumentasi/2.png?raw=true)

## Tampilan Tambah Pertanyaan ( teacher )

![alt text](https://github.com/yogabagaskurniawan/laravel-ujian-online-cbt/blob/master/public/dokumentasi/3.png?raw=true)

## Tampilan Mengerjakan Soal ( student )

![alt text](https://github.com/yogabagaskurniawan/laravel-ujian-online-cbt/blob/master/public/dokumentasi/4.png?raw=true)

## Tampilan Hasil Mengerjakan Soal ( student )

![alt text](https://github.com/yogabagaskurniawan/laravel-ujian-online-cbt/blob/master/public/dokumentasi/5.png?raw=true)

## feature

-   User role antara guru dan murid
-   Pembuatan kelas dan test terbaru
-   Penambahan murid kepada kelas tertentu
-   Proses pendaftaran murid
-   Fitur untuk membantu murid melakukan pembelajaran (test)
-   Fitur untuk membantu murid melihat hasil test pada kelas tersebut

## Run Locally

Clone project

```bash
  git clone https://github.com/yogabagaskurniawan/laravel-ujian-online-cbt.git
```

Buka direktori projek

```bash
  cd laravel-ujian-online-cbt
```

Selanjutnya ketikan perintah

```bash
    composer install
```

-   Copy file .env.example ke .env dan edit kredensial database di sana. (perintah dibawah ini untuk CMD di Windows)

```bash
    copy .env.example .env
```

-   Selanjutnya generate app key

```bash
    php artisan key:generate
```

```bash
    php artisan migrate:fresh --seed
```

```bash
    php artisan storage:link
```

#### Login

-   email = teacher@example.com
-   password = admin123
