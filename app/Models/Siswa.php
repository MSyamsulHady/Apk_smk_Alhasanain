<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Return_;

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

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_nilai');
    }

    public function Absen(){
        return  $this->belongsTo(Absen::class,'id_absen','id_absen');
    }
}
