<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelProdi;

class Prodi extends BaseController
{
    use ResponseTrait;
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
        if($data){
            return $this->respond($data,200);
        }else{
            return $this->failNotFound("data tidak ditemukan untuk id_prodi $id_prodi");
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
    public function update($id_prodi = null)
    {
        $data = $this->request->getRawInput();
        $data['id_prodi'] = $id_prodi;
    
        // Pastikan data dengan NPM ada sebelum update
        $isExists = $this->model->where('id_prodi', $id_prodi)->first();
        if (!$isExists) {
            return $this->failNotFound("Data tidak ditemukan untuk id_prodi $id_prodi");
        }
    
        // Gunakan update() dengan where()
        if ($this->model->where('id_prodi', $id_prodi)->set($data)->update()) {
            return $this->respond([
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data mahasiswa dengan id_prodi $id_prodi berhasil diperbarui"
                ]
            ]);
        }
    
        return $this->fail("Gagal mengupdate data mahasiswa.");
    }
    
    public function delete($id_prodi)
    {
        $data = $this->model->where('id_prodi', $id_prodi)->findAll();
        
        if ($data) {
            $this->model->where('id_prodi', $id_prodi)->delete(); // Perbaikan metode delete()
    
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data dengan id_prodi $id_prodi berhasil dihapus"
                ]
            ];
            return $this->respond($response); // Perbaikan dari responddelete()
        } else {
            return $this->failNotFound("Data dengan id_prodi $id_prodi tidak ditemukan");
        }
    }
}    