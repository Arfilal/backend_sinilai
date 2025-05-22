![image](https://github.com/user-attachments/assets/483f363b-aef5-4854-816b-fbaa67dc4327)# Sinilai ( Sistem Pengelolaan Nilai Mahasiswa)

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
Dosen
- GET http://localhost:8080/dosen
- POST http://localhost:8080/dosen/{id dosen}
- DEL http://localhost:8080/dosen/{id dosen}
- PUT http://localhost:8080/dosen/{id dosen}

Mahasiswa
- GET http://localhost:8080/mahasiswa
- POST http://localhost:8080/mahasiswa/{id mahasiswa}
- DEL http://localhost:8080/mahasiswa/{id mahasiswa}
- PUT http://localhost:8080/mahasiswa/{id mahasiswa}

Kelas
- GET http://localhost:8080/kelas
- POST http://localhost:8080/kelas/{id kelas}
- DEL http://localhost:8080/kelas/{id kelas}
- PUT http://localhost:8080/kelas/{id kelas}

Mata Kuliah
- GET http://localhost:8080/matakuliah
- POST http://localhost:8080/matakuliah/{id mata kuliah}
- DEL http://localhost:8080/matakuliah/{id mata kuliah}
- PUT http://localhost:8080/matakuliah/{id mata kuliah}

Nilai
- GET http://localhost:8080/nilai
- POST http://localhost:8080/nilai/{id nilai}
- DEL http://localhost:8080/nilai/{id nilai}
- PUT http://localhost:8080/nilai/{id nilai}

Prodi
- GET http://localhost:8080/prodi
- POST http://localhost:8080/prodi/{id prodi}
- DEL http://localhost:8080/prodi/{id prodi}
- PUT http://localhost:8080/prodi/{id prodi}



Postman adalah alat (tool) API testing yang digunakan untuk menguji, mengelola, dan mendokumentasikan API. Dengan Postman, developer dapat mengirim request ke API, melihat responnya, dan melakukan debugging dengan mudah.

## Cara install API
1. cek apakah composer sudah terinstall

![Image](https://github.com/user-attachments/assets/00cb2f69-5e93-4713-b054-0ae34469c24f)

2. konfigurasi environment

![Image](https://github.com/user-attachments/assets/b688d514-8fd9-4d3d-9f6e-46c66dc6dbc2)

3. menjalankan server

![Image](https://github.com/user-attachments/assets/c67d2516-103e-46fb-b96b-a7d996520c15)

4. membuat rest API

![Image](https://github.com/user-attachments/assets/76a71e87-00c0-4c42-bf9b-4b651d692cba)

5. atur routes

![Image](https://github.com/user-attachments/assets/13aedcd7-de17-4ef2-98e4-1bf73adbf23e)

6. uji coba API

![Image](https://github.com/user-attachments/assets/c6617667-98c8-4cd4-a602-a6ba040e6dc1)


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

# 🎓 Backend Sinilai

Sistem backend untuk pengelolaan nilai akademik mahasiswa. Dibangun dengan **CodeIgniter 4** dan menggunakan **MySQL** sebagai basis data.

---

## 📁 Struktur Proyek


---

## ⚙️ Cara Menjalankan Proyek

### 1. Clone Proyek

```bash
git clone https://github.com/Arfilal/backend_sinilai.git
cd backend_sinilai

composer install

cp env .env

CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database = sinilai2
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306

CREATE TABLE dosen (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  nip VARCHAR(20)
);

CREATE TABLE mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  nim VARCHAR(20),
  kelas_id INT
);

CREATE TABLE kelas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(50)
);

CREATE TABLE matakuliah (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  dosen_id INT
);

CREATE TABLE nilai (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_id INT,
  matakuliah_id INT,
  nilai INT
);

CREATE TABLE prodi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100)
);

php spark serve


