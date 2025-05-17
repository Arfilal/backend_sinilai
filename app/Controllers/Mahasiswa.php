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

    public function create()
    {
        // Ambil data dari request
        $npm = $this->request->getVar('npm');
        $nama_mhs = $this->request->getVar('nama_mhs');
        $kode_kelas = $this->request->getVar('kode_kelas');
        $id_prodi = $this->request->getVar('id_prodi');

        // Pastikan data valid
        if (empty($npm) || empty($nama_mhs)) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap']);
        }

        // Masukkan data ke dalam model
        $data = [
            'npm' => $npm,
            'nama_mhs' => $nama_mhs,
            'kode_kelas' => $kode_kelas,
            'id_prodi' => $id_prodi,

        ];

        // Insert data ke database
        if ($this->model->insert($data)) {
            return $this->response->setJSON(['message' => 'Aspirasi berhasil dikirim']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal mengirim aspirasi']);
        }
    }

    public function edit($npm)
    {
        $mahasiswa = $this->model->find($npm);
        if (!$mahasiswa) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data tidak ditemukan']);
        }
        return $this->response->setJSON($mahasiswa);
    }

    public function update($npm)
    {
        // Ambil data dari request
        $nama_mhs = $this->request->getVar('nama_mhs');
        $kode_kelas = $this->request->getVar('kode_kelas');
        $id_prodi = $this->request->getVar('id_prodi');

        // Validasi data
        if (!$this->validate([
            'nama_mhs' => 'required|min_length[3]',
            'kode_kelas' => 'required',
            'id_prodi' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Cek apakah data mahasiswa dengan npm tersebut ada
        $existing = $this->model->where('npm', $npm)->first();
        if (!$existing) {
            return $this->failNotFound("Data tidak ditemukan untuk NPM $npm");
        }

        // Data yang akan diperbarui
        $data = [
            'nama_mhs' => $nama_mhs,
            'kode_kelas' => $kode_kelas,
            'id_prodi' => $id_prodi
        ];

        // Update data
        $updated = $this->model->update($npm, $data);

        if ($updated) {
            return $this->respond([
                'status' => 200,
                'messages' => ['success' => "Data berhasil diperbarui"]
            ]);
        }

        return $this->fail("Gagal memperbarui data.");
    }

    public function delete($npm)
    {
        // Cari data mahasiswa berdasarkan npm
        $data = $this->model->where('npm', $npm)->first();

        // Cek apakah data mahasiswa ditemukan
        if ($data) {
            // Hapus data mahasiswa berdasarkan npm
            $this->model->where('npm', $npm)->delete();

            // Response sukses jika data berhasil dihapus
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data mahasiswa dengan NPM $npm berhasil dihapus"
                ]
            ];
            return $this->respond($response);
        } else {
            // Jika data mahasiswa tidak ditemukan
            return $this->failNotFound("Data mahasiswa dengan NPM $npm tidak ditemukan");
        }
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