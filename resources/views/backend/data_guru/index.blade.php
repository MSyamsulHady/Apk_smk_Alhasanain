@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Data Guru</h2>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">
                                Add
                            </button>
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#Import">
                                Import
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NUPTK</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No HP</th>
                                        <th>Pendidikan Terakhir</th>
                                        <th>Foto</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guru as $gr)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @empty($gr->nuptk)
                                                    -
                                                @endempty
                                                {{ $gr->nuptk }}
                                            </td>
                                            <td>{{ $gr->nama }}</td>
                                            <td>{{ $gr->alamat }}</td>
                                            <td>{{ $gr->tgl_lahir }}</td>
                                            <td>{{ $gr->gender }}</td>
                                            <td>{{ $gr->tlp }}</td>
                                            <td>{{ $gr->pend_terakhir }}</td>
                                            <td>
                                                @empty($gr->foto)
                                                    -
                                                @endempty
                                                <img src="{{ asset('Foto_guru/' . $gr->foto) }}" alt=""
                                                    width="50">
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#ModalEdit{{ $gr->id_guru }}" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('delete_guru', $gr->id_guru) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="button" data-toggle="" title=""
                                                            class="btn btn-link btn-danger deletealert "
                                                            data-id="{{ $gr->id_guru }}" data-nama="{{ $gr->nama }}"
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
                            <!-- Modal Import -->
                            <div class="modal fade" id="Import" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel">
                                                Updload File</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('importGuru') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <label for="">Upload File</label>
                                                <div class="custom-file">
                                                    <input type="file" name="file" class="custom-file-input"
                                                        id="customFile">
                                                    <label class="custom-file-label" for="customFile">pilih file</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Import -->
                            <!-- Modal Add -->
                            <div class="modal fade bd-example-modal-lg" id="ModalAdd" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title text-center" id="exampleModalLabel">Form
                                                Tambah Data Guru</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('insert_guru') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <div class="form-group">
                                                            <label for="nuptk">NUPTK</label>
                                                            <input type="text" class="form-control" id="nuptk"
                                                                name="nuptk" placeholder="NUPTK">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama">Nama Lengkap</label>
                                                            <input type="text" class="form-control" id="nama"
                                                                name="nama" placeholder="Nama Lengkap">
                                                        </div>
                                                        <div class="form-check">
                                                            <label>Jenis Kelamin</label><br />
                                                            <label class="form-radio-label">
                                                                <input class="form-radio-input" type="radio"
                                                                    name="gender" value="laki-laki">
                                                                <span class="form-radio-sign">Laki-Laki</span>
                                                            </label>
                                                            <label class="form-radio-label ml-3">
                                                                <input class="form-radio-input" type="radio"
                                                                    name="gender" value="perempuan">
                                                                <span class="form-radio-sign">Perempuan</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="tlp">No HP</label>
                                                            <input type="text" class="form-control" name="tlp"
                                                                placeholder="No HP">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" name="tgl_lahir">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pend_terakhir">Pendidikan</label>
                                                            <select class="form-control" name="pend_terakhir">
                                                                <option selected> -- Pilih -- </option>
                                                                <option>S1</option>
                                                                <option>S2</option>
                                                                <option>S3</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <div class="form-group">
                                                            <label for="">Alamat</label>
                                                            <textarea name="alamat" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <div class="form-group">
                                                            <label for="foto">Foto</label>
                                                            <input type="file" class="form-control-file"
                                                                name="foto" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <!-- Modal Update -->
                            @foreach ($guru as $gp)
                                <div class="modal fade bd-example-modal-lg" id="ModalEdit{{ $gp->id_guru }}"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-center" id="exampleModalLabel">Form
                                                    Edit Data Guru</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/dataguru/update/{{ $gp->id_guru }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg">
                                                            <div class="form-group">
                                                                <label for="nuptk">NUPTK</label>
                                                                <input type="text" class="form-control" id="nuptk"
                                                                    name="nuptk" placeholder="NUPTK"
                                                                    value="{{ $gp->nuptk }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama">Nama Lengkap</label>
                                                                <input type="text" class="form-control" id="nama"
                                                                    name="nama" value="{{ $gp->nama }}">
                                                            </div>
                                                            <div class="form-check">
                                                                <label>Jenis Kelamin</label><br />
                                                                <label class="form-radio-label">
                                                                    <input class="form-radio-input" type="radio"
                                                                        name="gender" value="laki-laki"
                                                                        {{ $gp->gender == 'laki-laki' ? 'checked' : '' }}>
                                                                    <span class="form-radio-sign">Laki-Laki</span>
                                                                </label>
                                                                <label class="form-radio-label ml-3">
                                                                    <input class="form-radio-input" type="radio"
                                                                        name="gender" value="perempuan"
                                                                        {{ $gp->gender == 'perempuan' ? 'checked' : '' }}>
                                                                    <span class="form-radio-sign">Perempuan</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="tlp">No HP</label>
                                                                <input type="text" class="form-control" name="tlp"
                                                                    placeholder="No HP" value="{{ $gp->tlp }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tgl_lahir">Tanggal Lahir</label>
                                                                <input type="date" class="form-control"
                                                                    name="tgl_lahir" value="{{ $gp->tgl_lahir }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pend_terakhir">Pendidikan</label>
                                                                <select class="form-control" name="pend_terakhir">
                                                                    <option selected value="{{ $gp->pend_terakhir }}">
                                                                        {{ $gp->pend_terakhir }}</option>
                                                                    <option>S1</option>
                                                                    <option>S2</option>
                                                                    <option>S3</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg">
                                                            <div class="form-group">
                                                                <label for="">Alamat</label>
                                                                <textarea name="alamat" class="form-control">{{ $gp->alamat }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg">
                                                            <div class="form-group">
                                                                <label for="foto">Foto</label>
                                                                <input type="file" class="form-control-file"
                                                                    name="foto" accept="image/*">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <img src="{{ asset('Foto_guru/' . $gp->foto) }}"
                                                                width="150px" height="auto" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal Update -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
