<?php

namespace App\Models;

use CodeIgniter\Model;

class v_nilai_mahasiswa extends Model
{
    protected $table = 'v_nilai_mahasiswa';  // sesuaikan dengan nama view yang ada di DB
    protected $primaryKey = '';  // sesuaikan primary key jika ada
    protected $allowedFields = ['Kode Mata Kuliah', 'Nama Mata Kuliah', 'Jumlah SKS', 'Nilai', 'Status Kelulusan']; // sesuaikan kolom yang boleh diisi
}
