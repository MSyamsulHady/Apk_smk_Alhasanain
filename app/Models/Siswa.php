<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'nisn',
        'nis',
        'nik',
        'nama',
        'alamat',
        'gender',
        'tanggal_lahir',
        'orang_tua',
        'nohp_ortu',
        'jurusan',
        'foto'
    ];

    public function detail_kelas()
    {
        return $this->hasOne(Detail_kelas::class, 'id_detail');
    }
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_nilai');
    }
}
