<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelViewNilai extends Model
{
    protected $table = 'v_nilai';  // sesuaikan dengan nama view yang ada di DB
    protected $primaryKey = 'id_nilai';  // sesuaikan primary key jika ada
    protected $allowedFields = ['npm', 'kode_matkul', 'nidn', 'tugas', 'uts', 'uas', 'nilai_akhir', 'status']; // sesuaikan kolom yang boleh diisi
}
