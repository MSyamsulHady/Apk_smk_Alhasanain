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
    protected $fillable = ['pertemuanKe', 'tanggal_pertemuan', 'mulai', 'selesai'];


    public function Absen()
    {
        return $this->belongsTo(Absen::class, 'id_absen', 'id_absen');
    }
    public function rombel()
    {
        return $this->belongsTo(Rombel::class, 'id_rombel', 'id_rombel');
    }
}
