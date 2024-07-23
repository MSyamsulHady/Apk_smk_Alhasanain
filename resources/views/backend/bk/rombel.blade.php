@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Rombel</h2>
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
                                        <th>Kelas</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dt->kelas->nama_kelas }}</td>
                                            <td>{{ $dt->mapel->nama_mapel }}</td>
                                            <td>{{ $dt->guru->nama }}</td>
                                            <td>
                                                <a href="{{ route('trx_rombel', $dt->id_rombel) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-eye"></i>&nbsp;
                                                    Detail</a>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#ModalEdit{{ $dt->id_rombel }}" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('rombel.delete', $dt->id_rombel) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" data-toggle="" title=""
                                                            data-id="{{ $dt->id_rombel }}"
                                                            data-nama="{{ $dt->nama_rombel }}"
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
                            <div class="d-flex justify-content-end mt-3">
                                {{ $data->links() }}
                            </div>
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
                                    <form action="{{ route('rombel.add') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg">
                                                    <div class="form-group">
                                                        <label for="nama_mapel">
                                                            <h5>Mata Pelajaran</h5>
                                                        </label>
                                                        <select class="custom-select" id="mapel" name="id_mapel"
                                                            required>
                                                            <option value="" selected> --pilih Mapel-- </option>
                                                            @foreach ($mapel as $m)
                                                                <option value="{{ $m->id_mapel }}">{{ $m->nama_mapel }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_guru">
                                                            <h5>Guru</h5>
                                                        </label>
                                                        <select class="custom-select" id="guru" name="id_guru"
                                                            required>
                                                            <option value="" selected> --pilih Guru-- </option>
                                                            @foreach ($guru as $g)
                                                                <option value="{{ $g->id_guru }}">{{ $g->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_kelas">
                                                            <h5>Kelas</h5>
                                                        </label>
                                                        <select class="custom-select" id="selectKelas" name="id_kelas"
                                                            required>
                                                            <option value="" selected> --pilih Kelas-- </option>
                                                            @foreach ($kelas as $k)
                                                                @if ($k->id_semester == $activeSemester->id_semester)
                                                                    <option value="{{ $k->id_kelas }}">
                                                                        {{ $k->nama_kelas }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- end modal Add --}}

                        <!-- add peserta -->
                        @foreach ($data as $rmbl)
                            <x-modal title="PESERTA DIDIK" id="ModalEdit{{ $rmbl->id_rombel }}">

                                <form action="{{ route('rombel.updt', $rmbl->id_rombel) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label for="mapel">
                                                        <h5>Mata Pelajaran</h5>
                                                    </label>
                                                    <select class="custom-select" id="mapel" name="id_mapel" required>
                                                        <option value="" selected> --pilih Mapel-- </option>
                                                        @foreach ($mapel as $m)
                                                            <option value="{{ $m->id_mapel }}"
                                                                {{ $rmbl->id_mapel == $m->id_mapel ? 'selected' : '' }}>
                                                                {{ $m->nama_mapel }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="guru">
                                                        <h5>Guru</h5>
                                                    </label>
                                                    <select class="custom-select" id="guru" name="id_guru" required>
                                                        <option value="" selected> --pilih Guru-- </option>
                                                        @foreach ($guru as $g)
                                                            <option value="{{ $g->id_guru }}"
                                                                {{ $rmbl->id_guru == $g->id_guru ? 'selected' : '' }}>
                                                                {{ $g->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kelas">
                                                        <h5>Kelas</h5>
                                                    </label>
                                                    <select class="custom-select" id="selectKelas" name="id_kelas"
                                                        required>
                                                        <option value="" selected> --pilih Kelas-- </option>
                                                        @foreach ($kelas as $k)
                                                            @if ($k->id_semester == $activeSemester->id_semester)
                                                                <option value="{{ $k->id_kelas }}"
                                                                    {{ $rmbl->id_kelas == $k->id_kelas ? 'selected' : '' }}>
                                                                    {{ $k->nama_kelas }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </x-modal>
                        @endforeach

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
