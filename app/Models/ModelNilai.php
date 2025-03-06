<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelNilai extends Model
{
    protected $table = "nilai";
    protected $primaryKey = "id_nilai";
    protected $allowedFields = ['npm', 'kode_matkul', 'nidn', 'tugas', 'uts', 'uas', 'nilai_akhir', 'status'];
    
    protected $validationRules = [
        'id_nilai' =>'required',
        'npm' =>'required',
        'kode_matkul' =>'required',
        'nidn' =>'required',
        'tugas' =>'required',
        'uts' =>'required',
        'uas' =>'required',
        'nilai_akhir' =>'required',
        'status' =>'required',
    ];

    protected $validationMessages = [
        'id_nilai'=> ['required'=>'Silahkan masukkan id nilai'],
        'npm'=> ['required'=>'Silahkan masukkan npm'],
        'kode_matkul'=> ['required'=>'Silahkan masukkan kode matkul'],
        'nidn'=> ['required'=>'Silahkan masukkan nidn'],
        'tugas'=> ['required'=>'Silahkan masukkan tugas'],
        'uts'=> ['required'=>'Silahkan masukkan uts'],
        'uas'=> ['required'=>'Silahkan masukkan uas'],
        'nilai_akhir'=> ['required'=>'Silahkan masukkan nilai_akhir'],
        'status'=> ['required'=>'Silahkan masukkan status'],
    ];

    // 🔥 Tambahkan fungsi untuk mengambil data nilai mahasiswa berdasarkan nama
    public function getNilaiMahasiswa($nama_mhs, $semester)
    {
        return $this->db->table('nilai n')
            ->select('n.kode_matkul as "Kode Mata Kuliah", mk.nama_matkul as "Nama Mata Kuliah", mk.sks as "Jumlah SKS", n.nilai_akhir as "Nilai", n.status as "Status Kelulusan"')
            ->join('mahasiswa m', 'n.npm = m.npm')
            ->join('mata_kuliah mk', 'n.kode_matkul = mk.kode_matkul')
            ->where('m.nama_mhs', $nama_mhs)
            ->where('mk.semester', $semester)
            ->get()
            ->getResultArray();
    }
}
