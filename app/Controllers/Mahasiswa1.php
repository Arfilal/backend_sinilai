<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa1;

class MahasiswaController extends Controller
{
    public function getMahasiswaByNpm($npm)
    {
        $mahasiswa = Mahasiswa::with('prodi')->where('npm', $npm)->first();

        if ($mahasiswa) {
            return response()->json([
                'npm' => $mahasiswa->npm,
                'nama' => $mahasiswa->nama,
                'prodi' => $mahasiswa->prodi->nama_prodi
            ]);
        } else {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
    }
}
