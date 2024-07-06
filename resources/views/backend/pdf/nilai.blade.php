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

        /* kop */
        .kop-surat {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .kop-surat .logo {
            float: left;
            width: 15%;
        }

        .kop-surat .logo img {
            width: 100px;
            height: auto;
        }

        .kop-surat .logo-kanan {
            float: right;
            width: 15%;
        }

        .kop-surat .logo-kanan img {
            width: 100px;
            height: auto;
        }

        .kop-surat .header {
            display: inline-block;
            width: 70%;
        }

        .kop-surat .header h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .kop-surat .header h2 {
            margin: 5px 0;
            font-size: 16px;
        }

        .kop-surat .header p {
            margin: 0;
            font-size: 14px;
            font-style: italic;
        }

        .kop-surat .footer {
            clear: both;
            border-top: 2px solid black;
            margin-top: 10px;
            padding-top: 5px;
        }

        .kop-surat .footer p {
            margin: 0;
            font-size: 12px;
        }

        /* end kop */
    </style>
</head>

<body>
    {{-- kop --}}
    <div class="kop-surat">
        <div class="logo">
            <img src="{{ asset('asset_backend/img/logo/yy.png') }}" alt="Logo Kiri">
        </div>
        <div class="header">
            <h1>YAYASAN AL-HASANAIN NU BERAIM</h1>
            <h2>SEKOLAH MENENGAH KEJURUAN AL-HASANAIN</h2>
            <h2>REKAYASA PERANGKAT LUNAK (RPL) & PERHOTELAN</h2>
            <p>Alamat: Kesambik Ngelah Desa Beraim Praya Tengah Lombok Tengah HP. 0818364401</p>
        </div>
        <div class="logo-kanan">
            <img src="{{ asset('asset_backend/img/logo/ah.png') }}" alt="Logo Kanan">
        </div>
        <div class="footer">
            <p>Website: www.smkalhasanain.sch.id E-mail: smkalhasanain08@gmail.com</p>
        </div>
    </div>
    {{-- end kop --}}
    <div>Kelas : {{ $kelas->nama_kelas }}</div>
    <div>Tahun Pelajaran : {{ $kelas->semester->tahun_ajaran }} |
        {{ $kelas->semester->nama_semester }}</div>

    <table class="table_nilai">
        <thead>
            <tr>
                <th class="th_n" rowspan="2">No</th>
                <th class="th_n" rowspan="2">Nis</th>
                <th class="th_n" rowspan="2">Nama</th>
                <th class="th_n" colspan="{{ $colspan_mapel }}">Nilai</th>
            </tr>
            <tr>
                @foreach ($kelas->rombel as $mapel)
                    <td class="td_n" style="width: 150px">{{ $mapel->mapel->nama_mapel }}</td>
                @endforeach
                <td class="td_n" style="width: 150px">Rata-Rata</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($kelas->trx_siswa as $ss)
                <tr>
                    <td class="td_n">{{ $loop->iteration }}</td>
                    <td class="td_n">{{ $ss->siswa->nis }}</td>
                    <td class="td_n">{{ $ss->siswa->nama }}</td>
                    @foreach ($ss->siswa->nilai as $nil)
                        <td class="td_n">{{ $nil->nilai }}</td>
                    @endforeach
                    <td class="td_n">{{ $nilais[$ss->id_siswa] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script type="text/javascript">
        window.print();
    </script>


</body>
