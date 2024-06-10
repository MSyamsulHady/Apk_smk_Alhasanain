<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TrxRombel_siswa extends Model
{
    use HasFactory;
    protected $primaryKey = "id_trx_rombel_siswa";



    /**
     * Get the user associated with the TrxRombel_siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
