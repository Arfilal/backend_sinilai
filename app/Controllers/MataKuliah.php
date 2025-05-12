<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelMataKuliah;
use App\Controllers\BaseController;

class MataKuliah extends BaseController
{
    use ResponseTrait;
    protected $model;

    function __construct()
    {
        $this->model = new ModelMataKuliah();
    }

    public function index()
    {
        $data = $this->model->orderBy('nama_matkul', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    public function show($kode_matkul = null)
    {
        $data = $this->model->where('kode_matkul', $kode_matkul)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk kode_matkul $kode_matkul");
        }
    }

    public function create()
    {
        $kode_matkul = $this->request->getVar('kode_matkul');
        $nama_matkul = $this->request->getVar('nama_matkul');

        if (empty($kode_matkul) || empty($nama_matkul)) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap']);
        }

        $data = [
            'kode_matkul' => $kode_matkul,
            'nama_matkul' => $nama_matkul
        ];

        if ($this->model->insert($data)) {
            return $this->response->setJSON(['message' => 'Data mata kuliah berhasil ditambahkan']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menambahkan data mata kuliah']);
        }
    }

    public function edit($kode_matkul)
    {
        $matkul = $this->model->find($kode_matkul);
        if (!$matkul) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data tidak ditemukan']);
        }
        return $this->response->setJSON($matkul);
    }

    public function update($kode_matkul)
    {
        $kode_matkul_baru = $this->request->getVar('kode_matkul');
        $nama_matkul = $this->request->getVar('nama_matkul');

        if (empty($kode_matkul_baru) || empty($nama_matkul)) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap']);
        }

        $data = [
            'kode_matkul' => $kode_matkul_baru,
            'nama_matkul' => $nama_matkul
        ];

        $existing = $this->model->where('kode_matkul', $kode_matkul)->first();
        if (!$existing) {
            return $this->failNotFound("Data tidak ditemukan untuk kode_matkul $kode_matkul");
        }

        $updated = $this->model->where('kode_matkul', $kode_matkul)->set($data)->update();

        if ($updated) {
            return $this->respond([
                'status' => 200,
                'messages' => ['success' => "Data mata kuliah berhasil diperbarui"]
            ]);
        }

        return $this->fail("Gagal memperbarui data mata kuliah.");
    }

    public function delete($kode_matkul)
    {
        $data = $this->model->where('kode_matkul', $kode_matkul)->findAll();

        if ($data) {
            $this->model->where('kode_matkul', $kode_matkul)->delete();

            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data dengan kode_matkul $kode_matkul berhasil dihapus"
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound("Data dengan kode_matkul $kode_matkul tidak ditemukan");
        }
    }
}
