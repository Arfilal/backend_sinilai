<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelDosen;

class Dosen extends BaseController
{
    use ResponseTrait;

    protected $model;

    public function __construct()
    {
        $this->model = new ModelDosen();
    }

    // Get all data dosen
    public function index()
    {
        $data = $this->model->orderBy('nama_dosen', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    // Get data by NIDN
    public function show($nidn = null)
    {
        $data = $this->model->where('nidn', $nidn)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk NIDN $nidn");
        }
    }

    // Create new dosen
    public function create()
    {
        // Menerima data dari JSON atau form-data
        $data = $this->request->getJSON(true);
        if (!$data) {
            $data = $this->request->getPost(); // fallback untuk form-data
        }

        // Validasi atau simpan data
        if (!$this->model->save($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Berhasil memasukkan data dosen'
            ]
        ];
        return $this->respond($response, 201);
    }

    // Update dosen
    public function update($nidn = null)
    {
        $data = $this->request->getJSON(true);
        if (!$data) {
            $data = $this->request->getRawInput();
        }

        $data['nidn'] = $nidn;

        $isExists = $this->model->where('nidn', $nidn)->first();
        if (!$isExists) {
            return $this->failNotFound("Data tidak ditemukan untuk NIDN $nidn");
        }

        if ($this->model->where('nidn', $nidn)->set($data)->update()) {
            return $this->respond([
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data dosen dengan NIDN $nidn berhasil diperbarui"
                ]
            ]);
        }

        return $this->fail("Gagal mengupdate data dosen.");
    }

    // Delete dosen
    public function delete($nidn)
    {
        $data = $this->model->where('nidn', $nidn)->first();

        if ($data) {
            $this->model->where('nidn', $nidn)->delete();

            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data dengan NIDN $nidn berhasil dihapus"
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound("Data dengan NIDN $nidn tidak ditemukan");
        }
    }
}
