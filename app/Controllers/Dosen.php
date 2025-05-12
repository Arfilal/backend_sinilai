<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelDosen;
use App\Controllers\BaseController;

class Dosen extends BaseController
{
    use ResponseTrait;
    protected $model;

    function __construct()
    {
        $this->model = new ModelDosen();
    }
    public function index()
    {
        $data = $this->model->orderBy('nama_dosen', 'asc')->findAll();
        return $this->respond($data, 200);
    }
    public function show($nidn = null)
    {
        $data = $this->model->where('nidn', $nidn)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("data tidak ditemukan untuk nidn $nidn");
        }
    }
    public function create()
    {
        // Ambil data dari request
        $nidn = $this->request->getVar('nidn');
        $nama_dosen = $this->request->getVar('nama_dosen');

        // Pastikan data valid
        if (empty($nidn) || empty($nama_dosen)) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap']);
        }

        // Masukkan data ke dalam model
        $data = [
            'nidn' => $nidn,
            'nama_dosen' => $nama_dosen
        ];

        // Insert data ke database
        if ($this->model->insert($data)) {
            return $this->response->setJSON(['message' => 'Aspirasi berhasil dikirim']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal mengirim aspirasi']);
        }
    }

    public function edit($nidn)
    {
        $dosen = $this->model->find($nidn);
        if (!$dosen) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data tidak ditemukan']);
        }
        return $this->response->setJSON($dosen);
    }

    public function update($nidn)
    {
        $nidn = $this->request->getVar('nidn');
        $nama_dosen = $this->request->getVar('nama_dosen');

        // Pastikan data valid
        if (empty($nidn) || empty($nama_dosen)) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap']);
        }

        // Masukkan data ke dalam model
        $data = [
            'nidn' => $nidn,
            'nama_dosen' => $nama_dosen
        ];

        $existing = $this->model->where('nidn', $nidn)->first();
        if (!$existing) {
            return $this->failNotFound("Data tidak ditemukan untuk NIDN $nidn");
        }

        $updated = $this->model->where('nidn', $nidn)->set($data)->update();

        if ($updated) {
            return $this->respond([
                'status' => 200,
                'messages' => ['success' => "Data berhasil diperbarui"]
            ]);
        }

        return $this->fail("Gagal memperbarui data.");
    }


    public function delete($nidn)
    {
        $data = $this->model->where('nidn', $nidn)->findAll();

        if ($data) {
            $this->model->where('nidn', $nidn)->delete(); // Perbaikan metode delete()

            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data dengan NIDN $nidn berhasil dihapus"
                ]
            ];
            return $this->respond($response); // Perbaikan dari responddelete()
        } else {
            return $this->failNotFound("Data dengan NIDN $nidn tidak ditemukan");
        }
    }
}