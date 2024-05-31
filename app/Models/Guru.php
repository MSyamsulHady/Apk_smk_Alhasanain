<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $primaryKey = 'id_guru';
    protected $fillable = ['nuptk', 'nama', 'alamat', 'tgl_lahir', 'tlp', 'gender', 'pend_terakhir', 'foto'];

    public function  pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'id_mapel');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
