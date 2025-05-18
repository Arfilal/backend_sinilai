<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
protected $table = 'mahasiswa';
protected $primaryKey = 'npm';
protected $allowedFields = ['npm', 'nama', 'prodi_id'];
protected $returnType = 'array';

public function prodi()
{
    return $this->belongsTo(Prodi::class, 'prodi_id');
}

}
