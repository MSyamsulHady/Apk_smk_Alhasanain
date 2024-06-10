<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'absens';
    protected $primaryKey = 'id_absen';
    protected $fillable = ['id_siswa', 'id_pertemuan', 'keterangan'];

    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class, 'id_pertemuan', 'id_pertemuan');
    }
}
