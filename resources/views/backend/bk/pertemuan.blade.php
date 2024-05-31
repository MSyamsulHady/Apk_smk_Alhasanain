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
                                                                @foreach ($absen as $ab)
                                                                    <tr>
                                                                        <td class="fw-bold">Kelas</td>
                                                                        <td style="width: 1px" class="px-2">:</td>
                                                                        <td>{{ $ab->kelasPelajaran->kelas->nama_kelas }}
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td class="fw-bold">Mata Pelajaran</td>
                                                                        <td style="width: 1px" class="px-2">:</td>
                                                                        <td>{{ $ab->kelasPelajaran->mapel->nama_mapel }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fw-bold">Guru Pengampu</td>
                                                                        <td style="width: 1px" class="px-2">:</td>
                                                                        <td>{{ $ab->kelasPelajaran->guru->nama }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fw-bold">Tahun Pelajaran</td>
                                                                        <td style="width: 1px" class="px-2">:</td>
                                                                        <td>{{ $ab->semester->tahun_ajaran }}</td>
                                                                    </tr>
                                                                @endforeach
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

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPertemuan">
            Add pertemuan
        </button>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table">
                                <thead>
                                    {{-- <table border="1"> --}}
                                    <tr>
                                        <th style="height: 1px" rowspan="2">No</th>
                                        <th rowspan="2">Nis</th>
                                        <th rowspan="2">nama</th>
                                        <th rowspan="3">jenis kelamin</th>
                                    </tr>
                                </thead>
                                @foreach ($absen as $a)
                                    @foreach ($a->kelasPelajaran->kelas->detail_kelas as $dk)
                                        <tbody>
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $dk->siswa->nis }}</td>
                                                <td>{{ $dk->siswa->nama }}</td>
                                                <td>{{ $dk->siswa->gender }}</td>


                                                {{-- <td>1</td> --}}
                                                {{-- <td><form action="{{ route('kelola_absen') }}" method="post">
                                                    @csrf
                                                    <select
                                                        class="form-control @error('keterangan')
                                                    is-invalid
                                                    @enderror"
                                                        name="jurusan">
                                                        @error('jurusan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                        <option selected> -- Pilih -- </option>
                                                        <option>Hadir</option>
                                                        <option>Alpa</option>
                                                        <option>Izin</option>
                                                        <option>Sakit</option>
                                                        <option>bolos</option>
                                                    </select>
                                                </form> </td> --}}
                                            </tr>
                                        </tbody>
                                    @endforeach
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="tambahPertemuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">

                <form action="https://absensipembelajaran.vanzdev.com/guru/absensi" method="POST">
                    <input type="hidden" name="_token" value="jBElUwsiheWZpRthcLec5vsstWOdvK7pDijFESJK">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold poppins" id="exampleModalLabel">Tambah Pertemuan
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="abc" class="col-sm-3 col-form-label">Nama Pembelajaran</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="Akidah Akhlak - X TKJ 1" class="form-control  "
                                                name="abc" id="" placeholder="" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pertemuan_ke" class="col-sm-3 col-form-label">Pertemuan Ke
                                            <small><i>(Angka)</i></small></label>
                                        <div class="col-sm-9">
                                            <input type="number" value="" class="form-control  " name="pertemuan_ke"
                                                id="" placeholder="Masukkan pertemuan ke" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                        <div class="col-sm-9">
                                            <input type="date" value="" class="form-control  " name="tanggal"
                                                id="" placeholder="Pertemuan Ke" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="dari_pukul" class="col-sm-3 col-form-label">Pukul</label>
                                        <div class="col-sm-4">
                                            <input type="time" value="" class="form-control  " name="dari_pukul"
                                                id="" placeholder="Pertemuan Ke" required>
                                        </div>
                                        <div class="col-sm-1 mt-1 text-center">s/d</div>
                                        <div class="col-sm-4">
                                            <input type="time" value="" class="form-control  "
                                                name="sampai_pukul" id="" placeholder="Pertemuan Ke" required>
                                        </div>
                                    </div>




                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn mb-0 btn-primary">Simpan</button>
                            </div>
                        </div>

                </form>

            </div>
        </div>
    </div>
    </div>
@endsection
