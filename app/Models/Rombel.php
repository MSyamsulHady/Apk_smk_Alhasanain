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
}
