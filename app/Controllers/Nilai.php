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
        $npm = $this->request->getVar('npm');
        $kode_matkul = $this->request->getVar('kode_matkul');
        $semester = $this->request->getVar('semester');
        $nilai = $this->request->getVar('nilai');

        if (empty($npm) || empty($kode_matkul) || empty($semester) || empty($nilai)) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap']);
        }

        $data = [
            'npm' => $npm,
            'kode_matkul' => $kode_matkul,
            'semester' => $semester,
            'nilai' => $nilai
        ];

        if ($this->model->insert($data)) {
            return $this->response->setJSON(['message' => 'Data nilai berhasil ditambahkan']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menambahkan data nilai']);
        }
    }

    public function update($id_nilai)
    {
        $npm = $this->request->getVar('npm');
        $kode_matkul = $this->request->getVar('kode_matkul');
        $semester = $this->request->getVar('semester');
        $nilai = $this->request->getVar('nilai');

        if (empty($npm) || empty($kode_matkul) || empty($semester) || empty($nilai)) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap']);
        }

        $data = [
            'npm' => $npm,
            'kode_matkul' => $kode_matkul,
            'semester' => $semester,
            'nilai' => $nilai
        ];

        $existing = $this->model->where('id_nilai', $id_nilai)->first();
        if (!$existing) {
            return $this->failNotFound("Data tidak ditemukan untuk ID $id_nilai");
        }

        if ($this->model->update($id_nilai, $data)) {
            return $this->respond([
                'status' => 200,
                'messages' => ['success' => "Data nilai berhasil diperbarui"]
            ]);
        }

        return $this->fail("Gagal memperbarui data nilai.");
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
