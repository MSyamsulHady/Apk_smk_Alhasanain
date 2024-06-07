<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_rombel';
    protected $guarded = [];

    public function trx_rombel_siswa()
    {
        return $this->belongsTo(TrxRombel_siswa::class, 'id_rombel');
    }
    public function guru()
    {
        return $this->hasOne(Guru::class, 'id_guru', 'id_guru');
    }
    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_kelas', 'id_kelas');
    }
    public function mapel()
    {
        return $this->hasOne(Pelajaran::class, 'id_mapel', 'id_mapel');
    }
}
