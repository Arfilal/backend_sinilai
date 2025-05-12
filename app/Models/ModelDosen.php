<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelDosen extends Model
{
    protected $table = "dosen";
    protected $primaryKey = "nidn";
    protected $useAutoIncrement = false; // NIDN bukan auto increment
    protected $allowedFields = ['nidn', 'nama_dosen'];

    // Validasi saat insert/update
    protected $validationRules = [
        'nidn'        => 'required|numeric|min_length[5]|max_length[20]',
        'nama_dosen'  => 'required|min_length[3]',
    ];

    protected $validationMessages = [
        'nidn' => [
            'required'   => 'Silakan masukkan NIDN',
            'numeric'    => 'NIDN harus berupa angka',
            'min_length' => 'NIDN minimal 5 karakter',
            'max_length' => 'NIDN maksimal 20 karakter',
        ],
        'nama_dosen' => [
            'required'   => 'Silakan masukkan nama dosen',
            'min_length' => 'Nama dosen minimal 3 karakter',
        ],
    ];

    protected $returnType = 'array'; // agar hasil query lebih fleksibel (array)
    protected $useTimestamps = false; // matikan jika tabel tidak punya created_at & updated_at
}
