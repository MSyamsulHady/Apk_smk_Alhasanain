@extends('layout.layout_backend.app')
@section('content')
    <style>
        .table-responsive {
            overflow-x: auto;
        }

        .table-responsive table {
            min-width: 100%;
            width: max-content;
        }

        .pertemuan-column {
            width: 100px;
        }

        .nama-column {
            width: 150px;
            /* Sesuaikan lebar kolom nama */
            max-width: 150px;
            /* Maksimum lebar kolom nama */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        #prevButton,
        #nextButton {
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>

    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-3">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="callout callout-warning">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="table-responsive">
                                                            <table class="table-borderless">
                                                                <tr>
                                                                    <td class="fw-bold">Kelas</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td>{{ $data->kelas->nama_kelas }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Mata Pelajaran</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td>{{ $data->mapel->nama_mapel }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Guru Pengampu</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td>{{ $data->guru->nama }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Pukul</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td>{{ $dp->mulai }} / {{ $dp->selesai }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Hari</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td>{{ $dp->hari }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold">Tahun Pelajaran</td>
                                                                    <td style="width: 1px" class="px-2">:</td>
                                                                    <td>{{ $data->kelas->semester->tahun_ajaran }}
                                                                        {{ $data->kelas->semester->nama_semester }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" id="pertemuan-container">
                            <form id="absenForm" action="{{ route('simpanAbsen', [$data->id_rombel, $dp->id_pertemuan]) }}"
                                method="post">
                                @csrf
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>

                                            <th rowspan="2" class="nama-column">Nama</th>
                                            <th colspan="3" class="text-center">
                                                Pertemuan
                                                <p></p>
                                                <button id="prevButton" class="btn btn-sm btn-outline-primary">←</button>
                                                <button id="nextButton" class="btn btn-sm btn-outline-primary">→</button>
                                            </th>
                                            <th colspan="5" class="text-center">Jumlah</th>
                                        </tr>
                                        <tr id="pertemuan-header">
                                            @foreach ($per as $index => $p)
                                                <th class="pertemuan-column" data-index="{{ $index }}">
                                                    {{ $p }}</th>
                                            @endforeach
                                            <th class="text-center">H</th>
                                            <th class="text-center">I</th>
                                            <th class="text-center">S</th>
                                            <th class="text-center">A</th>
                                            <th class="text-center">B</th>
                                        </tr>
                                    </thead>
                                    <tbody id="absen-body">
                                        @foreach ($data->kelas->trx_siswa as $item)
                                            <tr>
                                                <td>{{ $item->siswa->nama }}</td>
                                                @foreach ($per as $index => $p)
                                                    <td class="pertemuan-cell" data-index="{{ $index }}">
                                                        @php
                                                            $absenValue = !empty(
                                                                $absenSiswa[$item->id_trx_rombel_siswa][$p]
                                                            )
                                                                ? $absenSiswa[$item->id_trx_rombel_siswa][$p]
                                                                : null;
                                                        @endphp
                                                        @if (Auth::user()->role == 'Admin')
                                                            @if ($absenValue !== null)
                                                                <select
                                                                    name="{{ $p }}[{{ $item->id_trx_rombel_siswa }}]"
                                                                    class="keterangan-select" required>
                                                                    <option value="">{{ $absenValue }}</option>
                                                                    <option value="H">H</option>
                                                                    <option value="I">I</option>
                                                                    <option value="S">S</option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                </select>
                                                            @else
                                                                <select
                                                                    name="{{ $p }}[{{ $item->id_trx_rombel_siswa }}]"
                                                                    class="keterangan-select" required>
                                                                    <option value="">?</option>
                                                                    <option value="H">H</option>
                                                                    <option value="I">I</option>
                                                                    <option value="S">S</option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                </select>
                                                            @endif
                                                        @endif
                                                        @if (Auth::user()->role == 'Guru')
                                                            @if ($absenValue !== null)
                                                                <input type="hidden"
                                                                    name="{{ $p }}[{{ $item->id_trx_rombel_siswa }}]"
                                                                    class="keterangan-select" required>
                                                                <option value="">{{ $absenValue }}</option>

                                                                </input>
                                                            @else
                                                                <select
                                                                    name="{{ $p }}[{{ $item->id_trx_rombel_siswa }}]"
                                                                    class="keterangan-select" required>
                                                                    <option value="">?</option>
                                                                    <option value="H">H</option>
                                                                    <option value="I">I</option>
                                                                    <option value="S">S</option>
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                </select>
                                                            @endif
                                                        @endif
                                                    </td>
                                                @endforeach
                                                <td class="text-center">
                                                    {{ $kehadiranSiswa[$item->id_trx_rombel_siswa]['total_hadir'] }}</td>
                                                <td class="text-center">
                                                    {{ $kehadiranSiswa[$item->id_trx_rombel_siswa]['total_izin'] }}</td>
                                                <td class="text-center">
                                                    {{ $kehadiranSiswa[$item->id_trx_rombel_siswa]['total_sakit'] }}</td>
                                                <td class="text-center">
                                                    {{ $kehadiranSiswa[$item->id_trx_rombel_siswa]['total_alpa'] }}</td>
                                                <td class="text-center">
                                                    {{ $kehadiranSiswa[$item->id_trx_rombel_siswa]['total_bolos'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button id="saveButton" class="btn btn-primary btn-sm ml-2">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .table-responsive {
        overflow-x: auto;
    }

    .table-responsive table {
        min-width: 100%;
        width: max-content;
    }

    .pertemuan-column {
        width: 100px;
    }

    #prevButton,
    #nextButton {
        margin-left: 5px;
        margin-right: 5px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('pertemuan-container');
        const table = container.querySelector('table');
        const pertemuanHeader = document.getElementById('pertemuan-header');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');

        const displayCount = 3; // Jumlah kolom yang ditampilkan pada satu waktu
        const totalPertemuan = pertemuanHeader.children.length -
            5; // Mengurangi jumlah kolom total untuk kehadiran (H, I, S, A, B)
        let startIndex = 0;

        function updateVisibleColumns() {
            const cells = table.querySelectorAll('.pertemuan-column, .pertemuan-cell');
            cells.forEach(cell => {
                const index = parseInt(cell.dataset.index, 10);
                if (index >= startIndex && index < startIndex + displayCount) {
                    cell.style.display = '';
                } else {
                    cell.style.display = 'none';
                }
            });
            prevButton.style.display = startIndex > 0 ? '' : 'none';
            nextButton.style.display = startIndex < totalPertemuan - displayCount ? '' : 'none';
        }

        prevButton.addEventListener('click', function(event) {
            event.preventDefault();
            if (startIndex > 0) {
                startIndex--;
                updateVisibleColumns();
            }
        });

        nextButton.addEventListener('click', function(event) {
            event.preventDefault();
            if (startIndex < totalPertemuan - displayCount) {
                startIndex++;
                updateVisibleColumns();
            }
        });

        updateVisibleColumns();

        document.getElementById('saveButton').addEventListener('click', function() {
            document.getElementById('absenForm').submit();
        });
    });
</script>
