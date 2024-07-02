@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-3">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="callout callout-warning ">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="table-responsive">
                                                            <table class="table-borderless">


                                                                <tr>
                                                                    <td class="fw-bold">Kelas</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td>{{ $data->kelas->nama_kelas }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td class="fw-bold">Mata Pelajaran</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td>
                                                                        {{ $data->mapel->nama_mapel }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Guru Pengampu</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td> {{ $data->guru->nama }}</td>

                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Pukul</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td>{{ $dp->mulai }} / {{ $dp->selesai }}</td>

                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Hari</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td>{{ $dp->hari }}</td>

                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Tahun Pelajaran</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td>{{ $data->kelas->semester->tahun_ajaran }}
                                                                    </td>

                                                                </tr>


                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive py-1">
                            <div class="table-responsive">
                                <form id="absenForm"
                                    action="{{ route('simpanAbsen', [$data->id_rombel, $dp->id_pertemuan]) }}"
                                    method="post">
                                    @csrf
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" ">No</th>
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
                                                                @else
                                                                    <select
                                                                        name="{{ $p }}[{{ $item->id_trx_rombel_siswa }}]"
                                                                        class="keterangan-select" required>
                                                                        <option value="">?</option>
                                                                        <option value="H">H</option>
                                                                        <option value="I">I</option>
                                                                        <option value="S">S</option>
                                                                        <option value="A">A</option>
                                                                        <option value="B">B</option>
                                                                    </select>
                                                                @endif
                                                            @else
                                                                <select
                                                                    name="{{ $p }}[{{ $item->id_trx_rombel_siswa }}]"
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
                                </form>
                                <button id="saveButton" class="btn btn-primary btn-sm ml-2">simpan</button>

                                <script>
                                    document.getElementById('saveButton').addEventListener('click', function() {
                                        document.getElementById('absenForm').submit();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
