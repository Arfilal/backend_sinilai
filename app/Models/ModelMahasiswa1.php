<?php

namespace App\Models;
use CodeIgniter\Model;

class ModelMahasiswa1 extends Model
{
    protected $table = 'view_mahasiswa'; // Gunakan VIEW
    protected $primaryKey = 'id_nilai'; // Pastikan id_nilai ada di VIEW
    protected $returnType = 'array'; // Mengembalikan data sebagai array
    protected $useAutoIncrement = false; // VIEW tidak mendukung AutoIncrement

    // public function getNilaiMahasiswa($nama_mhs, $semester)
    // {
    //     return $this->where('nama_mahasiswa', $nama_mhs)
    //                 ->where('semester', $semester)
    //                 ->findAll();
    // }
}
