<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasPelajaran extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kelasPelajaran';
    protected $fillable = [
        'id_mapel',
        'id_guru',
        'id_kelas'
    ];
    public function mapel()
    {
        return $this->hasOne(Pelajaran::class, 'id_mapel', 'id_mapel');
    }
    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_kelas', 'id_kelas');
    }
    public function guru()
    {
        return $this->hasOne(Guru::class, 'id_guru', 'id_guru');
    }
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_nilai');
    }
    public function absen()
    {
        return $this->hasMany(Absen::class, 'id_absen', 'id_absen');
    }
}
