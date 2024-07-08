@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Kelas : {{ $kelas->nama_kelas }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('cetakPDF', $kelas->id_kelas) }}" target="_blank" class="btn btn-success"><i
                                    class="fa fa-print"></i> Cetak PDF</a>
                        </div>
                        <div class="table-responsive">
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
                                            @for ($i = 0; $i < $kelas->rombel->count(); $i++)
                                                @if (!empty($ss->siswa->nilai[$i]))
                                                    <td class="td_n">{{ $ss->siswa->nilai[$i]->nilai }}</td>
                                                @else
                                                    <td class="td_n">0</td>
                                                @endif
                                            @endfor
                                            <td class="td_n">{{ $nilais[$ss->id_siswa] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
