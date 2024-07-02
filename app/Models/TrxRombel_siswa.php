<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TrxRombel_siswa extends Model
{
    use HasFactory;
    protected $primaryKey = "id_trx_rombel_siswa";
    protected $guarded = [];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_kelas', 'id_kelas');
    }
    public function absen()
    {
        return $this->hasMany(Absen::class, 'id_absen', 'id_absen');
    }
}
