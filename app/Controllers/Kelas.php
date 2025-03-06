<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelKelas;

class Kelas extends BaseController
{
    use ResponseTrait;
    function __construct()
    {
        $this->model = new ModelKelas();
    }
    public function index()
    {
        $data = $this->model->orderBy('nama_kelas', 'asc')->findAll();
        return $this->respond($data, 200);
    }
    public function show($kode_kelas = null)
    {
        $data = $this->model->where('kode_kelas', $kode_kelas)->findAll();
        if($data){
            return $this->respond($data,200);
        }else{
            return $this->failNotFound("data tidak ditemukan untuk kode_kelas $kode_kelas");
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
    public function update($kode_kelas = null)
    {
        $data = $this->request->getRawInput();
        $data['kode_kelas'] = $kode_kelas;
    
        // Pastikan data dengan NPM ada sebelum update
        $isExists = $this->model->where('kode_kelas', $kode_kelas)->first();
        if (!$isExists) {
            return $this->failNotFound("Data tidak ditemukan untuk kode_kelas $kode_kelas");
        }
    
        // Gunakan update() dengan where()
        if ($this->model->where('kode_kelas', $kode_kelas)->set($data)->update()) {
            return $this->respond([
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data mahasiswa dengan kode_kelas $kode_kelas berhasil diperbarui"
                ]
            ]);
        }
    
        return $this->fail("Gagal mengupdate data mahasiswa.");
    }
    
    public function delete($kode_kelas)
    {
        $data = $this->model->where('kode_kelas', $kode_kelas)->findAll();
        
        if ($data) {
            $this->model->where('kode_kelas', $kode_kelas)->delete(); // Perbaikan metode delete()
    
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data dengan kode_kelas $kode_kelas berhasil dihapus"
                ]
            ];
            return $this->respond($response); // Perbaikan dari responddelete()
        } else {
            return $this->failNotFound("Data dengan kode_kelas $kode_kelastidak ditemukan");
        }
    }
}    