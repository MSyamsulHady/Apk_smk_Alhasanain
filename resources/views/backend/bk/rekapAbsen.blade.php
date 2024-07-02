<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Absensi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            text-align: center;
            margin: 20px 0;
        }

        .header div {
            margin: 5px 0;
        }

        .jum {
            column-span: 5;
        }
    </style>
</head>

<body>
    <div class="header">
        <div><strong>REKAPITULASI ABSENSI</strong></div>
        <div>SMK Al Hasanain Nu Beraim</div>
        <div>Jln.kesambik ngelah desa beraim kec. Praya Tengah, kab. Lombok Tengan, Prov. Nusa Tenggara Barat </div>
        <hr>
    </div>
    <div>Mata Pelajaran : {{ $data->mapel->nama_mapel }}</div>
    <div>Kelas : {{ $data->kelas->nama_kelas }}</div>
    <div>Guru Pengampu : {{ $data->guru->nama }}</div>
    <div>Tahun Pelajaran : {{ $data->kelas->semester->tahun_ajaran }} |
        {{ $data->kelas->semester->nama_semester }}</div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nis</th>
                <th rowspan="2">Nama</th>
                <th colspan="{{ $jumlahPertemuan }}" class="text-center">Pertemuan</th>
                <th colspan="5" class="text-center">Jumlah</th>
            </tr>
            <tr>
                @foreach ($per as $p)
                    <td>{{ $p }}</td>
                @endforeach
                <td class="text-center">H</td>
                <td class="text-center">I</td>
                <td class="text-center">S</td>
                <td class="text-centet">A</td>
                <td class="text-center">B</td>
            </tr>

        </thead>
        <tbody>

            @foreach ($data->trx as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->siswa->nis }}</td>
                    <td>{{ $item->siswa->nama }}</td>
                    @foreach ($per as $p)
                        <td>
                            @if (!empty($absenSiswa[$item->id_trx_rombel_siswa]))
                                @if (!empty($absenSiswa[$item->id_trx_rombel_siswa][$p]))
                                    {{ $absenSiswa[$item->id_trx_rombel_siswa][$p] }}
                                @endif
                            @else
                                <select name="{{ $p }}[{{ $item->id_trx_rombel_siswa }}]"
                                    class="keterangan-select" required>
                                    <option value="">?</option>
                                    <option value="H">H</option>
                                    <option value="I">I</option>
                                    <option value="S">S</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            @endif
                        </td>
                    @endforeach
                    <td>{{ $kehadiranSiswa[$item->id_trx_rombel_siswa]['total_hadir'] }}
                    </td>
                    <td>{{ $kehadiranSiswa[$item->id_trx_rombel_siswa]['total_izin'] }}
                    </td>
                    <td>{{ $kehadiranSiswa[$item->id_trx_rombel_siswa]['total_sakit'] }}
                    </td>
                    <td>{{ $kehadiranSiswa[$item->id_trx_rombel_siswa]['total_alpa'] }}
                    </td>
                    <td>{{ $kehadiranSiswa[$item->id_trx_rombel_siswa]['total_bolos'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>
