<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $i = 1;
        foreach ($collection as $row) {
            if ($i > 1) {
                $data['nisn'] = $row[0];
                $data['nis'] = $row[1];
                $data['nik'] = $row[2];
                $data['nama'] = $row[3];
                $data['alamat'] = $row[4];
                $data['gender'] = $row[5];
                $data['tanggal_lahir'] = $row[6];
                $data['orang_tua'] = $row[7];
                $data['nohp_ortu'] = !empty($row[8]) ? $row[8] : '';
                $data['jurusan'] = $row[9];
                $data['foto'] = !empty($row[10]) ? $row[10] : '';
                // dd($row);
                Siswa::create($data);
            }
            $i++;
        }
    }
}
