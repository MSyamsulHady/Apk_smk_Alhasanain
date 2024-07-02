<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'absens';
    protected $primaryKey = 'id_absen';
    protected $guarded = [];

    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class, 'id_pertemuan', 'id_pertemuan');
    }
    public function trx()
    {
        return $this->belongsTo(TrxRombel_siswa::class, 'id_trx_rombel_siswa', 'id_trx_rombel_siswa');
    }
    public function semester()
    {
        return $this->hasOne(Semester::class, 'id_semester', 'id_semester');
    }
}
