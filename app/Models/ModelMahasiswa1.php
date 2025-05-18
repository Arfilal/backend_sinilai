<?php
namespace App\Models;

use CodeIgniter\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'npm';
    protected $allowedFields = ['npm', 'nama', 'prodi_id'];
    protected $returnType = 'array';

    // Tidak ada relasi otomatis seperti Eloquent Laravel
}
