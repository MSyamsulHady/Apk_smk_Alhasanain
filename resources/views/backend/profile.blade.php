@extends('layout.layout_backend.app')
@section('content')
    {{-- <div class="main-panel"> --}}
    <div class="container">
        <div class="page-inner">
            <h4 class="page-title">User Profile</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
                            <div class="profile-picture">
                                <div class="avatar avatar-xl mr-2">
                                    <img width="100" height="100"
                                        src="https://img.icons8.com/metro/100/user-male-circle.png"
                                        alt="user-male-circle" />
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">


                                @if ($user->role == 'Guru' && $user->guru)
                                    <p class="card-text">{{ $user->guru->nama }}</p>
                                    <p class="card-text">{{ $user->role }}</p>
                                    <p class="card-text">{{ $user->guru->alamat }}</p>
                                @elseif($user->role == 'Siswa' && $user->siswa)
                                    <p class="card-text h2"> {{ $user->siswa->nama }}</p>
                                    <p class="card-tex h3">{{ $user->role }}</p>
                                    <p class="card-text h3">{{ $user->siswa->alamat }}</p>
                               
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-with-nav">
                        <div class="card-header">
                            <div class="row row-nav-line">
                                <ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-3" role="tablist">
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile"
                                            role="tab" aria-selected="false">Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="profile" class="card-body">
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Name</label>
                                        @if ($user->role == 'Guru' && $user->guru)
                                            <p class="card-text ">{{ $user->guru->nama }}</p>
                                        @elseif($user->role == 'Siswa' && $user->siswa)
                                            <p class="card-text"> {{ $user->siswa->nama }}</p>
                                        @elseif ($user->role == 'Admin')
                                            <p class="card-text">Administrator</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        @if ($user->role == 'Guru' && $user->guru)
                                            <label>NUPTK</label>
                                        @elseif($user->role == 'Siswa' && $user->siswa)
                                            <label>NISN</label>
                                        @elseif ($user->role == 'Admin')
                                            <label for="Email">Email</label>
                                        @endif
                                        @if ($user->role == 'Guru' && $user->guru)
                                            <p class="card-text ">{{ $user->guru->nuptk }}</p>
                                        @elseif($user->role == 'Siswa' && $user->siswa)
                                            <p class="card-text"> {{ $user->siswa->nisn }}</p>
                                        @elseif($user->role == 'Admin')
                                            <p class="card-text"> Administrator@gmail.com</p>
                                        @elseif($user->role == 'Kepala Sekolah')
                                            <p class="card-text"> Administrator@gmail.com</p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-group form-group-default">
                                        <label>Birth Date</label>
                                        @if ($user->role == 'Guru' && $user->guru)
                                            <p class="card-text"> {{ $user->guru->tgl_lahir }}</p>
                                        @elseif($user->role == 'Siswa' && $user->siswa)
                                            <p class="card-text">{{ $user->siswa->tanggal_lahir }}</p>
                                        @elseif($user->role == 'Admin')
                                            <p class="card-text">00-00-00</p>
                                        @elseif($user->role == 'Kepala Sekolah' && $user->siswa)
                                            <p class="card-text">{{ $user->siswa->tanggal_lahir }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-default">
                                        <label>Gender</label>
                                        @if ($user->role == 'Guru' && $user->guru)
                                            <p class="card-text"> {{ $user->guru->gender }}</p>
                                        @elseif($user->role == 'Siswa' && $user->siswa)
                                            <p class="card-text"> {{ $user->siswa->gender }}</p>
                                        @elseif($user->role == 'Admin')
                                            <p class="card-text">Laki Laki</p>
                                        @elseif($user->role == 'Kelapa Sekolah')
                                            <p class="card-text">Laki Laki</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-group-default">
                                        <label>Phone</label>
                                        @if ($user->role == 'Guru' && $user->guru)
                                            <p class="card-text">{{ $user->guru->tlp }}</p>
                                        @elseif($user->role == 'Siswa' && $user->siswa)
                                            <p class="card-text"> {{ $user->siswa->nohp_ortu }}</p>
                                        @elseif($user->role == 'Admin')
                                            <p class="card-text">081XXXXXXXXX</p>
                                        @elseif($user->role == 'Kepala Sekolah' && $user->siswa)
                                            <p class="card-text">081XXXXXXXXX</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label>Address</label>
                                        @if ($user->role == 'Guru' && $user->guru)
                                            <p class="card-text">{{ $user->guru->alamat }}</p>
                                        @elseif($user->role == 'Siswa' && $user->siswa)
                                            <p class="card-text"> {{ $user->siswa->alamat }}</p>
                                        @elseif($user->role == 'Admin')
                                            <p class="card-text">Desa Beraim</p>
                                        @elseif($user->role == 'Kepala Sekolah')
                                            <p class="card-text">Desa Beraim</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
