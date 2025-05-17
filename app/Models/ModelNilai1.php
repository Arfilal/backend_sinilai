<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelViewNilai extends Model
{
    protected $table = 'v_nilai_lengkap'; // gunakan nama view
    protected $primaryKey = 'id_nilai';   // gunakan PK dari tabel asli
    protected $allowedFields = [];        // kosong karena ini view, readonly
    protected $returnType = 'array';
    protected $useTimestamps = false;
}
