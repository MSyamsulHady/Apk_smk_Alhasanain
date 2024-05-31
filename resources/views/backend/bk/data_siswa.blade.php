@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Data Siswa</h2>
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
                                        <th>NISN</th>
                                        <th>NIS</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>alamat</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Orang Tua</th>
                                        <th>No HP</th>
                                        <th>Jurusan</th>
                                        <th>Foto</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $sw)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sw->nisn }}</td>
                                            <td>{{ $sw->nis }}</td>
                                            <td>{{ $sw->nik }}</td>
                                            <td>{{ $sw->nama }}</td>
                                            <td>{{ $sw->alamat }}</td>
                                            <td>{{ $sw->gender }}</td>
                                            <td>{{ $sw->tanggal_lahir }}</td>
                                            <td>{{ $sw->orang_tua }}</td>
                                            <td>{{ $sw->nohp_ortu }}</td>
                                            <td>{{ $sw->jurusan }}</td>
                                            <td>
                                                @empty($sw->foto)
                                                    -
                                                @endempty
                                                <img src="{{ asset('Foto_Siswa/' . $sw->foto) }}" alt=""
                                                    width="50">
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#ModalEdit{{ $sw->id_siswa }}" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('delete_siswa', $sw->id_siswa) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" data-toggle="" title=""
                                                            data-id="{{ $sw->id_siswa }}" data-nama="{{ $sw->nama }}"
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
                                        <form action="{{ route('import_siswa') }}" method="post"
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
                                            <h5 class="modal-title" id="exampleModalLabel">Input Data Siswa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('insert_siswa') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <div class="form-group">
                                                            <label for="nisn">NISN</label>
                                                            <input type="text"
                                                                class="form-control @error('nisn')  is-invalid
                                                            @enderror"
                                                                id="nisn" name="nisn" placeholder="NISN">
                                                            @error('nisn')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama">Nama Lengkap</label>
                                                            <input type="text"
                                                                class="form-control @error('nama')is-invalid
                                                            @enderror"
                                                                id="nama" name="nama" placeholder="Nama Lengkap">
                                                            @error('nama')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
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
                                                        <div class="form-group mt-3">
                                                            <label for="orang_tua">Nama Orang Tua / Wali</label>
                                                            <input type="text"
                                                                class="form-control @error('orang_tua')
                                                            @enderror"
                                                                name="orang_tua" placeholder="Nama Orang tua / wali">
                                                            @error('orang_tua')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            {{-- <label for="">Foto</label>
                                                            <input type="file"
                                                                class="form-control-file @error('foto')
                                                            is-invalid
                                                            @enderror"
                                                                name="foto" accept="image/*">
                                                            @error('foto')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror --}}
                                                            <label for="">Foto</label>
                                                            <div class="custom-file">

                                                                <input type="file" name="foto" accept="image/*"
                                                                    class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile">pilih
                                                                    file</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col ">
                                                        <div class="form-group">
                                                            <label for="nis">NIS</label>
                                                            <input type="text"
                                                                class="form-control @error('nis')
                                                                    is-invalid
                                                            @enderror"
                                                                id="nis" name="nis" placeholder="NIS">
                                                            @error('nis')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="no_kk">NIK</label>
                                                            <input type="text"
                                                                class="form-control @error('nik')
                                                                is-invalid
                                                            @enderror "
                                                                name="nik" placeholder="NIK">
                                                            @error('nik')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Tanggal Lahir</label>
                                                            <input type="date"
                                                                class="form-control @error('tanggal_lahir')
                                                            is-invalid
                                                            @enderror"
                                                                name="tanggal_lahir">
                                                            @error('tanggal_lahir')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Jurusan</label>
                                                            <select
                                                                class="form-control @error('jurusan')
                                                            is-invalid
                                                            @enderror"
                                                                name="jurusan">
                                                                @error('jurusan')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                <option selected> -- Pilih -- </option>
                                                                <option>RPL</option>
                                                                <option>Perhotelan</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nohp_ortu">No HP</label>
                                                            <input type="text"
                                                                class="form-control @error('nohp_ortu')
                                                            is-invalid
                                                            @enderror"
                                                                id="nohp_ortu" name="nohp_ortu" placeholder="No HP">
                                                            @error('nohp_ortu')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <div class="form-group">
                                                            <label for="">Alamat</label>
                                                            <textarea name="alamat" id=""
                                                                class="form-control @error('alamat')
                                                            is-invalid
                                                            @enderror"></textarea>
                                                            @error('alamat')
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
                            <!-- End Modal -->

                            @foreach ($siswa as $sis)
                                <!-- Modal update -->
                                <div class="modal fade bd-example-modal-lg" id="ModalEdit{{ $sis->id_siswa }}"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('update_siswa', $sis->id_siswa) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg">
                                                            <div class="form-group">
                                                                <label for="nisn">NISN</label>
                                                                <input type="text"
                                                                    class="form-control @error('nisn')  is-invalid
                                                                    @enderror"
                                                                    id="nisn" name="nisn" placeholder="NISN"
                                                                    value="{{ $sis->nisn }}">
                                                                @error('nisn')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama">Nama Lengkap</label>
                                                                <input type="text"
                                                                    class="form-control @error('nama')is-invalid
                                                                      @enderror"
                                                                    id="nama" name="nama"
                                                                    placeholder="Nama Lengkap"
                                                                    value="{{ $sis->nama }}">
                                                                @error('nama')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-check">
                                                                <label>Jenis Kelamin</label><br />
                                                                <label class="form-radio-label">
                                                                    <input class="form-radio-input" type="radio"
                                                                        name="gender" value="laki-laki"
                                                                        {{ $sis->gender == 'laki-laki' ? 'checked' : '' }}>
                                                                    <span class="form-radio-sign">Laki-Laki</span>
                                                                </label>
                                                                <label class="form-radio-label ml-3">
                                                                    <input class="form-radio-input" type="radio"
                                                                        name="gender" value="perempuan"
                                                                        {{ $sis->gender == 'perempuan' ? 'checked' : '' }}>
                                                                    <span class="form-radio-sign">Perempuan</span>
                                                                </label>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label for="orang_tua">Nama Orang Tua / Wali</label>
                                                                <input type="text"
                                                                    class="form-control @error('orang_tua')
                                                                     @enderror"
                                                                    name="orang_tua" placeholder="Nama Orang tua / wali"
                                                                    value="{{ $sis->orang_tua }}">
                                                                @error('orang_tua')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Foto</label>
                                                                <input type="file"
                                                                    class="form-control-file @error('foto')
                                                                      is-invalid
                                                                    @enderror"
                                                                    name="foto" accept="image/*">
                                                                @error('foto')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                <div class="col">
                                                                    <img src="{{ asset('Foto_Siswa/' . $sis->foto) }}"
                                                                        width="150px" height="auto" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col ">
                                                            <div class="form-group">
                                                                <label for="nis">NIS</label>
                                                                <input type="text"
                                                                    class="form-control @error('nis')
                                                                            is-invalid
                                                                    @enderror"
                                                                    id="nis" name="nis"
                                                                    placeholder="NIS"value="{{ $sis->nis }}">
                                                                @error('nis')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="no_kk">NIK</label>
                                                                <input type="text"
                                                                    class="form-control @error('nik')
                                                                        is-invalid
                                                                    @enderror "
                                                                    name="nik" placeholder="NIK"
                                                                    value="{{ $sis->nik }}">
                                                                @error('nik')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Tanggal Lahir</label>
                                                                <input type="date"
                                                                    class="form-control @error('tanggal_lahir')
                                                                    is-invalid
                                                                    @enderror"
                                                                    name="tanggal_lahir"
                                                                    value="{{ $sis->tanggal_lahir }}">
                                                                @error('tanggal_lahir')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Jurusan</label>
                                                                <select
                                                                    class="form-control @error('jurusan')
                                                                    is-invalid
                                                                    @enderror"
                                                                    name="jurusan">
                                                                    @error('jurusan')
                                                                        <span
                                                                            class="invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                    <option selected value="{{ $sis->jurusan }}">
                                                                        {{ $sis->jurusan }}</option>
                                                                    <option>RPL</option>
                                                                    <option>Perhotelan</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nohp_ortu">No HP</label>
                                                                <input type="text"
                                                                    class="form-control @error('nohp_ortu')
                                                                is-invalid
                                                                @enderror"
                                                                    id="nohp_ortu" name="nohp_ortu" placeholder="No HP"
                                                                    value="nohp_ortu">
                                                                @error('nohp_ortu')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg">
                                                            <div class="form-group">
                                                                <label for="">Alamat</label>
                                                                <textarea name="alamat" id=""
                                                                    class="form-control @error('alamat')
                                                                is-invalid
                                                                @enderror">{{ $sis->alamat }}</textarea>
                                                                @error('alamat')
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
                                <!-- End Modal -->
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
