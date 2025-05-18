<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class prodi1 extends Model
{
    protected $table = 'prodi';

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_prodi', 'id_prodi');
    }
}
