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

    // Validasi input
    if (empty($nidn) || empty($nama_dosen)) {
        return $this->response->setJSON(['error' => 'Data tidak lengkap']);
    }

    // Siapkan data untuk disimpan
    $data = [
        'nidn' => $nidn,
        'nama_dosen' => $nama_dosen
    ];

    // Simpan data ke database menggunakan model
    if ($this->model->insert($data)) {
        return $this->response->setJSON(['message' => 'Data dosen berhasil ditambahkan']);
    } else {
        return $this->response->setJSON(['error' => 'Gagal menambahkan data dosen']);
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
    // Cek apakah data dosen dengan NIDN tersebut ada
    $existing = $this->model->find($nidn);
    if (!$existing) {
        return $this->failNotFound("Data dosen dengan NIDN $nidn tidak ditemukan");
    }

    // Ambil data dari request
    $nama_dosen = $this->request->getVar('nama_dosen');

    // Validasi input
    if (empty($nama_dosen)) {
        return $this->fail("Data tidak lengkap", 400);
    }

    // Siapkan data yang akan diupdate
    $data = [
        'nama_dosen' => $nama_dosen
    ];

    // Update data
    if ($this->model->update($nidn, $data)) {
        return $this->respond([
            'message' => "Data dosen dengan NIDN $nidn berhasil diperbarui"
        ], 200);
    } else {
        return $this->fail("Gagal memperbarui data dosen", 500);
    }
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