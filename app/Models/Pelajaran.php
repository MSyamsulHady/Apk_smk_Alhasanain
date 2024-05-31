<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'pelajarans';
    protected $primaryKey = 'id_mapel';
    protected $fillable = ['id_guru', 'nama_mapel', 'kurikulum', 'muatan'];


    public function guru()
    {
        return $this->hasOne(Guru::class, 'id_guru', 'id_guru');
    }
    public function kelasPelajaran()
    {
        return $this->belongsTo(KelasPelajaran::class, 'id_kelasPelajaran', 'id_kelasPelajaran');
    }
}
