@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Jadwal Pelajaran</h2>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary mt-2 ml-3" data-toggle="modal" data-target="#ModalAdd">
            <i class="fa fa-plus "></i> <span class="ml-1">Tambah</span>
        </button>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelas</th>
                                        <th>Mata pelajaran</th>
                                        <th>Guru Pengampu</th>
                                        <th>Hari</th>
                                        <th>Jumlah Pertemuan</th>
                                        <th class="text-center">Jam</th>
                                        <th>Semester</th>
                                        <th>#Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $ab)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ab->rombel->kelas->nama_kelas }}</td>
                                            <td>{{ $ab->rombel->mapel->nama_mapel }}</td>
                                            <td>{{ $ab->rombel->guru->nama }}</td>
                                            <td>{{ $ab->hari }}</td>
                                            <td>{{ $ab->pertemuanKe }}</td>
                                            <td>{{ $ab->mulai }}/{{ $ab->selesai }}</td>
                                            <td>{{ $ab->rombel->kelas->semester->nama_semester }}

                                                {{ $ab->rombel->kelas->semester->tahun_ajaran }}</td>

                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#ModalEdit{{ $ab->id_pertemuan }}" title=""
                                                        class="btn btn-link btn-primary btn-lg" data-original-title="Edit ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    <form action="{{ route('deletePertemuan', $ab->id_pertemuan) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" data-toggle="" title=""
                                                            data-id="{{ $ab->id_pertemuan }}"
                                                            data-nama="{{ $ab->rombel->mapel->nama_mapel }}"
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
                        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Input Jadwal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('addjadwal') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row-12">
                                                <div class="col-lg">
                                                    <!-- Kelas -->
                                                    <div class="form-group">
                                                        <label for="nama_mapel">
                                                            <h5>Kelas</h5>
                                                        </label>
                                                        <select class="custom-select" id="inputGroupSelect02"
                                                            name="id_rombel">
                                                            <option selected>--pilih Rombongan Belajar--</option>
                                                            @foreach ($rombel as $a)
                                                                <option value="{{ $a->id_rombel }}">
                                                                    {{ $a->kelas->nama_kelas . ' | ' . $a->mapel->nama_mapel }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- Semester -->
                                                    <div class="form-group">
                                                        <label for="id_semester">
                                                            <h5>Semester</h5>
                                                        </label>
                                                        <select class="custom-select" id="inputGroupSelect02"
                                                            name="id_semester" disabled>
                                                            <option value="{{ $activeSemester->id_semester }}" selected>
                                                                {{ $activeSemester->nama_semester . ' | ' . $activeSemester->tahun_ajaran }}
                                                            </option>
                                                        </select>
                                                        <input type="hidden" name="id_semester"
                                                            value="{{ $activeSemester->id_semester }}">
                                                    </div>
                                                    <!-- Hari -->
                                                    <div class="form-group">
                                                        <label for="nama_mapel">
                                                            <h5>Hari</h5>
                                                        </label>
                                                        <select class="custom-select" id="inputGroupSelect02"
                                                            name="hari">
                                                            <option value="Senin">Senin</option>
                                                            <option value="Selasa">Selasa</option>
                                                            <option value="Rabu">Rabu</option>
                                                            <option value="Kamis">Kamis</option>
                                                            <option value="Jumat">Jumat</option>
                                                            <option value="Sabtu">Sabtu</option>
                                                            <option value="Minggu">Minggu</option>
                                                        </select>
                                                    </div>
                                                    <!-- Jumlah Pertemuan -->
                                                    <div class="form-group">
                                                        <label for="pertemuanKe">Jumlah Pertemuan</label>
                                                        <input type="number"
                                                            class="form-control @error('pertemuanKe') is-invalid @enderror"
                                                            id="nis" name="pertemuanKe" value="">
                                                        @error('pertemuanKe')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <label for="dari_pukul" class="col-sm-2 ml-2">Pukul</label>
                                            <div class="form-group row">
                                                <div class="col-sm-4 ml-3">
                                                    <input type="time" value="" class="form-control"
                                                        name="mulai" id="" required>
                                                </div>
                                                <div class="mt-2">s/d</div>
                                                <div class="col-sm-4">
                                                    <input type="time" value="" class="form-control"
                                                        name="selesai" id="" required>
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
                        {{-- modal Update --}}
                        @foreach ($jadwal as $jd)
                            <div class="modal fade " id="ModalEdit{{ $jd->id_pertemuan }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Jadwal</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('updatePertemuan', $jd->id_pertemuan) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <div class="row-12">
                                                    <div class="col-lg">
                                                        <div class="form-group">
                                                            <label for="nama_mapel">
                                                                <h5> Kelas</h5>
                                                            </label>
                                                            <select class="custom-select" id="inputGroupSelect02"
                                                                name="id_rombel">
                                                                <option selected value="{{ $jd->id_rombel }}">
                                                                    {{ $jd->rombel->kelas->nama_kelas . ' | ' . $jd->rombel->mapel->nama_mapel }}
                                                                </option>
                                                                @foreach ($rombel as $a)
                                                                    <option value="{{ $a->id_rombel }}">
                                                                        {{ $a->kelas->nama_kelas . ' | ' . $a->mapel->nama_mapel }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="id_semester">
                                                                <h5>Semester</h5>
                                                            </label>
                                                            <select class="custom-select" id="inputGroupSelect02"
                                                                name="id_semester" disabled>
                                                                <option value="{{ $activeSemester->id_semester }}"
                                                                    selected>
                                                                    {{ $activeSemester->nama_semester . ' | ' . $activeSemester->tahun_ajaran }}
                                                                </option>
                                                            </select>
                                                            <input type="hidden" name="id_semester"
                                                                value="{{ $activeSemester->id_semester }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_mapel">
                                                                <h5> Hari</h5>
                                                            </label>
                                                            <select class="custom-select" id="inputGroupSelect02"
                                                                name="hari">
                                                                <option value="{{ $jd->hari }}">
                                                                    {{ $jd->hari }}
                                                                </option>

                                                                <option value="Senin">Senin</option>
                                                                <option value="Selasa">Selasa</option>
                                                                <option value="Rabu">Rabu</option>
                                                                <option value="Kamis">Kamis</option>
                                                                <option value="Jumat">Jumat</option>
                                                                <option value="Sabtu">Sabtu</option>
                                                                <option value="Minggu">Minggu</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pertemuanKe">Jumlah Pertemuan</label>
                                                            <input type="number"
                                                                class="form-control @error('pertemuanKe')
                                                                        is-invalid
                                                                @enderror"
                                                                id="nis" name="pertemuanKe"
                                                                value="{{ $jd->pertemuanKe }}">
                                                            @error('pertemuanKe')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="dari_pukul" class="col-sm-2 ml-2">Pukul</label>
                                                <div class="form-group row">
                                                    <div class="col-sm-4 ml-3">
                                                        <input type="time" value="{{ $jd->mulai }}"
                                                            class="form-control  " name="mulai" id=""
                                                            required>
                                                    </div>
                                                    <div class="mt-2 ml-3">s/d</div>
                                                    <div class="col-sm-4 ml-3">
                                                        <input type="time" value="{{ $jd->selesai }}"
                                                            class="form-control  " name="selesai" id=""
                                                            required>
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
                        {{-- end modal Update --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('script')
    <script>
        $(document).ready(function() {
            $('#pertemuan').on('change', function() {
                let selectedValue = this.value;

                $.ajax({
                    url: '/ambilGuru/' + selectedValue,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#guru').val(response.nama);
                            $('#id_guru').val(response.id_guru);
                        } else {
                            alert('Guru tidak ditemukan');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            });
        });
    </script>
@endsection --}}
