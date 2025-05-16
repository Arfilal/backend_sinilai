<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelNilai;
use App\Controllers\BaseController;

class Nilai extends BaseController
{
    use ResponseTrait;
    protected $model;

    public function __construct()
    {
        $this->model = new ModelNilai();
    }

    public function index()
    {
        $data = $this->model->orderBy('npm', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    public function show($id_nilai = null)
    {
        $data = $this->model->where('id_nilai', $id_nilai)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data nilai tidak ditemukan untuk ID $id_nilai");
        }
    }

   public function create()
{
    $id_nilai = $this->request->getVar('id_nilai');
    $npm = $this->request->getVar('npm');
    $kode_matkul = $this->request->getVar('kode_matkul');
    $nidn = $this->request->getVar('nidn');
    $semester = $this->request->getVar('semester');
    $tugas = $this->request->getVar('tugas');
    $uts = $this->request->getVar('uts');
    $uas = $this->request->getVar('uas');

    // Validasi input
    if (
        empty($npm) || empty($kode_matkul) || empty($semester) ||
        empty($tugas) || empty($uts) || empty($uas)
    ) {
        return $this->response->setJSON(['error' => 'Data tidak lengkap']);
    }

    if (!is_numeric($tugas) || !is_numeric($uts) || !is_numeric($uas)) {
        return $this->response->setJSON(['error' => 'Nilai tugas, UTS, dan UAS harus berupa angka']);
    }

    // Hitung nilai akhir dan status
    $nilai = ($tugas + $uts + $uas) / 3;
    $status = $nilai >= 50 ? 'Lulus' : 'Tidak Lulus';

    // Siapkan data untuk disimpan
    $data = [
        'npm' => $npm,
        'kode_matkul' => $kode_matkul,
        'nidn' => $nidn,
        'semester' => $semester,
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'nilai_akhir' => $nilai,
        'status' => $status
    ];

    // Insert ke database
    if ($this->model->insert($data)) {
        return $this->response->setJSON(['message' => 'Data nilai berhasil ditambahkan']);
    } else {
        return $this->response->setJSON(['error' => 'Gagal menambahkan data nilai']);
    }
}   


    public function update($id_nilai)
    {
        // Cek apakah data dengan ID tersebut ada
        $existing = $this->model->find($id_nilai);
        if (!$existing) {
            return $this->failNotFound("Data dengan ID $id_nilai tidak ditemukan");
        }

        // Ambil data dari request (x-www-form-urlencoded atau form-data)
        $npm = $this->request->getVar('npm');
        $kode_matkul = $this->request->getVar('kode_matkul');
        $nidn = $this->request->getVar('nidn');
        $tugas = $this->request->getVar('tugas');
        $uts = $this->request->getVar('uts');
        $uas = $this->request->getVar('uas');

        // Validasi input
        if (empty($npm) || empty($tugas) || empty($uts) || empty($uas)) {
            return $this->fail("Data tidak lengkap", 400);
        }

        if (!is_numeric($tugas) || !is_numeric($uts) || !is_numeric($uas)) {
            return $this->fail("Nilai tugas, UTS, dan UAS harus berupa angka", 400);
        }

        // Hitung nilai akhir dan status
        $nilai_akhir = ($tugas + $uts + $uas) / 3;
        $status = $nilai_akhir >= 50 ? 'Lulus' : 'Tidak Lulus';

        // Siapkan data yang akan diupdate
        $data = [
            'npm' => $npm,
            'kode_matkul' => $kode_matkul,
            'nidn' => $nidn,
            'tugas' => $tugas,
            'uts' => $uts,
            'uas' => $uas,
            'nilai_akhir' => $nilai_akhir,
            'status' => $status,
        ];

        // Update data
        if ($this->model->update($id_nilai, $data)) {
            return $this->respond([
                'message' => "Data nilai dengan ID $id_nilai berhasil diperbarui"
            ], 200);
        } else {
            return $this->fail("Gagal memperbarui data nilai", 500);
        }
    }

    public function delete($id_nilai)
    {
        $data = $this->model->where('id_nilai', $id_nilai)->findAll();

        if ($data) {
            $this->model->delete($id_nilai);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data nilai dengan ID $id_nilai berhasil dihapus"
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound("Data nilai dengan ID $id_nilai tidak ditemukan");
        }
    }

    public function getNilaiByNama()
    {
        $nama_mhs = $this->request->getGet('nama_mhs');
        $semester = $this->request->getGet('semester');

        if (empty($nama_mhs) || empty($semester)) {
            return $this->fail("Nama mahasiswa dan semester harus diisi!", 400);
        }

        $data = $this->model->getNilaiMahasiswa($nama_mhs, $semester);

        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data nilai untuk $nama_mhs pada semester $semester tidak ditemukan");
        }
    }
}
