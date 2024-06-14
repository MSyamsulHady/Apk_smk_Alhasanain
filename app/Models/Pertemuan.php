<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Roman;

class Pertemuan extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'pertemuans';
    protected $primaryKey = 'id_pertemuan';
    protected $guarded = [];


    public function absen()
    {
        return $this->hasMany(Absen::class, 'id_pertemuan', 'id_pertemuan');
    }
    public function rombel()
    {
        return $this->belongsTo(Rombel::class, 'id_rombel', 'id_rombel');
    }
}
