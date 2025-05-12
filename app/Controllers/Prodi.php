<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelProdi;
use App\Controllers\BaseController;

class Prodi extends BaseController
{
    use ResponseTrait;
    protected $model;

    function __construct()
    {
        $this->model = new ModelProdi();
    }

    public function index()
    {
        $data = $this->model->orderBy('nama_prodi', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    public function show($id_prodi = null)
    {
        $data = $this->model->where('id_prodi', $id_prodi)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk id_prodi $id_prodi");
        }
    }

    public function create()
    {
        $id_prodi = $this->request->getVar('id_prodi');
        $nama_prodi = $this->request->getVar('nama_prodi');

        if (empty($id_prodi) || empty($nama_prodi)) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap']);
        }

        $data = [
            'id_prodi' => $id_prodi,
            'nama_prodi' => $nama_prodi
        ];

        if ($this->model->insert($data)) {
            return $this->response->setJSON(['message' => 'Data prodi berhasil ditambahkan']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal menambahkan data prodi']);
        }
    }

    public function edit($id_prodi)
    {
        $prodi = $this->model->find($id_prodi);
        if (!$prodi) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data tidak ditemukan']);
        }
        return $this->response->setJSON($prodi);
    }

    public function update($id_prodi)
    {
        $id_prodi_baru = $this->request->getVar('id_prodi');
        $nama_prodi = $this->request->getVar('nama_prodi');

        if (empty($id_prodi_baru) || empty($nama_prodi)) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap']);
        }

        $data = [
            'id_prodi' => $id_prodi_baru,
            'nama_prodi' => $nama_prodi
        ];

        $existing = $this->model->where('id_prodi', $id_prodi)->first();
        if (!$existing) {
            return $this->failNotFound("Data tidak ditemukan untuk id_prodi $id_prodi");
        }

        $updated = $this->model->where('id_prodi', $id_prodi)->set($data)->update();

        if ($updated) {
            return $this->respond([
                'status' => 200,
                'messages' => ['success' => "Data prodi berhasil diperbarui"]
            ]);
        }

        return $this->fail("Gagal memperbarui data prodi.");
    }

    public function delete($id_prodi)
    {
        $data = $this->model->where('id_prodi', $id_prodi)->findAll();

        if ($data) {
            $this->model->where('id_prodi', $id_prodi)->delete();

            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data dengan id_prodi $id_prodi berhasil dihapus"
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound("Data dengan id_prodi $id_prodi tidak ditemukan");
        }
    }
}
