@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">{{ $kelas->nama_kelas }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">
                                Add
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nisn</th>
                                        <th>Nama Siswa</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($kelas->detail_kelas))
                                        @forelse ($kelas->detail_kelas as $murid)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $murid->siswa->nisn }}</td>
                                                <td>{{ $murid->siswa->nama }}</td>
                                                <td>{{ $murid->siswa->gender }}</td>
                                                <td>{{ $murid->siswa->alamat }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-toggle="modal" data-target="#ModalEdit"
                                                            title="" class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit ">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <form action="" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" data-toggle="" title=""
                                                                data-id="" data-nama=""
                                                                class="btn btn-link btn-danger deletealertsiswa"
                                                                data-original-title="Hapus">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal Add Siswa --}}

        <div class="modal fade bd-example-modal-lg" id="ModalAdd" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Data
                            Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="">Nama Siswa</label>
                                <input class="form-control" id="nama"></input>
                            </div>
                            <div class="col-6">
                                <label for="">Jurusan</label>
                                <select class="form-control" id="jurusan">
                                    <option selected disabled hidden>Jurusan</option>
                                    <option value="rpl">RPL</option>
                                    <option value="perhotelan">Perhotelan</option>
                                </select>
                            </div>
                        </div>

                        <form action="{{ route('insertdetail') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                            <table class="table" id="tableSiswa" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Jurusan</th>
                                        <th>#Pilih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $s)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $s->nisn }}</td>
                                            <td>{{ $s->nama }}</td>
                                            <td>{{ $s->jurusan }}</td>
                                            <td>
                                                <input type="checkbox" name="id_siswa[]" value="{{ $s->id_siswa }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Siswa</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end modal siswa --}}
    </div>
@endsection
