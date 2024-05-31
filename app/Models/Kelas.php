<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $primaryKey = 'id_kelas';
    protected $table = 'kelas';
    protected $fillable = ['id_guru', 'nama_kelas', 'id_semester', 'ruangan'];



    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
    public function semester()
    {
        return $this->hasOne(Semester::class, 'id_semester', 'id_semester');
    }
    public function detail_kelas()
    {
        return $this->hasMany(Detail_kelas::class, 'id_kelas', 'id_kelas');
    }
    // public function kelasPelajaran()
    // {
    //     return $this->belongsTo(KelasPelajaran::class, 'id_kelasPelajaran', 'id_kelasPelajaran');
    // }
}
