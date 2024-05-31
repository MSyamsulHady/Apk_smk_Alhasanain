@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Berita</h2>
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
                                        <th>Judul Berita</th>
                                        <th>Isi Berita</th>
                                        <th>Gambar</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $berita)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $berita->judul }}</td>
                                            <td>
                                                @php
                                                    echo $berita->isi_berita;
                                                @endphp
                                            </td>
                                            <td><img src="{{ asset('Gambar_Berita/' . $berita->gambar) }}" alt=""
                                                    width="50"></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="modal" data-target="#ModalEdit"
                                                        title="" class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="Edit ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- modal Add --}}
                        <div class="modal fade bd-example-modal-lg " id="ModalAdd" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Input Berita</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('insertberita') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg">
                                                    <div class="form-group">
                                                        <label for="judul">
                                                            <h5>Judul Berita</h5>
                                                        </label>
                                                        <input type="text" name="judul" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Isi Berita</label>
                                                        <textarea name="isi_berita" id="summernote"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Gambar</label>
                                                        <input type="file" name="gambar" class="form-control"
                                                            accept="image/*">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Deskipsi kegiatan',
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                tabsize: 2,
                height: 300
            });
        });
    </script>
@endsection
