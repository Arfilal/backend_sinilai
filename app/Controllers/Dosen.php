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

    // Get all dosen
    public function index()
    {
        $data = $this->model->orderBy('nama_dosen', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    // Get dosen by NIDN
    public function show($nidn = null)
    {
        $data = $this->model->where('nidn', $nidn)->first();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk NIDN $nidn");
        }
    }

    // Create new dosen
    public function create()
    {
        $data = $this->request->getJSON(true);
        if (!$data) {
            $data = $this->request->getPost();
        }

        if (!$this->model->save($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated([
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data dosen berhasil ditambahkan'
            ]
        ]);
    }

    // Update dosen by NIDN
    public function update($nidn = null)
    {
        $data = $this->request->getJSON(true);
        if (!$data) {
            $data = $this->request->getRawInput();
        }

        // Pastikan data ada
        $existing = $this->model->where('nidn', $nidn)->first();
        if (!$existing) {
            return $this->failNotFound("Data tidak ditemukan untuk NIDN $nidn");
        }

        // Update data
        if (!$this->model->update($nidn, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => "Data dosen dengan NIDN $nidn berhasil diperbarui"
            ]
        ]);
    }

    // Delete dosen by NIDN
    public function delete($nidn = null)
    {
        $existing = $this->model->where('nidn', $nidn)->first();
        if (!$existing) {
            return $this->failNotFound("Data dengan NIDN $nidn tidak ditemukan");
        }

        if (!$this->model->delete($nidn)) {
            return $this->failServerError("Gagal menghapus data dosen");
        }

        return $this->respondDeleted([
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => "Data dengan NIDN $nidn berhasil dihapus"
            ]
        ]);
    }
}
