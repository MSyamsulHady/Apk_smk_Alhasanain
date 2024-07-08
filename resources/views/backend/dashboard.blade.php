@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Anda masuk sebagai
                            <str>{{ Auth::User()->role }}</str>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row mt--2">
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-body">
                            <div class="card-title text-center fw-bold">SMK Al-Hasanain Beraim</div>
                            <div class="row mt-5">
                                <div class="col-md-3">
                                    <a href="{{ route('datasiswa') }}">
                                        <div class="card card-dark bg-primary-gradient">
                                            <div class="card-body pb-0">
                                                <div class="h1 fw-bold float-right"><i class="fas fa-users"></i></div>
                                                <h2 class="mb-2">{{ $jumlahSiswa }}</h2>
                                                <p> Data Siswa</p>
                                                <div class="pull-in sparkline-fix chart-as-background">
                                                    <div id="lineChart"><canvas width="327" height="70"
                                                            style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('dataguru') }}">
                                        <div class="card card-dark bg-success-gradient">
                                            <div class="card-body pb-0">
                                                <div class="h1 fw-bold float-right"><i class="fas fa-users"></i></div>
                                                <h2 class="mb-2">{{ $jumlahGuru }}</h2>
                                                <p>Data Guru</p>
                                                <div class="pull-in sparkline-fix chart-as-background">
                                                    <div id="lineChart"><canvas width="327" height="70"
                                                            style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('mapel') }}">
                                        <div class="card card-dark bg-warning-gradient">
                                            <div class="card-body pb-0">
                                                <div class="h1 fw-bold float-right"><i class="fas fa-book-open"></i></i>
                                                </div>
                                                <h2 class="mb-2">{{ $jumlahMapel }}</h2>
                                                <p>Mata Pelajaran</p>
                                                <div class="pull-in sparkline-fix chart-as-background">
                                                    <div id="lineChart"><canvas width="327" height="70"
                                                            style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('datakelas') }}">
                                        <div class="card card-dark bg-info-gradient">
                                            <div class="card-body pb-0">
                                                <div class="h1 fw-bold float-right"><i class="fas fa-warehouse"></i></div>
                                                <h2 class="mb-2">{{ $jumlahKelas }}</h2>
                                                <p>Kelas</p>
                                                <div class="pull-in sparkline-fix chart-as-background">
                                                    <div id="lineChart"><canvas width="327" height="70"
                                                            style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('absen') }}">
                                        <div class="card card-dark bg-secondary-gradient">
                                            <div class="card-body pb-0">
                                                <div class="h1 fw-bold float-right"><i class="fas fa-calendar-alt"></i>
                                                </div>
                                                <h2 class="mb-2">{{ $jumlahAbsensi }}</h2>
                                                <p>Absensi</p>
                                                <div class="pull-in sparkline-fix chart-as-background">
                                                    <div id="lineChart"><canvas width="327" height="70"
                                                            style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-dark bg-danger-gradient">
                                        <div class="card-body pb-0">
                                            <div class="h1 fw-bold float-right"><i class="fas fa-signal"></i></div>
                                            <h2 class="mb-2">{{ $jmlhNilai }}</h2>
                                            <p>Nilai</p>
                                            <div class="pull-in sparkline-fix chart-as-background">
                                                <div id="lineChart"><canvas width="327" height="70"
                                                        style="display: inline-block; width: 327px; height: 70px; vertical-align: top;"></canvas>
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
@endsection
