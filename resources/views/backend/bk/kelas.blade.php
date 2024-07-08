@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Kelas</h2>
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
                                <i class="fa fa-plus "></i> <span class="ml-1">Tambah</span>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kelas</th>
                                        <th>Semester</th>
                                        <th>Periode</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelas as $kls)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kls->nama_kelas }}</td>
                                            <td>{{ $kls->semester->nama_semester }}</td>
                                            <td>{{ $kls->semester->tahun_ajaran }}</td>
                                            <td>
                                                <button type="button" data-toggle="modal"
                                                    data-target="#modalAddPeserta{{ $kls->id_kelas }}" title=""
                                                    class="btn btn-success btn-sm" data-original-title="Edit ">
                                                    <i class="fa fa-plus"></i> Peserta
                                                </button>
                                                <div class="form-button-action">

                                                    <button type="button" data-toggle="modal"
                                                        data-target="#ModalEdit{{ $kls->id_kelas }}" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('deleteKelas', $kls->id_kelas) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" data-toggle="" title=""
                                                            data-id="{{ $kls->id_kelas }}"
                                                            data-nama="{{ $kls->nama_kelas }}"
                                                            class="btn btn-link btn-danger deletealertsiswa"
                                                            data-original-title="Hapus">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- add peserta -->
                        @foreach ($kelas as $item)
                            <x-modal title="PESERTA DIDIK" id="modalAddPeserta{{ $item->id_kelas }}" class="modal-xl">
                                <form action="{{ route('add_peserta', $item->id_kelas) }}" method="post">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-data" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nis</th>
                                                    <th>Nama</th>
                                                    <th>Jurusan</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($siswa as $pst)
                                                    <tr>
                                                        <td class="td-left">{{ $loop->iteration }}</td>
                                                        <td>{{ $pst->nis }}</td>
                                                        <td>{{ $pst->nama }}</td>
                                                        <td>{{ $pst->jurusan }}</td>
                                                        <td>
                                                            <input type="checkbox" name="id_siswa[]"
                                                                value="{{ $pst->id_siswa }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-sm btn-success">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </x-modal>
                        @endforeach
                        <!-- end add peserta -->
                        {{-- modal Add --}}
                        <div class="modal fade " id="ModalAdd" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Input Semester</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('insertKelas') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg">

                                                    <div class="form-group">
                                                        <label for="nama_kelas">Nama Kelas</label>
                                                        <input type="text"
                                                            class="form-control @error('nama_kelas')  is-invalid
                                                            @enderror"
                                                            id="nama_kelas" name="nama_kelas" placeholder="nama_kelas">
                                                        @error('nama_kelas')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_mapel">
                                                            <h5>Semester</h5>
                                                        </label>
                                                        <select class="custom-select" id="inputGroupSelect02"
                                                            name="id_semester">
                                                            <option selected> --pilih semester--
                                                            </option>
                                                            @foreach ($semester as $smtr)
                                                                <option value="{{ $smtr->id_semester }}">
                                                                    {{ $smtr->nama_semester }}
                                                                    {{ $smtr->tahun_ajaran }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- end modal Add --}}

                        {{-- end modal Add --}}
                        @foreach ($kelas as $kl)
                            {{-- modal update --}}
                            <div class="modal fade " id="ModalEdit{{ $kl->id_kelas }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Input Semester</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('update_kelas', $kl->id_kelas) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg">

                                                        <div class="form-group">
                                                            <label for="nama_kelas">Nama Kelas</label>
                                                            <input type="text"
                                                                class="form-control @error('nama_kelas')  is-invalid
                                                           @enderror"
                                                                id="nama_kelas" name="nama_kelas"
                                                                placeholder="nama_kelas" value="{{ $kl->nama_kelas }}">
                                                            @error('nama_kelas')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_mapel">
                                                                <h5>Semester</h5>
                                                            </label>
                                                            <select class="custom-select" id="inputGroupSelect02"
                                                                name="id_semester">
                                                                <option selected value="{{ $kl->id_semester }}">
                                                                    {{ $kl->semester->nama_semester }}
                                                                </option>
                                                                @foreach ($semester as $smtr)
                                                                    <option value="{{ $smtr->id_semester }}">
                                                                        {{ $smtr->nama_semester }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- endmodal update --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
