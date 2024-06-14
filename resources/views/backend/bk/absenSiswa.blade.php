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



        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#tambahPertemuan"
            href="https://absensipembelajaran.vanzdev.com/admin/absensi/create"
            class="btn btn-sm float-left btn-primary btn-icon-split float-right mt-1 ms-3" data-bs-toggle="modal"
            data-bs-placement="right" title="Tambah Pertemuan" data-bs-target="#tambahPertemuan">
            <span class="icon text-white-30 pe-1 pb-1 pt-0" style="padding-top: 0.20rem !important;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-square" viewBox="0 0 16 16">
                    <path
                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg>
            </span>
            <span class="text">Pertemuan</span>
            </a>
        </button>

        <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#tambahPertemuan"
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
                        <div class="table-responsive">


                            <div class="container mt-5">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">NIS</th>
                                            <th rowspan="2">Nama Siswa</th>
                                            <th rowspan="2">L/P</th>
                                            <th colspan="36" class="text-center">Pertemuan Ke</th>
                                            {{-- <th colspan="1"class="text-center">Jumlah</th> --}}
                                        </tr>
                                        <tr>
                                            @foreach ($data->pertemuan as $pr)
                                                <th scope="col" class="border-dark" title="Klik untuk detail">
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#pertemuan{{ $loop->iteration }}">
                                                        <div class="text-center align-middle fw-bold">
                                                            {{ $pr->pertemuanKe }}
                                                        </div>
                                                    </button>
                                                </th>

                                                {{-- <th>{{ $pr->pertemuanKe }}</th> --}}
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absenSiswa as $a)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $a['nis'] }}</td>
                                                <td>{{ $a['nama'] }}</td>
                                                <td>{{ $a['jk'] }}</td>

                                                @foreach ($data->pertemuan as $pr)
                                                    <td>

                                                        @foreach ($a['absen'] as $ab)
                                                            @if ($pr->id_pertemuan == $ab->id_pertemuan)
                                                                {{ $ab->keterangan }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>

                        </div>



                        @foreach ($data->pertemuan as $pr)
                            <div class="modal fade" id="pertemuan{{ $loop->iteration }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold poppins" id="exampleModalLabel">Detail Pertemuan
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="callout callout-warning my-1">
                                                <div class="row">
                                                    <div class="col-4 fw-bold">
                                                        Pembelajaran:
                                                    </div>
                                                    <div class="col-8">
                                                        : {{ $data->mapel->nama_mapel }}
                                                        - {{ $data->kelas->nama_kelas }}
                                                    </div>
                                                    <div class="col-4 fw-bold">
                                                        Pertemuan Ke:
                                                    </div>
                                                    <div class="col-8">
                                                        : {{ $pr->pertemuanKe }}
                                                    </div>
                                                    <div class="col-4 fw-bold">
                                                        Hari, Tanggal
                                                    </div>
                                                    <div class="col-8">
                                                        : {{ $pr->tanggal_pertemuan }}

                                                    </div>
                                                    <div class="col-4 fw-bold">
                                                        Pukul
                                                    </div>
                                                    <div class="col-8">
                                                        : {{ $pr->mulai }} s/d
                                                        {{ $pr->selesai }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button class="btn btn-danger btn-sm" data-bs-target="#hapusPertemuan12"
                                                data-bs-toggle="modal">Hapus Pertemuan</button>
                                            <button class="btn btn-warning btn-sm"
                                                data-target="#editPertemuan{{ $pr->id_pertemuan }}"
                                                data-toggle="modal">Edit Pertemuan</button>
                                            <a href="{{ route('tambahAbsen', [$pr->id_rombel, $pr->id_pertemuan]) }}"
                                                class="btn btn-primary btn-sm text-white">Kelola
                                                Absen
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- model tamah pertemuan --}}
                        <div class="modal fade" id="tambahPertemuan" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">

                                <form action="{{ route('pertemuan', $data->id_rombel) }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold poppins" id="exampleModalLabel">Tambah
                                                Pertemuan
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <label for="pertemuan_ke"
                                                            class="col-sm-3 col-form-label">Pertemuan Ke
                                                            <small><i>(Angka)</i></small></label>
                                                        <div class="col-sm-9">
                                                            <input type="number" value="" class="form-control  "
                                                                name="pertemuanKe" id=""
                                                                placeholder="Masukkan pertemuan ke" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="tanggal"
                                                            class="col-sm-3 col-form-label">Tanggal</label>
                                                        <div class="col-sm-9">
                                                            <input type="date" value="" class="form-control  "
                                                                name="tanggal_pertemuan" id=""
                                                                placeholder="Pertemuan Ke" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="dari_pukul"
                                                            class="col-sm-3 col-form-label">Pukul</label>
                                                        <div class="col-sm-4">
                                                            <input type="time" value="" class="form-control  "
                                                                name="mulai" id="" placeholder="Pertemuan Ke"
                                                                required>
                                                        </div>
                                                        <div class="col-sm-1 mt-1 text-center">s/d</div>
                                                        <div class="col-sm-4">
                                                            <input type="time" value="" class="form-control  "
                                                                name="selesai" id="" placeholder="Pertemuan Ke"
                                                                required>
                                                        </div>
                                                    </div>




                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn mb-0 btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </div>


                                </form>

                            </div>
                        </div>

                        {{-- end modal pertemuan --}}

                        {{-- modal edit pertemuan --}}
                        @foreach ($data->pertemuan as $pr)
                            <div class="modal fade" id="editPertemuan{{ $pr->id_pertemuan }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">

                                    <form action="{{ route('updatePertemuan', $pr->id_pertemuan) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold poppins" id="exampleModalLabel">edit
                                                    Pertemuan
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <label for="pertemuan_ke"
                                                                class="col-sm-3 col-form-label">Pertemuan Ke
                                                                <small><i>(Angka)</i></small></label>
                                                            <div class="col-sm-9">
                                                                <input type="number" value="{{ $pr->pertemuanKe }}"
                                                                    class="form-control  " name="pertemuanKe"
                                                                    id="" placeholder="Masukkan pertemuan ke"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="tanggal"
                                                                class="col-sm-3 col-form-label">Tanggal</label>
                                                            <div class="col-sm-9">
                                                                <input type="date"
                                                                    value="{{ $pr->tanggal_pertemuan }}"
                                                                    class="form-control  " name="tanggal_pertemuan"
                                                                    id="" placeholder="Pertemuan Ke" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="dari_pukul"
                                                                class="col-sm-3 col-form-label">Pukul</label>
                                                            <div class="col-sm-4">
                                                                <input type="time" value="{{ $pr->mulai }}"
                                                                    class="form-control  " name="mulai" id=""
                                                                    placeholder="Pertemuan Ke" required>
                                                            </div>
                                                            <div class="col-sm-1 mt-1 text-center">s/d</div>
                                                            <div class="col-sm-4">
                                                                <input type="time" value="{{ $pr->selesai }}"
                                                                    class="form-control  " name="selesai" id=""
                                                                    placeholder="Pertemuan Ke" required>
                                                            </div>
                                                        </div>




                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn mb-0 btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        {{-- edit modal --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
