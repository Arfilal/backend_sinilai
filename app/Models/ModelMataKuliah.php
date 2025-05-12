<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelMataKuliah extends Model
{
    protected $table = "mata_kuliah";
    protected $primaryKey = "kode_matkul";
    protected $allowedFields = ['kode_matkul', 'nama_matkul', 'semester', 'sks'];
    
    protected $validationRules = [
        'kode_matkul' =>'required',
        'nama_matkul' =>'required',
        'semester' =>'required',
        'sks' =>'required',
       
    ];
    protected $validationMessages = [
        'kode_matkul'=>[
            'required'=>'silahkan masukan kode matkul'
        ],
        'nama_matkul'=>[
            'required'=>'silahkan masukan nama matkul'
        ],
        'semester'=>[
            'required'=>'silahkan masukan semester'
        ],
        'sks'=>[
            'required'=>'silahkan masukan sks'
        ],
    ];
}
