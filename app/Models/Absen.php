<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $table = 'absens';
    protected  $primaryKey = "id_absen";
    protected $fillable = ['id_kelasPelajaran', 'id_semester', 'tanggal_absen', 'keterangan'];

    public function kelasPelajaran()
    {
        return $this->belongsTo(KelasPelajaran::class, 'id_kelasPelajaran', 'id_kelasPelajaran');
    }
    public function semester()
    {
        return $this->hasOne(Semester::class, 'id_semester', 'id_semester');
    }
    // public function Pertemuan()
    // {
    //     $this->hasMany(::class, 'id_pertemuan', 'id_pertemuan');
    // }
}
