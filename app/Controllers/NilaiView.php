<?php

namespace App\Controllers;

use App\Models\v_nilai_mahasiswa;
use CodeIgniter\RESTful\ResourceController;

class NilaiView extends ResourceController
{
    protected $model;

    public function __construct()
    {
        $this->model = new v_nilai_mahasiswa();
    }

    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound("Data dengan ID $id tidak ditemukan");
        }
    }
}
