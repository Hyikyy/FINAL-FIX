<nav id="navmenu" class="navmenu">
    <ul>
      <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li><a href="{{ route('admin.struktur.index') }}">Struktur</a></li>
      <li><a href="{{ route('admin.galeri.index') }}">Galeri</a></li>
      <li><a href="{{ route('admin.blog.index') }}">Blog</a></li>
      <li class="dropdown"><a href="{{ route('admin.about_item.index') }}"><span>About</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
        <ul>
          <li><a href="{{ route('admin.sejarah.index') }}">Sejarah</a></li>
          <li><a href="{{ route('admin.visi-misi.index') }}">Visi & Misi</a></li>
          <li><a href="{{ route('admin.daftar_dosen.index') }}">Daftar Dosen</a></li>
          <li><a href="{{ route('admin.daftar_alumni.index') }}">Daftar Alumni</a></li>
          <li><a href="{{ route('admin.teaching_assistant.index') }}">Daftar TA</a></li>
          <li><a href="{{ route('admin.apa_kata_alumni.index') }}">Apa Kata Alumni</a></li>
          <li><a href="{{ route('admin.kegiatan.index') }}">Jadwal Kegiatan </a></li>

        </ul>
      </li>
      <li><a href="{{ route('keuangan') }}">Keuangan</a></li>

        @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @else
            @if (Auth::guard('admin')->check())
            @endif

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        @endguest
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>
