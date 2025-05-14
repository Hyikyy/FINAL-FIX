<nav id="navmenu" class="navmenu">
    <ul>
      <!-- <li><a href="{{ route('welcome') }}" class="active">Home</a></li> -->

      @guest
          <!-- Jika belum login -->
          <li><a href="{{ route('login') }}">Login</a></li>
          @if (Route::has('register'))
              <li><a href="{{ route('register') }}">Register</a></li>
          @endif
      @else
          <!-- Jika sudah login -->
          <li><a href="{{ route('welcome') }}">Home</a></li>
          <li><a href="{{ route('dosen.showPublic') }}">About Us</a></li>
          <li><a href="{{ route('struktur-organisasi.public') }}">Struktur Organisasi</a></li>
          <li><a href="{{ route('visi_misi.public') }}">Visi Misi</a></li>
          <li><a href="{{ route('beritas.public') }}">Berita</a></li>
          <li><a href="{{ route('galeri.index') }}">Galeri</a></li>
          <li><a href="{{ route('apa_kata_alumni.index') }}">Apa Kata Alumni</a></li>
          <li><a href="{{ route('keuangan.index') }}">Keuangan</a></li>
          <li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
            </a>
          </li>
          
      @endguest
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>