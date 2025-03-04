<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelMahasiswa extends Model
{
    protected $table = "mahasiswa";
    protected $primarykey = "npm";
    protected $allowedFields = ['npm', 'nama_mhs', 'kode_kelas', 'id_prodi'];
    
    protected $validationRules = [
        'npm' =>'required',
        'nama_mhs' =>'required',
        'kode_kelas' =>'required',
        'id_prodi' =>'required',
    ];
    protected $validationMesaages = [
        'npm'=>[
            'required'=>'silahkan masukan npm'
        ],
        'nama_mhs'=>[
            'required'=>'silahkan masukan nama mahasiswa'
        ],
        'kode_kelas'=>[
            'required'=>'silahkan masukan kode kelas'
        ],
        'id_prodi'=>[
            'required'=>'silahkan masukan id prodi'
        ],
    ];
}  
