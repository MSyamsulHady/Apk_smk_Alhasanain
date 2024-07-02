@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Nilai Siswa</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelas</th>
                                        <th>Jumlah Mata Pelajaran</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rombel as $rmb)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rmb->kelas->nama_kelas ?? '' }}</td>
                                            <td>{{ $rmb->jml_mapel }}</td>
                                            <td>
                                                <a href="{{ route('kelola_nilai', $rmb->id_kelas) }}"
                                                    class="btn btn-sm btn-success"><i class=""></i>&nbsp;
                                                    Pilih kelas</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- untuk tampilan guru --}}
                            {{-- <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nis</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td width="200"><input type="number" class="form-control form-control-sm"></td>
                                        <td><a href="" class="btn btn-link btn-primary btn-lg"><i
                                                    class="fa fa-edit"></i></a></td>
                                    </tr>
                                </tbody>
                            </table> --}}
                            {{-- /untuk tampilan guru --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
