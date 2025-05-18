<?php
class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'npm';
    public $incrementing = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }
}
