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
    protected $fillable = ['pertemuanKe', 'tanggal_pertemuan', 'mulai', 'selesai'];


    public function Absen()
    {
        return $this->belongsTo(Absen::class, 'id_absen', 'id_absen');
    }
}
