<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelDosen extends Model
{
     // Nama tabel yang digunakan
    protected $table = "dosen";
    // Primary key dari tabel
    protected $primaryKey = "nidn";
    // Menonaktifkan auto increment karena NIDN ditentukan manual
    protected $useAutoIncrement = false; 
     // Field yang boleh diisi secara massal (insert/update)
    protected $allowedFields = ['nidn', 'nama_dosen'];

    // Aturan validasi untuk field saat melakukan insert/update
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

    // Format pengembalian data dari query adalah array
    protected $returnType = 'array'; 
    // Menonaktifkan penggunaan created_at dan updated_at
    protected $useTimestamps = false; 
}
