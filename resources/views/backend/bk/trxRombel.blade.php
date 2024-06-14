@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Detail Rombel</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddPeserta">
                            Add
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nis</th>
                                    <th>Nama Siswa</th>
                                    <th>#Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rombel->trx as $dt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dt->siswa->nis }}</td>
                                        <td>{{ $dt->siswa->nama }}</td>
                                        <td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- add peserta -->
                    <x-modal title="PESERTA DIDIK" id="modalAddPeserta" class="modal-xl">
                        <form action="{{ route('add_peserta', $rombel->id_rombel) }}" method="post">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-data" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nis</th>
                                            <th>Nama</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $pst)
                                            <tr>
                                                <td class="td-left">{{ $loop->iteration }}</td>
                                                <td>{{ $pst->nis }}</td>
                                                <td>{{ $pst->nama }}</td>
                                                <td>
                                                    <input type="checkbox" name="id_siswa[]" value="{{ $pst->id_siswa }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-sm btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </x-modal>
                    <!-- end add peserta -->
                </div>
            </div>
        </div>
    </div>
@endsection
