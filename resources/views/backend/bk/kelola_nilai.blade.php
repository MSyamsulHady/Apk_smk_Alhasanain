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
                                                                    <td class="fw-bold">Tahun Pelajaran</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    {{-- <td>{{ $ab->semester->tahun_ajaran }}</td> --}}
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

                        <button type="button" class="btn btn-success mt-3" data-toggle="modal"
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Nama Siswa</th>
                                        <th colspan="8" class="text-center">Nilai</th>
                                        <th rowspan="2">#Action</th>
                                    <tr>

                                        <th>Nilai Tugas 1</th>
                                        <th>Nilai Tugas 2</th>
                                        <th>Nilai Tugas 3</th>
                                        <th>Nilai Tugas 4</th>
                                        <th>Nilai Tugas 5</th>
                                        <th>Nilai Tugas 6</th>
                                        <th>Nilai Uts</th>
                                        <th>Nilai Uas</th>

                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->trx as $dt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dt->siswa->nama }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- <table border="1" cellspacing="10" cellpadding="0">
                            <thead>
                                <tr>
                                    <th rowspan="2">NO</th>
                                    <th rowspan="2">NAMA</th>
                                    <th colspan="3">NILAI</th>
                                </tr>
                                <tr>

                                    <th>MTK</th>
                                    <th>B. INGGRIS</th>
                                    <th>B. INDONESIA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <td>3</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                            </tbody>
                        </table> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
