<?php

namespace App\Imports;

use App\Models\Guru;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class GuruImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $i = 1;
        foreach ($collection as $rows) {
            if ($i > 1) {
                $data['nuptk'] = !empty($rows[0]) ? $rows[0] : '';
                $data['nama'] = $rows[1];
                $data['alamat'] = $rows[2];
                $data['tgl_lahir'] = $rows[3];
                $data['tlp'] = $rows[4];
                $data['gender'] = $rows[5];
                $data['pend_terakhir'] = $rows[6];
                $data['foto'] = !empty($rows[7]) ? $rows[7] : '';
                Guru::create($data);
            }
            $i++;
        }
    }
}
