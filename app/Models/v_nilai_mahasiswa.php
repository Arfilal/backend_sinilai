<?php

namespace App\Models;

use CodeIgniter\Model;

class v_nilai_mahasiswa extends Model
{
    protected $table = 'v_nilai_mahasiswa';
    protected $primaryKey = 'id_dummy'; // bisa isi kolom apa saja yg unik (atau bahkan fiktif jika hanya untuk bypass error)
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
}

