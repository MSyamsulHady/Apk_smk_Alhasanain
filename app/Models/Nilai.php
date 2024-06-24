<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Nilai extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_nilai';
    protected $guraded = [];

    public function trx_siswa()
    {
        return $this->hasOne(TrxRombel_siswa::class, 'id_trx_rombel_siswa');
    }
    public function semester()
    {
        return $this->HasOne(Semester::class, 'id_semester');
    }
}
