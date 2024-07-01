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
                        {{-- <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Nis</th>
                                        <th rowspan="2">Nama</th>
                                        <th colspan="{{ $data->mapel->count() }}">Nilai</th>
                                        <th rowspan="2">Action</th>
                                    </tr>
                                    <tr>
                                        @foreach ($data->mapel as $mat)
                                            <td>{{ $mat->nama_mapel }}</td>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->siswa->nis }}</td>
                                            <td>{{ $item->siswa->nama }}</td>
                                            @foreach ($data->mapel as $mp)
                                                <form action="" method="post" id="{{ $item->siswa->id_siswa }}">
                                                    <td style="width:5%">
                                                        <input type="number" class="form-control"
                                                            name="{{ $mp->id_mapel }}">
                                                    </td>
                                                </form>
                                            @endforeach
                                            <td>
                                                <button @class(['btn btn-sm btn-success']) type="submit" value="submit"
                                                    form="{{ $item->siswa->id_siswa }}">Simpan</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
