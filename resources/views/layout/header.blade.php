<header id="header" class="fixed-top">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logoah">
            <img src="{{ asset('assets/img/kol.png') }}" class="img-fluid" width="200px">
        </div>
        {{--  <h1 class="logo me-auto"><a href="index.html">Smk al-Hasanain</a></h1>  --}}
        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a @class(['active' => request()->is('/')]) href="{{ route('home') }}">Home</a></li>
                <li><a class="{{ request()->is('bk') ? 'active' : '' }}"
                        href="{{ route('bimbingan_konseling') }}">Bimbingan Konseling</a></li>
                <li><a class="{{ request()->is('prestasi') ? 'active' : '' }}"
                        href="{{ route('prestasi') }}">Prestasi</a></li>
                <li><a class="{{ request()->is('pendaftaran') ? 'active' : '' }}"
                        href="{{ route('pendaftaran') }}">Pendaftaran</a></li>
                <li><a class="{{ request()->is('kegiatan') ? 'active' : '' }}"
                        href="{{ route('kegiatan') }}">Kegiatan</a></li>
                <li class="text-center">
                    <button class="get-started-btn border-0">
                        <a href="{{ route('login') }}" class=" p-0 m-0 text-white">Login</a>
                    </button>
                </li>
            </ul>

        </nav>
        {{--  <!-- .navbar -->  --}}
        {{-- <a href="courses.html" class="get-started-btn text-white">Login</a> --}}

        <i class="bi bi-list mobile-nav-toggle"></i>
    </div>
</header><!-- End Header -->
