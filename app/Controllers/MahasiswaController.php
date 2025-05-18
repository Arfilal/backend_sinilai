<?php

namespace App\Controllers;

use App\Models\Mahasiswa;

class MahasiswaController extends BaseController
{
    public function getMahasiswaByNpm($npm)
    {
        $mahasiswa = Mahasiswa::with('prodi')->where('npm', $npm)->first();

        if ($mahasiswa) {
            return $this->response->setJSON([
                'npm' => $mahasiswa->npm,
                'nama' => $mahasiswa->nama,
                'prodi' => $mahasiswa->prodi->nama_prodi
            ]);
        } else {
            return $this->response->setJSON(['error' => 'Data tidak ditemukan'])->setStatusCode(404);
        }
    }
}
