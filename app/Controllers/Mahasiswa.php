<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelMahasiswa;

class Mahasiswa extends BaseController
{
    use ResponseTrait;
    protected $model;

    function __construct()
    {
        $this->model = new ModelMahasiswa();
    }

    public function index()
    {
        $data = $this->model->orderBy('nama_mhs', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    // 🔥 Menambahkan fungsi untuk mendapatkan data mahasiswa dengan prodi dan kelas
    public function getMahasiswaWithProdi()
    {
        $data = $this->model->getMahasiswaWithProdi();

        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data mahasiswa tidak ditemukan.");
        }
    }
}
 