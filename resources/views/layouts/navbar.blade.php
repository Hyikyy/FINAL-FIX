<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ route('welcome')}}" class="{{ Route::currentRouteName() == 'welcome' ? 'active' : '' }}">Home</a></li>

        {{-- ABOUT US DROPDOWN --}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle {{ Route::currentRouteName() == 'about_us.showPublic' || Route::currentRouteName() == 'sejarah.showPublic' || Route::currentRouteName() == 'dosen.showPublic' || Route::currentRouteName() == 'teaching_assistants.indexPublic' || Route::currentRouteName() == 'alumni.indexPublic' ? 'active' : '' }}" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                <span>About Us</span>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('about_us.showPublic') }}">About Us</a></li>
                <li><a class="dropdown-item" href="{{ route('sejarah.showPublic') }}">Sejarah</a></li>
                <li><a class="dropdown-item" href="{{ route('dosen.showPublic') }}">Dosen</a></li>
                <li><a class="dropdown-item" href="{{ route('teaching_assistants.indexPublic') }}">Teaching Assistant</a></li>
                <li><a class="dropdown-item" href="{{ route('alumni.indexPublic') }}">Alumni</a></li>
            </ul>
        </li>

        {{-- ORGANIZATIONAL STRUCTURE DROPDOWN --}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle {{ Route::currentRouteName() == 'struktur-organisasi.public' || Route::currentRouteName() == 'visi_misi.public' ? 'active' : '' }}" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                <span>Organizational Structure</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item {{ Route::currentRouteName() == 'visi_misi.public' ? 'active' : '' }}"
                       href="{{ route('visi_misi.public') }}">
                       Vision and Mission
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ Route::currentRouteName() == 'struktur-organisasi.public' ? 'active' : '' }}"
                       href="{{ route('struktur-organisasi.public') }}">
                       Organizational Structure
                    </a>
                </li>
            </ul>
        </li>

        <li><a href="{{ route('beritas.public') }}" class="{{ Route::currentRouteName() == 'beritas.public' ? 'active' : '' }}">Blog</a></li>
        <li><a href="{{ route('galeri.index') }}" class="{{ Route::currentRouteName() == 'galeri.index' ? 'active' : '' }}">Gallery</a></li>
        <li><a href="{{ route('apa_kata_alumni.index') }}" class="{{ Route::currentRouteName() == 'apa_kata_alumni.index' ? 'active' : '' }}">Apa Kata Alumni</a></li>
        <li><a href="{{ route('keuangan.index') }}" class="{{ Route::currentRouteName() == 'keuangan.index' ? 'active' : '' }}">Finance</a></li>

        @guest
            <li><a href="{{ route('login') }}" class="{{ Route::currentRouteName() == 'login' ? 'active' : '' }}">Login</a></li>
        @endguest

        @auth
            {{--  ADMIN DASHBOARD LINK  --}}
            @if(Auth::user()->isAdmin())  {{-- Asumsi ada method isAdmin() di User model --}}
                <li><a href="{{ route('admin.dashboard') }}" class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">Dashboard Admin</a></li>
            @endif

            <li class="dropdown profile-dropdown-container">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="30,0" role="button" aria-expanded="false">
                    <i class="bi bi-person-circle" style="font-size: 1.5em;"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <span class="dropdown-item disabled">{{ Auth::user()->name }}</span>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endauth
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

@push('styles')
<style>
    /* === MOBILE DROPDOWN STYLING (ketika .mobile-nav-active ada di body/parent) === */
.mobile-nav-active .navmenu .dropdown ul {
    position: static; /* Override absolute positioning, kembali ke alur normal */
    display: none;    /* Sembunyikan submenu secara default, Bootstrap JS akan toggle */
    opacity: 1;       /* Pastikan terlihat jika display: block */
    visibility: visible;
    left: auto;       /* Reset posisi left/top */
    top: auto;
    margin: 10px 20px; /* Beri indentasi untuk membedakan dari item utama */
    padding: 10px 0;   /* Padding internal submenu */
    background: #f9f9f9; /* Background sedikit berbeda untuk membedakan, atau #fff */
    box-shadow: none;    /* Hapus shadow di mobile */
    border-radius: 4px; /* Sedikit radius */
    border-top: 1px solid #e5e5e5; /* Garis pemisah di atas submenu */
    /* Anda bisa juga menambahkan border di kiri jika ingin lebih mirip struktur tree */
    /* border-left: 1px solid #e5e5e5; */
}

/* Tampilkan submenu ketika Bootstrap membuka dropdown (link parent diklik) */
.mobile-nav-active .navmenu .dropdown > a[aria-expanded="true"] + ul {
    display: block;
}

/* Styling untuk item di dalam submenu mobile */
.mobile-nav-active .navmenu .dropdown ul a {
    padding: 8px 20px; /* Padding item submenu (bisa ditambah indentasi kiri) */
    /* padding-left: 30px; */ /* Contoh indentasi kiri yang lebih besar */
    font-size: 14px;  /* Font lebih kecil untuk submenu */
    color: #444;      /* Warna teks submenu */
    /* Tidak perlu justify-content: space-between; jika tidak ada panah lagi di submenu */
}

.mobile-nav-active .navmenu .dropdown ul a:hover,
.mobile-nav-active .navmenu .dropdown ul a.active { /* Jika item submenu bisa aktif */
    color: var(--nav-hover-color, #007bff); /* Warna hover/aktif submenu */
    background-color: #efefef; /* Background hover/aktif ringan */
}

</style>

@endpush