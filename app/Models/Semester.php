<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_semester';

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function nilai()
    {
        return $this->belongsTo(Nilai::class, 'id_nilai');
    }
    public function user()
    {
        return $this->hasMany(User::class, 'id_semester', 'id_semester');
    }
    public function absen()
    {
        return $this->hasMany(Absen::class, 'id_absen', 'id_absen');
    }
}
