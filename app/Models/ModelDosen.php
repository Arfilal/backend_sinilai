<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelDosen extends Model
{
    protected $table = "dosen";
    protected $primaryKey = "nidn";
    protected $allowedFields = ['nidn', 'nama_dosen'];
    
    protected $validationRules = [
        'nidn' =>'required',
        'nama_dosen' =>'required',
       
    ];
    protected $validationMessages = [
        'nidn'=>[
            'required'=>'silahkan masukan nama'
        ],
        'nama_dosen'=>[
            'required'=>'silahkan masukan nama'
        ],
    ];
}
