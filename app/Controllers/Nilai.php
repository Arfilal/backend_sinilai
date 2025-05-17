<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelNilai;
use App\Controllers\BaseController;

class Nilai extends BaseController
{
    use ResponseTrait;
    protected $model;

    public function __construct()
    {
        $this->model = new ModelNilai();
    }

    public function index()
    {
        $data = $this->model->orderBy('npm', 'asc')->findAll();
        return $this->respond($data, 200);
    }

    public function show($id_nilai = null)
    {
        $data = $this->model->where('id_nilai', $id_nilai)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data nilai tidak ditemukan untuk ID $id_nilai");
        }
    }

 public function create()
{
    $json = $this->request->getJSON();

    if ($json) {
        $npm = $json->npm ?? null;
        $kode_matkul = $json->kode_matkul ?? null;
        $nidn = $json->nidn ?? null;
        $tugas = $json->tugas ?? null;
        $uts = $json->uts ?? null;
        $uas = $json->uas ?? null;
    } else {
        // fallback ke form-data
        $npm = $this->request->getVar('npm');
        $kode_matkul = $this->request->getVar('kode_matkul');
        $nidn = $this->request->getVar('nidn');
        $tugas = $this->request->getVar('tugas');
        $uts = $this->request->getVar('uts');
        $uas = $this->request->getVar('uas');
    }

    if (empty($npm) || empty($kode_matkul) || empty($nidn) || empty($tugas) || empty($uts) || empty($uas)) {
        return $this->fail("Data tidak lengkap", 400);
    }

    $data = [
        'npm' => $npm,
        'kode_matkul' => $kode_matkul,
        'nidn' => $nidn,
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
    ];

    if ($this->model->insert($data)) {
        $id_nilai_baru = $this->model->getInsertID();
        $data_baru = $this->model->find($id_nilai_baru);

        return $this->respond([
            'success' => true,
            'message' => 'Nilai berhasil ditambahkan!',
            'data' => $data_baru
        ], 201);
    } else {
        return $this->failServerError('Gagal menambahkan data nilai');
    }
}


    public function edit($id_nilai)
    {
        $nilai = $this->model->find($id_nilai);
        if (!$nilai) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data tidak ditemukan']);
        }
        return $this->response->setJSON($nilai);
    }

 public function update($id_nilai)
{
    $existing = $this->model->find($id_nilai);
    if (!$existing) {
        return $this->failNotFound("Data dengan ID $id_nilai tidak ditemukan");
    }

    // Ambil data dari JSON (jika dikirim dalam format JSON)
    $json = $this->request->getJSON();

    if (!$json) {
        return $this->fail("Format data tidak valid", 400);
    }

    $npm = $json->npm ?? null;
    $kode_matkul = $json->kode_matkul ?? null;
    $nidn = $json->nidn ?? null;
    $tugas = $json->tugas ?? null;
    $uts = $json->uts ?? null;
    $uas = $json->uas ?? null;

    // Validasi
    if (empty($npm) || empty($kode_matkul) || empty($nidn) || empty($tugas) || empty($uts) || empty($uas)) {
        return $this->fail("Data tidak lengkap", 400);
    }

    if (!is_numeric($tugas) || !is_numeric($uts) || !is_numeric($uas)) {
        return $this->fail("Nilai tugas, UTS, dan UAS harus berupa angka", 400);
    }

    $nilai_akhir = ($tugas + $uts + $uas) / 3;
    $status = $nilai_akhir >= 50 ? 'Lulus' : 'Tidak Lulus';

    $data = [
        'npm' => $npm,
        'kode_matkul' => $kode_matkul,
        'nidn' => $nidn,
        'tugas' => $tugas,
        'uts' => $uts,
        'uas' => $uas,
        'nilai_akhir' => $nilai_akhir,
        'status' => $status,
    ];

    if ($this->model->update($id_nilai, $data)) {
        return $this->respond([
            'message' => "Data nilai dengan ID $id_nilai berhasil diperbarui"
        ], 200);
    } else {
        return $this->fail("Gagal memperbarui data nilai", 500);
    }
}


    public function delete($id_nilai)
    {
        $data = $this->model->where('id_nilai', $id_nilai)->findAll();

        if ($data) {
            $this->model->delete($id_nilai);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data nilai dengan ID $id_nilai berhasil dihapus"
                ]
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound("Data nilai dengan ID $id_nilai tidak ditemukan");
        }
    }

    public function getNilaiByNama()
    {
        $nama_mhs = $this->request->getGet('nama_mhs');
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