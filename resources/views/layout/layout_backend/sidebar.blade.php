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
                            <li>
                                <a href="{{ route('allsiswa') }}"
                                    class="{{ request()->is('allsiswa') ? 'active' : '' }}">
                                    <span class="sub-item">All DataSiswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('datasiswa') }}"
                                    class="{{ request()->is('datasiswa') ? 'active' : '' }}">
                                    <span class="sub-item">Data Siswa </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dataguru') }}"
                                    class="{{ request()->is('dataguru') ? 'active' : '' }}">
                                    <span class="sub-item">Data Guru</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('mapel') }}" class="{{ request()->is('mapel') ? 'active' : '' }}">
                                    <span class="sub-item">Mata Pelajaran</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('semester') }}"
                                    class="{{ request()->is('semester') ? 'active' : '' }}">
                                    <span class="sub-item">Semester</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('datauser') }}"
                                    class="{{ request()->is('datauser') ? 'active' : '' }}">
                                    <span class="sub-item">Data User</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sidebarBk">
                        <i class="fas fa-layer-group"></i>
                        <p>Bimbingan Konseling</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarBk">
                        <ul class="nav nav-collapse">

                            <li>
                                <a href="{{ route('pelanggaran') }}"
                                    class="{{ request()->is('pelanggaran') ? 'active' : '' }}">
                                    <span class="sub-item">Pelanggaran</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tataTertib') }}"
                                    class="{{ request()->is('tataTertib') ? 'active' : '' }}">
                                    <span class="sub-item">Tata Tertib</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Prestasi Siswa</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#rombel">
                        <i class="fas fa-layer-group"></i>
                        <p>Rombongan Belajar </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="rombel">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('datakelas') }}"
                                    class="{{ request()->is('datakelas') ? 'active' : '' }}">
                                    <span class="sub-item">Kelas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rombel') }}" class="{{ request()->is('rombel') ? 'active' : '' }}">
                                    <span class="sub-item">Kelas Pelajaran</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#absen">
                        <i class="fas fa-layer-group"></i>
                        <p>Absensi </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="absen">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('absen') }}" class="{{ request()->is('absen') ? 'active' : '' }}">
                                    <span class="sub-item">Absensi</span>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('kelola_absen') }}"
                                    class="{{ request()->is('kelola_absen') ? 'active' : '' }}">
                                    <span class="sub-item">Kelola Absen</span>
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
                <li class="nav-item  ">
                    <a href="">
                        <i class="fas fa-th-list"></i>
                        <p>E-Raport</p>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{ route('berita') }}">
                        <i class="fas fa-th-list"></i>
                        <p>Berita</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
