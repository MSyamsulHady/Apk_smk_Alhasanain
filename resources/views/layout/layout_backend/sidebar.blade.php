<div class="sidebar">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">

                <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if (Auth::user()->role == 'Admin')
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-layer-group"></i>
                            <p>Data Master</p>
                            <span class="caret"></span>
                        </a>
                @endif

                <div class="collapse" id="sidebarLayouts">
                    <ul class="nav nav-collapse">
                        <li class="{{ request()->is('datasiswa') ? 'active' : '' }}">
                            <a href="{{ route('datasiswa') }}">
                                <span class="sub-item">Data Siswa </span>
                            </a>
                        </li>

                        <li class="{{ request()->is('dataguru') ? 'active' : '' }}">
                            <a href="{{ route('dataguru') }}">
                                <span class="sub-item">Data Guru</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('datakelas') ? 'active' : '' }}">
                            <a href="{{ route('datakelas') }}">
                                <span class="sub-item">Kelas</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('mapel') ? 'active' : '' }}">
                            <a href="{{ route('mapel') }}">
                                <span class="sub-item">Mata Pelajaran</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('semester') ? 'active' : '' }}">
                            <a href="{{ route('semester') }}">
                                <span class="sub-item">Semester</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('datauser') ? 'active' : '' }}">
                            <a href="{{ route('datauser') }}">
                                <span class="sub-item">Data User</span>
                            </a>
                        </li>
                    </ul>
                </div>
                </li>
                @if (Auth::user()->role == 'Admin')
                    <li class="nav-item {{ request()->routeIs('rombel') ? 'active' : '' }} ">
                        <a href="{{ route('rombel') }}" class="">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>Rombel</p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('jadwal') ? 'active' : '' }} ">
                        <a href="{{ route('jadwal') }}">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Jadwal </p>

                        </a>
                    </li>
                @endif
                <li class="nav-item {{ request()->routeIs('absen') ? 'active' : '' }} ">
                    <a href="{{ route('absen') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Absensi </p>

                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{ route('nilai') }}">
                        <i class="fas fa-signal"></i>
                        <p>Nilai Siswa</p>
                    </a>
                </li>
                @if (Auth::user()->role == 'Admin')
                    <li class="nav-item  {{ request()->routeIs('berita') ? 'active' : '' }}">
                        <a href="{{ route('berita') }}">
                            <i class="fas fa-newspaper"></i>
                            <p>Berita</p>
                        </a>
                    </li>
                    <li class="nav-item  {{ request()->routeIs('laporan') ? 'active' : '' }}">
                        <a href="{{ route('laporan') }}">
                            <i class="fa fa-print"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
