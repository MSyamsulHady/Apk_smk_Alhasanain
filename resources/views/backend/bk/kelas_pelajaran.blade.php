@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Kelas Pelajaran</h2>
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
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                        <th>Kelas</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dt->mapel->nama_mapel }}</td>
                                            <td>{{ $dt->guru->nama }}</td>
                                            <td>{{ $dt->kelas->nama_kelas }}</td>
                                            <td>
                                                <a href="{{ route('nilai', $dt->id_kelasPelajaran) }}"
                                                    class="btn btn-outline-primary" data-original-title="lihat">
                                                    <i class="far fa-eye"></i>&nbsp;<span>Lihat</span>
                                                    <a>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Input Rombel</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('insertRombel') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg">
                                                    <div class="form-group">
                                                        <label for="nama_mapel">
                                                            <h5>Mata Pelajaran</h5>
                                                        </label>
                                                        <select class="custom-select" id="mapel" name="id_mapel">
                                                            <option selected> --pilih Mapel--
                                                            </option>
                                                            @foreach ($mapel as $m)
                                                                <option value="{{ $m->id_mapel }}">
                                                                    {{ $m->nama_mapel }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Guru</label>
                                                        <input type="text" class="form-control" id="guru" readonly>
                                                        <input type="hidden" name="id_guru" id="id_guru">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_mapel">
                                                            <h5>Kelas</h5>
                                                        </label>
                                                        <select class="custom-select" id="inputGroupSelect02"
                                                            name="id_kelas">
                                                            <option selected> --pilih Kelas--
                                                            </option>
                                                            @foreach ($kelas as $kel)
                                                                <option value="{{ $kel->id_kelas }}">
                                                                    {{ $kel->nama_kelas }}
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
                        {{-- modal Edit --}}
                        @foreach ($data as $dk)
                            <div class="modal fade " id="ModalEdit{{ $dk->id_kelasPelajaran }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Rombel</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('updateRombel', $dk->id_kelasPelajaran) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg">
                                                        <div class="form-group">
                                                            <label for="nama_mapel">
                                                                <h5>Mata Pelajaran</h5>
                                                            </label>
                                                            <select class="custom-select" id="mapel" name="id_mapel">
                                                                <option selected value="{{ $dk->id_kelasPelajaran }}">
                                                                    {{ $dk->mapel->nama_mapel }}
                                                                </option>
                                                                @foreach ($mapel as $m)
                                                                    <option value="{{ $m->id_mapel }}">
                                                                        {{ $m->nama_mapel }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Guru</label>
                                                            <input type="text" class="form-control" id="guru"
                                                                readonly>
                                                            <input type="hidden" name="id_guru" id="id_guru">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_mapel">
                                                                <h5>Kelas</h5>
                                                            </label>
                                                            <select class="custom-select" id="inputGroupSelect02"
                                                                name="id_kelas">
                                                                <option selected value="{{ $dk->id_kelas }}">
                                                                    {{ $dk->kelas->nama_kelas }}
                                                                </option>
                                                                @foreach ($kelas as $kel)
                                                                    <option value="{{ $kel->id_kelas }}">
                                                                        {{ $kel->nama_kelas }}
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
                        @endforeach
                        {{-- end modal Edit --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#mapel').on('change', function() {
            $.ajax({
                url: '/getGuru/' + this.value,
                type: 'GET',
                success: function(response) {

                    let namaGuru = response.nama.guru;
                    $('#guru').val(namaGuru.nama);
                    $('#id_guru').val(namaGuru.id_guru);
                }
            })
        })
    </script>
@endsection
