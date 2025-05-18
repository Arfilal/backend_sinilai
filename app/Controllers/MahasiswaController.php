<?php
namespace App\Controllers;

use App\Models\MahasiswaModel;
use CodeIgniter\API\ResponseTrait;

class MahasiswaController extends BaseController
{
    use ResponseTrait;

    public function getMahasiswaByNpm($npm)
    {
        $mahasiswaModel = new MahasiswaModel();

        $mahasiswa = $mahasiswaModel
            ->select('mahasiswa.npm, mahasiswa.nama, prodi.nama_prodi')
            ->join('prodi', 'prodi.id = mahasiswa.prodi_id')
            ->where('mahasiswa.npm', $npm)
            ->first();

        if ($mahasiswa) {
            return $this->respond($mahasiswa);
        } else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}
