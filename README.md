# Sinilai ( Sistem Pengelolaan Nilai Mahasiswa)

## Apa yang perlu dipersiapkan

Sudah pasti yang perlu dipersiapkan adalah device yang mumpuni dikarenakan, ada beberapa aplikasi yang perlu diinstall apabila belum memliki, seperti Docker, postman, dan vs code kemudian untuk projek ini terbagi menjadi beberapa role seperti frontend, backend, DB Engneer, DevOps, dan SQA

## Contoh code API yang digunakan:

![Image](https://github.com/user-attachments/assets/e50c795d-684c-425c-9a72-bde724223753)

gambar diatas merupakan contoh dari penggunaan code API dari table nilai, penjelasan singkat dari code diatas Fungsi getNilaiByNama() adalah sebuah metode dalam controller CodeIgniter 4 yang digunakan untuk mengambil data nilai mahasiswa berdasarkan nama dan semester melalui API

### Mengambil Parameter dari URL
1. getGet('nama_mhs') → Mengambil nilai parameter nama_mhs dari URL.
2. getGet('semester') → Mengambil nilai parameter semester dari URL.
   
### Mengambil Data Nilai dari Model
1. Fungsi getNilaiMahasiswa($nama_mhs, $semester) akan mengambil data nilai mahasiswa berdasarkan nama dan semester dari database.
2. Metode ini dipanggil dari model yang telah dibuat sebelumnya.
   
### Mengembalikan Data Nilai Mahasiswa
1. Jika data ditemukan → Mengembalikan data nilai mahasiswa dalam format JSON dengan status 200 (OK).

## Contoh Postman:

![Image](https://github.com/user-attachments/assets/263755b8-b042-4596-b9e2-492c82e9bc11)

Postman adalah alat (tool) API testing yang digunakan untuk menguji, mengelola, dan mendokumentasikan API. Dengan Postman, developer dapat mengirim request ke API, melihat responnya, dan melakukan debugging dengan mudah.

## Cara install API
1. cek apakah composer sudah terinstall



2. konfigurasi environment



3. menjalankan server



4. membuat rest API



5. uji coba API


## BackEnd

Kebetulan di tugas projek ini saya mendapatkan role sebagai backend, salah saatu tugas backend di projek ini adalah membuat CRUD API, API (Application Programming Interface) adalah sekumpulan aturan atau mekanisme yang memungkinkan dua sistem perangkat lunak berkomunikasi satu sama lain. API bertindak sebagai jembatan yang menghubungkan berbagai aplikasi, perangkat.
untuk table yang saya buat sendiri ada 6 table, terdiri dari table dosen, mahasiswa, kelas, prodi, nilai, mata kuliah, untuk table yang memili code API yaitu table nilai dan mahasiswa karena terhubung dengan beberapa table

## Tujuan Praktikum
1. Memahami dan menerapkan konsep MVC (Model-View-Controller) dalam CodeIgniter dan Laravel.
2. Mengembangkan sistem pengelolaan nilai mahasiswa secara online.
3. Menggunakan REST API untuk komunikasi antara backend (CodeIgniter) dan frontend (Laravel).
4. Menerapkan fitur pengolahan dan rekapitulasi nilai otomatis.

## Studi Kasus
Sistem ini digunakan oleh dosen dan admin akademik untuk memasukkan, mengelola, dan memantau nilai mahasiswa dalam suatu mata kuliah. Mahasiswa juga dapat melihat hasil nilai mereka setelah dipublikasikan.
