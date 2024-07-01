@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold "> Mata Pelajaran</h2>
                    </div>
                    {{-- <div class="ml-md-auto py-2 py-md-0">
                        <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
                        <a href="#" class="btn btn-secondary btn-round">Add Customer</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            {{-- <a href="" class="btn btn-primary"> <b>+</b> Add </a> --}}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">
                                Add
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Mata Pelajaran</th>
                                        <th>Mata Pelajaran</th>
                                        <th>KKM</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelajaran as $pel)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pel->kode_mapel }}</td>
                                            <td>{{ $pel->nama_mapel }}</td>
                                            <td>{{ $pel->kkm }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#ModalEdit{{ $pel->id_mapel }}" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="" method="POST">
                                                        @csrf
                                                        @method('okus')
                                                        <button type="button" data-toggle="" title="" data-id=""
                                                            data-nama="" class="btn btn-link btn-danger deletealertsiswa"
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
                            <!-- Button trigger modal -->


                            <!-- Modal Add -->
                            <div class="modal fade bd-example-modal-lg" id="ModalAdd" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Form tambah Pelajaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('mapelinsert') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <label for="kode_mapel">
                                                            <h5>Kode Mata Pelajaran</h5>
                                                        </label>
                                                        <input type="text"
                                                            class="form-control @error('kode_mapel')
                                                        is-invalid
                                                        @enderror"
                                                            placeholder="Kode Mata Pelajaran" name="kode_mapel"><br>
                                                        @error('kode_mapel')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                        <label for="nama_mapel">
                                                            <h5>Mata Pelajaran</h5>
                                                        </label>
                                                        <input type="text"
                                                            class="form-control @error('nama_mapel')
                                                        is-invalid
                                                        @enderror"
                                                            placeholder="Mata Pelajaran" name="nama_mapel"><br>
                                                        @error('nama_mapel')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                        <label for="kkm">
                                                            <h5>KKM</h5>
                                                        </label>
                                                        <input type="text"
                                                            class="form-control @error('kkm')
                                                        is-invalid
                                                        @enderror"
                                                            placeholder="Mata Pelajaran" name="kkm"><br>
                                                        @error('kkm')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                            </div>
                            <!-- End Modal -->

                            <!-- Modal Update -->
                            @foreach ($pelajaran as $pl)
                                <x-modal title="Form Edit Pelajaran" id="ModalEdit{{ $pl->id_mapel }}">
                                    <form action="{{ route('updatemapel', $pl->id_mapel) }}" method="POST">
                                        @csrf
                                        @method('put')

                                        <div class="row">
                                            <div class="col-lg">
                                                <label for="kode_mapel">
                                                    <h5>Kode Mata Pelajaran</h5>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('kode_mapel')
                                                        is-invalid
                                                        @enderror"
                                                    placeholder="Kode Mata Pelajaran" name="kode_mapel"
                                                    value="{{ $pl->kode_mapel }}"><br>
                                                @error('kode_mapel')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                                <label for="nama_mapel">
                                                    <h5>Mata Pelajaran</h5>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('nama_mapel')
                                                        is-invalid
                                                        @enderror"
                                                    placeholder="Mata Pelajaran" name="nama_mapel"
                                                    value="{{ $pl->nama_mapel }}"><br>
                                                @error('nama_mapel')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                                <label for="kkm">
                                                    <h5>KKM</h5>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('kkm')
                                                        is-invalid
                                                        @enderror"
                                                    placeholder="KKM" name="kkm" value="{{ $pl->kkm }}"><br>
                                                @error('kkm')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </x-modal>
                            @endforeach
                            <!-- End Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
