<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelDosen;

class Dosen extends BaseController
{
    use ResponseTrait;
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
        if($data){
            return $this->respond($data,200);
        }else{
            return $this->failNotFound("data tidak ditemukan untuk nidn $nidn");
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
    public function update($nidn = null)
    {
        $data = $this->request->getRawInput();
        $data['nidn'] = $nidn;
    
        // Pastikan data dengan NPM ada sebelum update
        $isExists = $this->model->where('nidn', $nidn)->first();
        if (!$isExists) {
            return $this->failNotFound("Data tidak ditemukan untuk NIDN $nidn");
        }
    
        // Gunakan update() dengan where()
        if ($this->model->where('nidn', $nidn)->set($data)->update()) {
            return $this->respond([
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data mahasiswa dengan NIDN $nidn berhasil diperbarui"
                ]
            ]);
        }
    
        return $this->fail("Gagal mengupdate data mahasiswa.");
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