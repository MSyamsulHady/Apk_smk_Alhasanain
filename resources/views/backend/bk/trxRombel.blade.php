@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Detail Rombel</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nis</th>
                                    <th>Nama Siswa</th>
                                    {{-- <th>#Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($model->kelas->trx_siswa as $dt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dt->siswa->nis }}</td>
                                        <td>{{ $dt->siswa->nama }}</td>
                                        {{-- <td>
                                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>
                                                Tambah Nilai</a>
                                            <a href="" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i>Lihat
                                                Nilai</a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
