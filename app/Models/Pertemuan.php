<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'pertemuans';
    protected $primaryKey = 'id_pertemuan';
    protected $fillable = ['id_absen', 'pertemuan', 'mulai', 'akhir', 'keterangan', 'tanggal_pertemuan'];


    public function Absen()
    {
        return $this->belongsTo(Absen::class, 'id_absen', 'id_absen');
    }
}
