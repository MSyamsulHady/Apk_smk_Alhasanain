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

    public function rombel()
    {
        return $this->hasOne(Rombel::class, 'id_rombel', 'id_rombel');
    }
    public function siswa()
    {
        return $this->HasOne(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
