<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_kelas extends Model
{
    use HasFactory;
    protected $table = 'detail_kelas';
    protected  $primaryKey = "id_detail";

    protected $fillable = ['id_siswa', 'id_kelas'];


    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id_siswa', 'id_siswa');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
