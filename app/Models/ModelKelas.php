<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelKelas extends Model
{
    protected $table = "kelas";
    protected $primaryKey = "kode_kelas";
    protected $allowedFields = ['kode_kelas', 'nama_kelas'];
    
    protected $validationRules = [
        'kode_kelas' =>'required',       
        'nama_kelas' =>'required',       
    ];
    protected $validationMessages = [
        'kode_kelas'=>[
            'required'=>'silahkan masukan nama kelas'
        ],
        'nama_kelas'=>[
            'required'=>'silahkan masukan nama kelas'
        ],
    ];
}  
