<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelMahasiswa;

class Mahasiswa extends BaseController
{
    use ResponseTrait;
    function __construct()
    {
        $this->model = new ModelMahasiswa();
    }
    public function index()
    {
        $data = $this->model->orderBy('nama_mhs', 'asc')->findAll();
        return $this->respond($data, 200);
    }
    public function show($npm = null)
    {
        $data = $this->model->where('npm', $npm)->findAll();
        if($data){
            return $this->respond($data,200);
        }else{
            return $this->failNotFound("data tidak ditemukan untuk npm $npm");
        }
    }
    public function create()
    {
        $data = $this->request->getPost();
        if (!$this->model->save($data)){
            return $this->fail();
        }
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'berhasil masukan data mahasiswa'
            ]
        ];
        return $this->respond($response);
    }
    public function update($npm = null)
    {
        $data = $this->request->getRawInput();
        $data['npm'] = $npm;
        $isExists = $this->model->where('npm', $npm)->findAll();
        // if (!$isExists)
        // {
        //     return $this->failNotFound("data tidak ditemukan npm $npm");
        // }

        if($this->model->save($data)){
            return $this->respond($data);
        }

        $response = [
            'status' =>200,
            'error' =>null,
            'messages' =>[
                'success' =>"Data mahasiswa dengan npm $npm berhasil diupdate"
            ]
        ];
        return $this->respond($response);
    }

    public function delete($npm)
    {
        $data = $this->model->where('npm', $npm)->findAll();
        
        if ($data) {
            $this->model->where('npm', $npm)->delete(); // Perbaikan metode delete()
    
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data dengan NPM $npm berhasil dihapus"
                ]
            ];
            return $this->respond($response); // Perbaikan dari responddelete()
        } else {
            return $this->failNotFound("Data dengan NPM $npm tidak ditemukan");
        }
    }
}    