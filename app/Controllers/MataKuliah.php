<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelMataKuliah;

class MataKuliah extends BaseController
{
    use ResponseTrait;
    function __construct()
    {
        $this->model = new ModelMataKuliah();
    }
    public function index()
    {
        $data = $this->model->orderBy('nama_matkul', 'asc')->findAll();
        return $this->respond($data, 200);
    }
    public function show($kode_matkul = null)
    {
        $data = $this->model->where('kode_matkul', $kode_matkul)->findAll();
        if($data){
            return $this->respond($data,200);
        }else{
            return $this->failNotFound("data tidak ditemukan untuk kode_matkul $kode_matkul");
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
    public function update($kode_matkul = null)
    {
        $data = $this->request->getRawInput();
        $data['kode_matkul'] = $kode_matkul;
    
        // Pastikan data dengan NPM ada sebelum update
        $isExists = $this->model->where('kode_matkul', $kode_matkul)->first();
        if (!$isExists) {
            return $this->failNotFound("Data tidak ditemukan untuk kode_matkul $kode_matkul");
        }
    
        // Gunakan update() dengan where()
        if ($this->model->where('kode_matkul', $kode_matkul)->set($data)->update()) {
            return $this->respond([
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data mahasiswa dengan kode_matkul $kode_matkul berhasil diperbarui"
                ]
            ]);
        }
    
        return $this->fail("Gagal mengupdate data mahasiswa.");
    }
    
    public function delete($kode_matkul)
    {
        $data = $this->model->where('kode_matkul', $kode_matkul)->findAll();
        
        if ($data) {
            $this->model->where('kode_matkul', $kode_matkul)->delete(); // Perbaikan metode delete()
    
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data dengan kode_matkul $kode_matkul berhasil dihapus"
                ]
            ];
            return $this->respond($response); // Perbaikan dari responddelete()
        } else {
            return $this->failNotFound("Data dengan kode_matkul $kode_matkul tidak ditemukan");
        }
    }
}    