<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelNilai1; // Gunakan ModelNilai1 yang sudah diperbaiki

class Nilai extends BaseController
{
    use ResponseTrait;

    private $model;

    function __construct()
    {
        $this->model = new ModelNilai1(); // Gunakan ModelNilai1 yang benar
    }

    public function index()
    {
        $data = $this->model->orderBy('npm', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    public function getNilaiByNama()
    {
        $nama_mhs = $this->request->getGet('nama_mhs'); // Ambil parameter dari URL
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
