<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        @can('pengumuman-list')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pengumuman.index') }}">
                    <i class="fi fi-sr-megaphone" style="font-size: 16px; margin-right: 10px;"></i>
                    <span class="menu-title">Pengumuman</span>
                </a>
            </li>
        @endcan

        @canany(['gurus-list', 'orangtua-list', 'santris-list'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="fi fi-rr-users-alt" style="font-size: 16px; margin-right: 10px;"></i>
                    <span class="menu-title">Data Identitas</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        @can('admins-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.index') }}">Admin</a></li>
                        @endcan
                        @can('gurus-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('guru.index') }}">Tenaga Pendidik</a></li>
                        @endcan
                        @can('orangtua-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('orangtua.index') }}">Wali Santri</a></li>
                        @endcan
                        @can('santris-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('santri.index') }}">Santri</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        @canany(['kelas-list', 'mastermapel-list', 'mapelkelas-list', 'masterekskul-list'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                    aria-controls="form-elements">
                    <i class="fi fi-sr-workshop" style="font-size: 16px; margin-right: 10px;"></i>
                    <span class="menu-title">Data Pembelajaran</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="form-elements">
                    <ul class="nav flex-column sub-menu">
                        @can('kelas-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('kelas.index') }}">Kelas</a></li>
                        @endcan
                        @can('mastermapel-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('master_mapel.index') }}">Mata
                                    Pelajaran</a></li>
                        @endcan
                        @can('mapelkelas-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('mapel_kelas.index') }}">Klasifikasi Mata
                                    Pelajaran</a></li>
                        @endcan
                        @can('masterekskul-list')
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('master_ekskul.index') }}">Ekstrakurikuler</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        @canany(['raport-list', 'nilairaports-list', 'raportp5-list', 'ekskulraport-list'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#raport" aria-expanded="false" aria-controls="raport">
                    <i class="fi fi-rr-books" style="font-size: 16px; margin-right: 10px;"></i>
                    <span class="menu-title">e-Raport</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="raport">
                    <ul class="nav flex-column sub-menu">
                        @can('raport-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('raport.index') }}">Buku Raport</a></li>
                        @endcan
                        @can('nilairaports-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('detail-nilai-raport.index') }}">Penilaian
                                    Raport</a></li>
                        @endcan
                        @can('raportp5-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('detail-raport-p5.index') }}">Catatan
                                    Raport P5</a></li>
                        @endcan
                        @can('ekskulraport-list')
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('detail_ekskul_raport.index') }}">Penilaian Ekstrakurikuler</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        @canany(['jeniskasus-list', 'kasus-list'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#kasus" aria-expanded="false" aria-controls="kasus">
                    <i class="fi fi-sr-file-exclamation" style="font-size: 16px; margin-right: 10px;"></i>
                    <span class="menu-title">Data Kasus</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="kasus">
                    <ul class="nav flex-column sub-menu">
                        @can('jeniskasus-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('jenis_kasus.index') }}">Data Jenis
                                    Kasus</a></li>
                        @endcan
                        @can('kasus-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('kasus.index') }}">Kasus Santri</a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        @canany(['surah-list', 'tahfidz-list', 'fiqih-list', 'inggris-list', 'arab-list'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#subjek" aria-expanded="false" aria-controls="subjek">
                    <i class="fi fi-sr-dictionary-open" style="font-size: 16px; margin-right: 10px;"></i>
                    <span class="menu-title">Subjek Hafalan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="subjek">
                    <ul class="nav flex-column sub-menu">
                        @can('surah-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('surah.index') }}">Subjek Surah</a>
                            </li>
                        @endcan
                        @can('tahfidz-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('tahfidz.index') }}">Subjek Tahfidz</a>
                            </li>
                        @endcan
                        @can('fiqih-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('fiqih.index') }}">Subjek Fiqih</a>
                            </li>
                        @endcan
                        @can('inggris-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('inggris.index') }}">Subjek Inggris</a>
                            </li>
                        @endcan
                        @can('arab-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('arab.index') }}">Subjek Arab</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        @canany(['hafalansurah-list', 'hafalantahfidz-list', 'hafalanfiqih-list', 'hafalaninggris-list', 'hafalanarab-list'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#hafalan" aria-expanded="false"
                    aria-controls="hafalan">
                    <i class="fi fi-sr-book-open-reader" style="font-size: 16px; margin-right: 10px;"></i>
                    <span class="menu-title">Catatan Hafalan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="hafalan">
                    <ul class="nav flex-column sub-menu">
                        @can('hafalansurah-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('hafalan-surah.index') }}">Hafalan
                                    Surah</a></li>
                        @endcan
                        @can('hafalantahfidz-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('hafalan-tahfidz.index') }}">Hafalan
                                    Tahfidz</a></li>
                        @endcan
                        @can('hafalanfiqih-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('hafalan-fiqih.index') }}">Hafalan
                                    Fiqih</a></li>
                        @endcan
                        @can('hafalaninggris-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('hafalan-inggris.index') }}">Hafalan
                                    Inggris</a></li>
                        @endcan
                        @can('hafalanarab-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('hafalan-arab.index') }}">Hafalan
                                    Arab</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        @canany(['mading-list', 'masterasas-list', 'kategorimading-list', 'kandunganmading-list'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#mading" aria-expanded="false" aria-controls="mading">
                    <i class="fi fi-sr-gallery" style="font-size: 16px; margin-right: 10px;"></i>
                    <span class="menu-title">e-Mading</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="mading">
                    <ul class="nav flex-column sub-menu">
                        @can('masterasas-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('master-asas.index') }}">Asas
                                    Mading</a></li>
                        @endcan
                        @can('kategorimading-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('kategori-mading.index') }}">Kategori
                                    Mading</a></li>
                        @endcan
                        @can('mading-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('mading.index') }}">Mading</a></li>
                        @endcan
                        @can('kandunganmading-list')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('kandungan-mading.index') }}">Kandungan
                                    Mading</a></li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endcanany

        @can('kalenderakademik-list')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kalender_akademik.index') }}">
                    <i class="fi fi-sr-calendar-days" style="font-size: 16px; margin-right: 10px;"></i>
                    <span class="menu-title">Kalender Akademik</span>
                </a>
            </li>
        @endcan

        @can('peraturan-list')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('peraturan.index') }}">
                    <i class="fi fi-sr-rules-alt" style="font-size: 16px; margin-right: 10px;"></i>
                    <span class="menu-title">Peraturan</span>
                </a>
            </li>
        @endcan

        @can('role-list')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="fa-solid fa-person" style="font-size: 16px; margin-right: 10px;"></i>
                    <span class="menu-title">Roles</span>
                </a>
            </li>
        @endcan

        @can('chat-list')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('chat') }}">
                    <i class="fi fi-sr-comment" style="font-size: 16px; margin-right: 10px;"></i>
                    <span class="menu-title">Chat</span>
                </a>
            </li>
        @endcan
    </ul>
</nav>
