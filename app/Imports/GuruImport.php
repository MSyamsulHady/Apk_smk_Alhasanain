<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Log;

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
                $guru = Guru::create($data);

                Log::info('Created Guru with ID: ' . $guru->id_guru);

                // Buat user berdasarkan data guru yang baru dibuat
                $user = User::create([
                    'username' => $data['nuptk'],
                    'password' => Hash::make($data['nuptk']),
                    'role' => 'Guru',
                    'id_guru' => $guru->id_guru,
                ]);
                Log::info('Created User: ', $user->toArray());
            }
            $i++;
        }
    }
}
