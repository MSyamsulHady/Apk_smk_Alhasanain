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
                                        <th>Mata Pelajaran</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rombel as $rm)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rm->kelas->nama_kelas }}</td>
                                            <td>{{ $rm->mapel->nama_mapel }}</td>
                                            <td>
                                                <a href="{{ route('kelola_nilai', $rm->id_rombel) }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-eye"></i>Pilih
                                                    Rombel</a>
                                            </td>
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
