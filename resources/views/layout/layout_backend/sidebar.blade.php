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
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-layer-group"></i>
                        <p>Data Master</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('allsiswa') ? 'active' : '' }}">
                                <a href="{{ route('allsiswa') }}" >
                                    <span class="sub-item">All DataSiswa</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('datasiswa') ? 'active' : '' }}">
                                <a href="{{ route('datasiswa') }}" >
                                    <span class="sub-item">Data Siswa </span>
                                </a>
                            </li>
                            <li class="{{ request()->is('dataguru') ? 'active' : '' }}">
                                <a href="{{ route('dataguru') }}" >
                                    <span class="sub-item">Data Guru</span>
                                </a>
                            </li>

                            <li class="{{ request()->is('mapel') ? 'active' : '' }}">
                                <a href="{{ route('mapel') }}" >
                                    <span class="sub-item">Mata Pelajaran</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('semester') ? 'active' : '' }}">
                                <a href="{{ route('semester') }}" >
                                    <span class="sub-item">Semester</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('datauser') ? 'active' : '' }}">
                                <a href="{{ route('datauser') }}" >
                                    <span class="sub-item">Data User</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item  {{ request()->routeIs('datakelas') ? 'active' : '' }}">
                    <a href="{{ route('datakelas') }}" class="">
                        <i class="fas fa-th-list"></i>
                        <p>Kelas</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('rombel') ? 'active' : '' }} ">
                    <a href="{{ route('rombel') }}" class="">
                        <i class="fas fa-th-list"></i>
                        <p>Rombel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#absen">
                        <i class="fas fa-layer-group"></i>
                        <p>Absensi </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="absen">
                        <ul class="nav nav-collapse">
                            {{-- <li>
                                <a href="{{ route('absen') }}" class="{{ request()->is('absen') ? 'active' : '' }}">
                                    <span class="sub-item">Absensi</span>
                                </a>
                            </li> --}}
            </ul>
        </div>
        </li>
        <li class="nav-item  ">
            <a href="">
                <i class="fas fa-th-list"></i>
                <p>Nilai Siswa</p>
            </a>
        </li>
        </ul>
    </div>
</div>
</div>
