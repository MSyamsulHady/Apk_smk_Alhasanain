<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rombel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_rombel';
    protected $guarded = [];

    public function trx()
    {
        return $this->hasMany(TrxRombel_siswa::class, 'id_rombel', 'id_rombel');
    }
    public function guru()
    {
        return $this->hasOne(Guru::class, 'id_guru', 'id_guru');
    }
    public function kelas(): HasOne
    {
        return $this->hasOne(Kelas::class, 'id_kelas', 'id_kelas');
    }
    public function mapel()
    {
        return $this->hasOne(Pelajaran::class, 'id_mapel', 'id_mapel');
    }
    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class, 'id_rombel', 'id_rombel');
    }
}
