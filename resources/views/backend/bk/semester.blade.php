@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Semester</h2>
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
                                        <th>Tahun Ajaran</th>
                                        <th>Semester</th>
                                        <th>Status</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semester as $smt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $smt->tahun_ajaran }}</td>
                                            <td>{{ $smt->nama_semester }}</td>
                                            <td>{{ $smt->status }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#ModalEdit{{ $smt->id_semester }}" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('deleteSemester', $smt->id_semester) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" data-toggle="" title=""
                                                            data-id="{{ $smt->id_semester }}"
                                                            data-nama="{{ $smt->nama_semester }}  | {{ $smt->tahun_ajaran }}"
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
                                    <form action="{{ route('insert_semester') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="tahun_ajaran">tahun ajaran</label>
                                                        <input type="text"
                                                            class="form-control @error('tahun_ajaran')  is-invalid
                                                            @enderror"
                                                            id="tahun_ajaran" name="tahun_ajaran"
                                                            placeholder="tahun_ajaran">
                                                        @error('tahun_ajaran')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_semester">semester</label>
                                                        <select
                                                            class="form-control @error('semster')
                                                                is-invalid
                                                                @enderror"
                                                            name="nama_semester">
                                                            @error('semster')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                            <option selected> -- Pilih -- </option>
                                                            <option>Ganjil</option>
                                                            <option>Genap</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <label>Status</label><br />
                                                    <label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" name="status"
                                                            value="Aktif">
                                                        <span class="form-radio-sign">Aktif</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="status"
                                                            value="Tidak Aktif">
                                                        <span class="form-radio-sign">Tidak Aktif</span>
                                                    </label>
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

                        {{-- Modal Update --}}
                        @foreach ($semester as $smtr)
                            <div class="modal fade " id="ModalEdit{{ $smtr->id_semester }}" tabindex="-1" role="dialog"
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
                                        <form action="{{ route('update_semester', $smtr->id_semester) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <div class="form-group">
                                                            <label for="tahun_ajaran">tahun ajaran</label>
                                                            <input type="text"
                                                                class="form-control @error('tahun_ajaran')  is-invalid
                                                                @enderror"
                                                                id="tahun_ajaran" name="tahun_ajaran"
                                                                placeholder="tahun_ajaran"
                                                                value="{{ $smtr->tahun_ajaran }}">
                                                            @error('tahun_ajaran')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_semester">semester</label>
                                                            <select
                                                                class="form-control @error('semster')
                                                                    is-invalid
                                                                    @enderror"
                                                                name="nama_semester">
                                                                @error('semster')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                <option selected>{{ $smtr->nama_semester }}</option>
                                                                <option>Ganjil</option>
                                                                <option>Genap</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-check">
                                                            <label>Status</label><br />
                                                            <label class="form-radio-label">
                                                                <input class="form-radio-input" type="radio"
                                                                    name="status" value="Aktif"
                                                                    {{ $smtr->status == 'Aktif' ? 'checked' : '' }}>
                                                                <span class="form-radio-sign">Aktif</span>
                                                            </label>
                                                            <label class="form-radio-label ml-3">
                                                                <input class="form-radio-input" type="radio"
                                                                    name="status" value="Tidak Aktif"
                                                                    {{ $smtr->status == 'Tidak Aktif' ? 'checked' : '' }}>
                                                                <span class="form-radio-sign">Tidak Aktif</span>
                                                            </label>
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
                        @endforeach
                        {{-- Modal Update --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
