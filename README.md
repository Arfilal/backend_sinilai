# Sinilai ( Sistem Pengelolaan Nilai Mahasiswa)

## Apa yang perlu dipersiapkan

Sudah pasti yang perlu dipersiapkan adalah device yang mumpuni dikarenakan, ada beberapa aplikasi yang perlu diinstall apabila belum memliki, seperti Docker, postman, dan vs code kemudian untuk projek ini terbagi menjadi beberapa role seperti frontend, backend, DB Engneer, DevOps, dan SQA

## BackEnd

Kebetulan di tugas projek ini saya mendapatkan role sebagai backend, salah saatu tugas backend di projek ini adalah membuat CRUD API, API (Application Programming Interface) adalah sekumpulan aturan atau mekanisme yang memungkinkan dua sistem perangkat lunak berkomunikasi satu sama lain. API bertindak sebagai jembatan yang menghubungkan berbagai aplikasi, perangkat.
untuk table yang saya buat sendiri ada 6 table, terdiri dari table dosen, mahasiswa, kelas, prodi, nilai, mata kuliah, untuk table yang memili code API yaitu table nilai dan mahasiswa karena terhubung dengan beberapa table


## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the development repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
