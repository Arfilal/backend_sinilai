<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelDosen extends Model
{
    protected $table = "dosen";
    protected $primarykey = "nidn";
    protected $allowedFields = ['nidn', 'nama_dosen'];
    
    protected $validationRules = [
        'nidn' =>'required',
        'nama_dosen' =>'required',
       
    ];
    protected $validationMesaages = [
        'nidn'=>[
            'required'=>'silahkan masukan nama'
        ],
        'nama_dosen'=>[
            'required'=>'silahkan masukan nama'
        ],
    ];
}
