@extends('layout.layout_backend.app')
@section('content')
    <div class="container">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold ">Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <section class="content">
                                <!-- Small boxes (Stat box) -->
                                <!-- /.row -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="box box-widget widget-user">
                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                            <div class="widget-user-header bg-green-active">
                                                @if ($user->role == 'Guru' && $user->guru)
                                                    <h4 class="card-text">{{ $user->guru->nama }}</h4>
                                                    <h5 class="card-text">{{ $user->role }}</h5>
                                                @elseif($user->role == 'Siswa' && $user->siswa)
                                                    <h4 class="widget-user-username">{{ $user->siswa->nama }}</h4>
                                                    <h5 class="widget-user-desc">{{ $user->siswa->nisn }}</h5>
                                                @endif

                                            </div>
                                            <div class="widget-user-image">
                                                <img class="img-circle"
                                                    src="https://www.sika.stmiklombok.ac.id/assets/img/avatar.jpg"
                                                    alt="User Avatar">
                                            </div>
                                            <div class="box-footer">
                                                <div class="row">
                                                    <div class="col-sm-4 border-right">
                                                        <div class="description-block">
                                                            @if ($user->role == 'Guru' && $user->guru)
                                                                <h5 class="description-header">{{ $user->guru->nuptk }}</h5>
                                                                <span class="description-text"></span>
                                                            @elseif($user->role == 'Siswa' && $user->siswa)
                                                                <h5 class="description-header">{{ $user->siswa->jurusan }}
                                                                </h5>
                                                                <span class="description-text"></span>
                                                            @endif
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-4 border-right">

                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-4">
                                                        <div class="description-block">
                                                            <h5 class="description-header">Angkatan 2021</h5>
                                                            <span class="description-text"></span>
                                                        </div>
                                                        <!-- /.description-block -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-9">
                                        <div class="box box-primary box-solid">
                                            <div class="box-body">
                                                <table class="table table-striped" style="height: 2px">
                                                    <tr>
                                                        <th width="15%"><label for="inputEmail3"
                                                                control-label">Nama</label>
                                                        </th>
                                                        <td>
                                                            <div class="col-sm-6">
                                                                @if ($user->role == 'Guru' && $user->guru)
                                                                    : {{ $user->guru->nama }}
                                                                @elseif($user->role == 'Siswa' && $user->siswa)
                                                                    : {{ $user->siswa->nama }}
                                                                @endif
                                                            </div>
                                                        </td>
                                                        @if ($user->role == 'Siswa' && $user->siswa)
                                                            <th width="10%"><label for="inputEmail3" control-label"> Nama
                                                                    Orang
                                                                    Tua</label>
                                                            </th>
                                                            <td>
                                                                <div class="col-sm-7">
                                                                    : {{ $user->siswa->orang_tua }}
                                                                </div>
                                                        @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="15%"><label for="inputEmail3" control-label"> Tempat
                                                                Lahir</label></th>
                                                        <td>
                                                            <div class="col-sm-12">
                                                                : Beraim </div>
                                                        </td>
                                                        <th width="15%"><label for="inputEmail3" control-label"> Tanggal
                                                                Lahir</label></th>
                                                        <td>
                                                            <div class="col-sm-7">
                                                                @if ($user->role == 'Siswa' && $user->siswa)
                                                                    :{{ $user->siswa->tanggal_lahir }}
                                                                @elseif ($user->role == 'Guru' && $user->guru)
                                                                    :{{ $user->guru->tanggal_lahir }}
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="15%"><label for="inputEmail3" control-label"> Jenis
                                                                Kelamin</label></th>
                                                        <td>
                                                            <div class="col-sm-7">
                                                                @if ($user->role == 'Siswa' && $user->siswa)
                                                                    : {{ $user->siswa->gender }}
                                                                @elseif ($user->role == 'Guru' && $user->guru)
                                                                    :{{ $user->guru->gender }}
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <th width="15%"><label for="inputEmail3" control-label">
                                                                Agama</label></th>
                                                        <td>
                                                            <div class="col-sm-7">
                                                                : Islam </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="tab-content">
                                                    <div id="home" class="tab-pane fade in active">
                                                        <table class="table table-striped" style="height: 2px">
                                                            <tr>
                                                                <th width="15%"><label for="inputEmail3" control-label">
                                                                        NIK</label></th>
                                                                <td colspan="5">
                                                                    <div class="col-sm-12">
                                                                        {{-- : {{ $siswa->siswa->nik }} </div> --}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th width="15%"><label for="inputEmail3" control-label">
                                                                        Jalan</label></th>
                                                                <td>
                                                                    <div class="col-sm-12">
                                                                        : 0 </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th width="15%"><label for="inputEmail3" control-label">
                                                                        Dusun</label></th>
                                                                <td>
                                                                    <div class="col-sm-12">
                                                                        : 0 </div>
                                                                </td>
                                                                <th width="2%"><label for="inputEmail3" control-label">
                                                                        RT</label>
                                                                </th>
                                                                <td>
                                                                    <div class="col-sm-2">
                                                                        : 0 </div>
                                                                </td>
                                                                <th width="2%"><label for="inputEmail3" control-label">
                                                                        RW</label>
                                                                </th>
                                                                <td>
                                                                    <div class="col-sm-2">
                                                                        : 0 </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th width="15%"><label for="inputEmail3" control-label">
                                                                        Kelurahan</label></th>
                                                                <td>
                                                                    <div class="col-sm-12">
                                                                        : 0 </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th width="15%"><label for="inputEmail3" control-label">
                                                                        Tlp</label></th>
                                                                <td>
                                                                    <div class="col-sm-12">
                                                                        {{-- : {{ $siswa->siswa->nohp_ortu }} </div> --}}
                                                                </td>
                                                                <th width="2%"><label for="inputEmail3" control-label">
                                                                        Hp</label>
                                                                </th>
                                                                <td>
                                                                    <div class="col-sm-7">
                                                                        : </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th width="15%"><label for="inputEmail3" control-label">
                                                                        Email</label></th>
                                                                <td>
                                                                    <div class="col-sm-12">
                                                                        : palahady07@gmail.com </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div id="menu1" class="tab-pane fade">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th style="text-align:center" rowspan="2">No.</th>
                                                                    <th style="text-align:center" rowspan="2">Semester
                                                                    </th>
                                                                    <th style="text-align:center" rowspan="2">Status
                                                                    </th>
                                                                    <th style="text-align:center" rowspan="2">IPS</th>
                                                                    <th style="text-align:center" rowspan="2">IPK</th>
                                                                    <th style="text-align:center" colspan="2">SKS</th>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align:center;width:10%">Semester</th>
                                                                    <th style="text-align:center;width:10%">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div id="menu2" class="tab-pane fade">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th style="text-align:center" rowspan="2">No.</th>
                                                                    <th style="text-align:center" rowspan="2">Semester
                                                                    </th>
                                                                    <th style="text-align:center" rowspan="2">Kode MK
                                                                    </th>
                                                                    <th style="text-align:center" rowspan="2">Nama MK
                                                                    </th>
                                                                    <th style="text-align:center" rowspan="2">SKS</th>
                                                                    <th style="text-align:center" rowspan="2">SMST</th>
                                                                    <th style="text-align:center" colspan="3">Nilai
                                                                    </th>

                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align:center;width:10%">Angka</th>
                                                                    <th style="text-align:center;width:10%">Hurup</th>
                                                                    <th style="text-align:center;width:10%">Index</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div id="menu3" class="tab-pane fade">
                                                        <h3>Dalam proses pengembangan</h3>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
