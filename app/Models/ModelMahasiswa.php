<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelMahasiswa extends Model
{
    protected $table = "mahasiswa";
    protected $primaryKey = "npm";
    protected $allowedFields = ['npm', 'nama_mhs', 'kode_kelas', 'id_prodi'];

    protected $validationRules = [
        'npm' => 'required',
        'nama_mhs' => 'required',
        'kode_kelas' => 'required',
        'id_prodi' => 'required',
    ];

    protected $validationMessages = [
        'npm' => ['required' => 'Silahkan masukkan NPM'],
        'nama_mhs' => ['required' => 'Silahkan masukkan nama mahasiswa'],
        'kode_kelas' => ['required' => 'Silahkan masukkan kode kelas'],
        'id_prodi' => ['required' => 'Silahkan masukkan ID prodi'],
    ];

    // 🔥 Fungsi untuk mendapatkan data mahasiswa dengan informasi prodi dan kelas
    public function getMahasiswaWithProdi()
    {
        return $this->db->table('mahasiswa m')
            ->select([
                'm.npm',
                'm.nama_mhs',
                'm.kode_kelas',
                'p.id_prodi',
                'p.nama_prodi'
            ])
            ->join('prodi p', 'm.id_prodi = p.id_prodi')
            ->join('kelas k', 'm.kode_kelas = k.kode_kelas')
            ->distinct()
            ->orderBy('m.npm', 'ASC')
            ->get()
            ->getResultArray();
    }
}
