<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_nilai';
    protected $fillable = [
        'id_siswa',
        'id_kelasPelajaran',
        'id_semester',
        'tugas',
        'uts',
        'uas'
    ];
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id_siswa', 'id_siswa');
    }
    public function kelasPelajaran()
    {
        return $this->belongsTo(KelasPelajaran::class, 'id_kelasPelajaran');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester');
    }
}
