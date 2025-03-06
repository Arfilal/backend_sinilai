<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelProdi extends Model
{
    protected $table = "prodi";
    protected $primarykey = "id_prodi";
    protected $allowedFields = ['id_prodi', 'nama_prodi'];
    
    protected $validationRules = [
        'id_prodi' =>'required',
        'nama_prodi' =>'required',
    ];
    protected $validationMesaages = [
        'id_prodi'=>[
            'required'=>'silahkan masukan id prodi'
        ],
        'nama_prodi'=>[
            'required'=>'silahkan masukan nama prodi'
        ],
    ];
}
