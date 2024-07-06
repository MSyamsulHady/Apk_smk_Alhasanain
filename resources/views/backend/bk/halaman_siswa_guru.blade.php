<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>SMK</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 3.3.2 -->
    <link href="https://www.sika.stmiklombok.ac.id/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://www.sika.stmiklombok.ac.id/assets/bootstrap/css/custom.css" rel="stylesheet" type="text/css" />
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Ionicons -->
    {{-- <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" /> --}}
    <!-- Morris chart -->
    <link href="https://www.sika.stmiklombok.ac.id/assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="https://www.sika.stmiklombok.ac.id/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css"
        rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="https://www.sika.stmiklombok.ac.id/assets/plugins/daterangepicker/daterangepicker-bs3.css"
        rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="https://www.sika.stmiklombok.ac.id/assets/plugins/datepicker/datepicker3.css" rel="stylesheet"
        type="text/css" />
    <!-- Theme style -->
    <link href="https://www.sika.stmiklombok.ac.id/assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="https://www.sika.stmiklombok.ac.id/assets/dist/css/skins/_all-skins.min.css" rel="stylesheet"
        type="text/css" />
    <!-- DATA TABLES -->
    <link href="https://www.sika.stmiklombok.ac.id/assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet"
        type="text/css" />
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/datatables/jquery.dataTables.js" type="text/javascript">
    </script>
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/datatables/dataTables.bootstrap.js"
        type="text/javascript"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="https://www.sika.stmiklombok.ac.id/assets/plugins/select2/select2.min.css">
    {{-- <link rel="icon shortcut" type="image/png" href="https://www.sika.stmiklombok.ac.id/assets/img/favicon.ico" /> --}}
    <!-- Start of LiveChat (www.livechatinc.com) code -->
    <!---- time picker -->
    <!-- Bootstrap Color Picker -->

    <!-- Bootstrap time Picker -->
    <link rel="stylesheet"
        href="https://www.sika.stmiklombok.ac.id/assets/plugins/timepicker/bootstrap-timepicker.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- End of LiveChat code -->
    <style>
        .example-modal .modal {
            position: relative;
            top: auto;
            bottom: auto;
            right: auto;
            left: auto;
            display: block;
            z-index: 1;
        }

        .example-modal .modal {
            background: transparent !important;
        }

        .datepicker {
            z-index: 1151 !important;
        }

        body {
            background: navy !important;
        }

        .toggle-custom {
            position: absolute !important;
            top: 0;
            right: 0;
        }

        .toggle-custom[aria-expanded='true'] .glyphicon-plus:before {
            content: "\2212";
        }
    </style>

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue fixed layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="" class="navbar-brand"><b>SMK AH
                            </b><small></small></a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="">Home</a></li>
                            @if ($user->role == 'Guru' && $user->guru)
                                <li><a href="{{ route('absen') }}">Absensi</a></li>
                            @elseif ($user->role == 'Siswa' && $user->siswa)
                                <li><a href="">Absensi</a></li>
                            @endif
                            <li><a href="">Nilai</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="user user-menu"><a href=""></a></li>
                            <li class="user user-menu"><a>2023/2024 Genap</a></li>
                            <!-- /.messages-menu -->

                            <!-- Notifications Menu -->

                            <!-- Tasks Menu -->
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="https://www.sika.stmiklombok.ac.id/assets/img/avatar.jpg"
                                        class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    @if ($user->role == 'Guru' && $user->guru)
                                        <span class="hidden-xs">{{ $user->guru->nama }}</span>
                                    @elseif($user->role == 'Siswa' && $user->siswa)
                                        <span class="hidden-xs">{{ $user->siswa->nama }}</span>
                                    @endif

                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="https://www.sika.stmiklombok.ac.id/assets/img/avatar.jpg"
                                            class="img-circle" alt="User Image">
                                        <p>
                                            @if ($user->role == 'Guru' && $user->guru)
                                                {{ $user->guru->nama }} <small>{{ $user->guru->nuptk }}</small>
                                            @elseif($user->role == 'Siswa' && $user->siswa)
                                                {{ $user->siswa->nama }} <small>{{ $user->siswa->nis }}</small>
                                            @endif

                                        </p>
                                    </li>
                                    <!-- Menu Body -->

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign
                                                out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper">

            <!-- Main content -->
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
                                <img class="img-circle" src="https://www.sika.stmiklombok.ac.id/assets/img/avatar.jpg"
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
                                                <h5 class="description-header">{{ $user->siswa->jurusan }}</h5>
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
                                        <th width="15%"><label for="inputEmail3" control-label">Nama</label>
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
                                            <th width="10%"><label for="inputEmail3" control-label"> Nama Orang
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
                                        <th width="15%"><label for="inputEmail3" control-label"> Agama</label></th>
                                        <td>
                                            <div class="col-sm-7">
                                                : Islam </div>
                                        </td>
                                    </tr>
                                </table>
                                <br><br>

                                <ul class="nav nav-tabs">
                                    <li class="active "><a data-toggle="tab" href="#home">Alamat</a></li>
                                    <li><a data-toggle="tab" href="#menu1"> Aktifitas Perkuliahan</a></li>
                                    <li><a data-toggle="tab" href="#menu2"> Histori Nilai</a></li>
                                    <li><a data-toggle="tab" href="#menu3"> Histori Pembayaran</a></li>
                                </ul>
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
                                                <th width="2%"><label for="inputEmail3" control-label"> RT</label>
                                                </th>
                                                <td>
                                                    <div class="col-sm-2">
                                                        : 0 </div>
                                                </td>
                                                <th width="2%"><label for="inputEmail3" control-label"> RW</label>
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
                                                <th width="2%"><label for="inputEmail3" control-label"> Hp</label>
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
                                                    <th style="text-align:center" rowspan="2">Semester</th>
                                                    <th style="text-align:center" rowspan="2">Status</th>
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
                                                    <th style="text-align:center" rowspan="2">Semester</th>
                                                    <th style="text-align:center" rowspan="2">Kode MK</th>
                                                    <th style="text-align:center" rowspan="2">Nama MK</th>
                                                    <th style="text-align:center" rowspan="2">SKS</th>
                                                    <th style="text-align:center" rowspan="2">SMST</th>
                                                    <th style="text-align:center" colspan="3">Nilai</th>

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

            <!-- /.content -->

            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b></b>
            </div>
            <strong>
                <center>Copyright &copy; 2023-2024 <a href="http://www.stmiklombok.ac.id">Smk Al Hasanain</a>
                </center>
            </strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="https://www.sika.stmiklombok.ac.id/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- AdminLTE App -->
    <script src="https://www.sika.stmiklombok.ac.id/assets/dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/sparkline/jquery.sparkline.min.js"
        type="text/javascript"></script>
    <!-- FastClick -->
    <script src='https://www.sika.stmiklombok.ac.id/assets/plugins/fastclick/fastclick.min.js'></script>

    <!-- iCheck -->
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/slimScroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
    <!-- data table-->
    <script src="https://www.sika.stmiklombok.ac.id/assets/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="https://www.sika.stmiklombok.ac.id/assets/datatables/dataTables.bootstrap.js" type="text/javascript">
    </script>
    <!-- Select2 -->
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/select2/select2.full.min.js"></script>
    <!-- Datepicker -->
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/datepicker/bootstrap-datepicker.js"
        type="text/javascript"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes)
    <script src="https://www.sika.stmiklombok.ac.id/assets/dist/js/pages/dashboard2.js" type="text/javascript"></script>
    -->
    <!-- InputMask -->
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="https://www.sika.stmiklombok.ac.id/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script
        src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js">
    </script>
    AdminLTE for demo purposes

    <script src="https://www.sika.stmiklombok.ac.id/assets/dist/js/demo.js" type="text/javascript"></script>
 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function() {

            $("#example1").dataTable();
            $("#example3").dataTable();
            $("#example4").dataTable();
            $("#example5").dataTable();
            $('#example2').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
        });



        $(".select2").select2();
    </script>
</body>

</html>

