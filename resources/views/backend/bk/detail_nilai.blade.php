@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h4 class="text-white pb-2 fw-bold ">Kelas : {{ $model->kelas->nama_kelas }}</h4>
                        <h4 class="text-white pb-2 fw-bold ">Mata Pelajaran : {{ $model->mapel->nama_mapel }}</h4>
                        <h4 class="text-white pb-2 fw-bold ">Guru : {{ $model->guru->nama }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <div class="table-responsive">

                                    <form action="{{ route('inputNilai', $model->id_rombel) }}" method="post">
                                        @csrf
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>NIS</th>
                                                    <th>NAMA</th>
                                                    <th>NILAI</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($model->kelas->trx_siswa as $j)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $j->siswa->nis }}</td>
                                                        <td>{{ $j->siswa->nama }}</td>
                                                        <td>
                                                            @empty($j->siswa->nilai[0]->nilai)
                                                                <input type="text" name="{{ $j->siswa->id_siswa }}">
                                                            @endempty
                                                            @if (!empty($j->siswa->nilai) && !empty($j->siswa->nilai[0]->nilai))
                                                                {{ $j->siswa->nilai[0]->nilai }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-start">
                                            <button class="btn  btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- add nilai --}}
                        {{-- @foreach ($model as $j)
                            <x-modal title="Input Nilai {{ $j->mapel->nama_mapel }}" id="modalAddNilai{{ $j->id_rombel }}"
                                class="modal-xl">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="{{ route('inputNilai', $j->id_rombel) }}"
                                                id="inputNilai{{ $j->id_rombel }}" method="post">
                                                @csrf
                                                @foreach ($j->kelas->trx_siswa as $pst)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $pst->siswa->nis }}</td>
                                                        <td>{{ $pst->siswa->nama }}</td>
                                                        <td width="200">
                                                            <input type="number" class="form-control"
                                                                name="{{ $pst->id_siswa }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </form>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn  btn-success" type="submit"
                                            form="inputNilai{{ $j->id_rombel }}">Submit</button>
                                    </div>
                                </div>
                            </x-modal>
                        @endforeach --}}
                        {{-- /add nilai --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
