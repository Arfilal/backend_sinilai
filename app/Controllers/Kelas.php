<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelKelas;
use App\Controllers\BaseController;

class Kelas extends BaseController
{
    use ResponseTrait;
    protected $model;

    function __construct()
    {
        $this->model = new ModelKelas();
    }

    public function index()
    {
        $data = $this->model->orderBy('nama_kelas', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    public function show($kode_kelas = null)
    {
        $data = $this->model->where('kode_kelas', $kode_kelas)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk kode_kelas $kode_kelas");
        }
    }

    public function create()
    {
        // Ambil data dari request
        $kode_kelas = $this->request->getVar('kode_kelas');
        $nama_kelas = $this->request->getVar('nama_kelas');

        // Validasi sederhana
        if (empty($kode_kelas) || empty($nama_kelas)) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap']);
        }

        $data = [
            'kode_kelas' => $kode_kelas,
            'nama_kelas' => $nama_kelas
        ];

        if ($this->model->insert($data)) {
            return $this->response->setJSON(['message' => 'Data kelas berhasil ditambahkan']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menambahkan data kelas']);
        }
    }

    public function edit($kode_kelas)
    {
        $kelas = $this->model->find($kode_kelas);
        if (!$kelas) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data tidak ditemukan']);
        }
        return $this->response->setJSON($kelas);
    }

    public function update($kode_kelas)
    {
        $kode_kelas_baru = $this->request->getVar('kode_kelas');
        $nama_kelas = $this->request->getVar('nama_kelas');

        if (empty($kode_kelas_baru) || empty($nama_kelas)) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap']);
        }

        $data = [
            'kode_kelas' => $kode_kelas_baru,
            'nama_kelas' => $nama_kelas
        ];

        $existing = $this->model->where('kode_kelas', $kode_kelas)->first();
        if (!$existing) {
            return $this->failNotFound("Data tidak ditemukan untuk kode_kelas $kode_kelas");
        }

        $updated = $this->model->where('kode_kelas', $kode_kelas)->set($data)->update();

        if ($updated) {
            return $this->respond([
                'status' => 200,
                'messages' => ['success' => "Data kelas berhasil diperbarui"]
            ]);
        }

        return $this->fail("Gagal memperbarui data kelas.");
    }

    public function delete($kode_kelas)
    {
        $data = $this->model->where('kode_kelas', $kode_kelas)->findAll();

        if ($data) {
            $this->model->where('kode_kelas', $kode_kelas)->delete();
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data dengan kode_kelas $kode_kelas berhasil dihapus"
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound("Data dengan kode_kelas $kode_kelas tidak ditemukan");
        }
    }
}
