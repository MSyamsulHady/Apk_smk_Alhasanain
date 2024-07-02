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
                                                                    <td></td>
                                                                </tr>
                                                                {{-- <tr>
                                                                    <td class="fw-bold">Guru Pengampu</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td> {{ $data->rombel->guru->nama }}</td>

                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Tahun Pelajaran</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td>{{ $ab->semester->tahun_ajaran }}</td>
                                                                </tr> --}}
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




        <th scope="col" class="border-dark" data-bs-toggle="modal" data-bs-placement="top" title="Klik untuk detail">
            <div class="" data-bs-target="#detailPertemuan/12" data-bs-toggle="modal">
                <div class="text-center align-middle fw-bold">

                </div>

            </div>
        </th>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <button type="button" class="btn btn-success mt-3 mb-3" data-toggle="modal"
                            data-target="#tambahPertemuan"
                            href="https://absensipembelajaran.vanzdev.com/admin/rekapabsensi/print/1" target="_blank"
                            class="btn btn-success btn-sm mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-printer-fill me-1" viewBox="0 0 16 16">
                                <path
                                    d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                                <path
                                    d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                            </svg>
                            Cetak Rekapitulasi</a>

                        </button>
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#Import">
                            <i class="fa fa-upload"></i> Import
                        </button>
                        <table class="table_nilai">
                            <thead>
                                <tr>
                                    <th class="th_n" rowspan="2">No</th>
                                    <th class="th_n" rowspan="2">Nis</th>
                                    <th class="th_n" rowspan="2">Nama</th>
                                    <th class="th_n text-center" colspan="{{ $jmlh }}">Nilai</th>
                                </tr>
                                <tr>
                                    @foreach ($kelas->first() as $key)
                                        <td class="th_n text-center">{{ $key->mapel->nama_mapel }}</td>
                                    @endforeach
                                    <td class="th_n">Rata-Rata</td>
                                </tr>
                            </thead>
                            <tbody>
                                <form id="f_nilai" action="{{ route('inputNilai') }}" method="post">
                                    @csrf
                                    @foreach ($siswa as $siswas)
                                        <tr>
                                            <td class="td_n">{{ $loop->iteration }}</td>
                                            <td class="td_n">{{ $siswas->siswa->nis }}</td>
                                            <td class="td_n">{{ $siswas->siswa->nama }}</td>

                                            @foreach ($kelas->first() as $key)
                                                <td class="td_n" width="100">
                                                    <input type="number"
                                                        name="{{ $key->mapel->id_mapel . "[$siswas->id_siswa]" }}">
                                                </td>
                                            @endforeach
                                            <td class="td_n"></td>
                                        </tr>
                                    @endforeach
                                </form>
                            </tbody>
                        </table>
                        <div class="mt-3">
                            <button form="f_nilai" type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
