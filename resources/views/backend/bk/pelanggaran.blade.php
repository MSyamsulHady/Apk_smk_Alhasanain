@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Pelanggaran Siswa</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">
                                Add
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Pelanggaran</th>
                                        <th>Sanksi</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($kelas as $kls)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kls->guru->nama }}</td>
                                            <td>{{ $kls->nama_kelas }}</td>
                                            <td>{{ $kls->semester->nama_semester }}</td>
                                            <td>{{ $kls->ruangan }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="modal" data-target="#ModalEdit"
                                                        title="" class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="Edit ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                        {{-- modal Add --}}
                        {{-- <div class="modal fade " id="ModalAdd" tabindex="-1" role="dialog"
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
                                                        <label for="nama_mapel">
                                                            <h5>Wali Kelas</h5>
                                                        </label>
                                                        <select class="custom-select" id="inputGroupSelect02"
                                                            name="id_guru">
                                                            <option selected> --pilih Guru--
                                                            </option>
                                                            @foreach ($guru as $gr)
                                                                <option value="{{ $gr->id_guru }}">
                                                                    {{ $gr->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_kelas">Kelas</label>
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
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ruangan">Kelas</label>
                                                        <input type="text"
                                                            class="form-control @error('ruangan')  is-invalid
                                                            @enderror"
                                                            id="ruangan" name="ruangan" placeholder="ruangan">
                                                        @error('ruangan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                        </div> --}}
                        {{-- end modal Add --}}


                        {{-- modal update --}}
                        {{-- @foreach ($kelas as $kl)
                            <div class="modal fade " id="ModalEdit{{ $kl->id_kelas }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Input Semester</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                            <label for="nama_mapel">
                                                                <h5>Wali Kelas</h5>
                                                            </label>
                                                            <select class="custom-select" id="inputGroupSelect02"
                                                                name="id_guru">
                                                                <option selected value="{{ $kl->id_guru }}">
                                                                    {{ $kl->guru->nama }}
                                                                </option>
                                                                @foreach ($guru as $gr)
                                                                    <option value="{{ $gr->id_guru }}">
                                                                        {{ $gr->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_kelas">Kelas</label>
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
                                                                    {{ $kl->semester->nama_semester }} </option>
                                                                @foreach ($semester as $smtr)
                                                                    <option value="{{ $smtr->id_semester }}">
                                                                        {{ $smtr->nama_semester }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ruangan">Ruangan</label>
                                                            <input type="text"
                                                                class="form-control @error('ruangan')  is-invalid
                                                            @enderror"
                                                                id="ruangan" name="ruangan" placeholder="ruangan"
                                                                value="{{ $kl->ruangan }}">
                                                            @error('ruangan')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
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
                        @endforeach --}}
                        {{-- endmodal update --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
