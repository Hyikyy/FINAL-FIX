<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between py-3 px-3" style="background-color: #444347;">
            <a href="./index.html" class="text-nowrap logo-img d-flex align-items-center">
                <img src="{{ asset('assets/img/himatif/himatif.jpg') }}"  alt="Logo HIMATIF" width="40" height="40" style="border-radius: 50%; object-fit: cover;">
                <span class="ms-2 text-white">HIMATIF</span>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-white"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav" class="pt-3">
                <!-- Apps Heading -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">MENU</span>
                </li>

                {{-- ADMIN DASHBOARD LINK --}}
                @if(Auth::user()->isAdmin())
                    <li class="sidebar-item">
                        <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                            <i class="ti ti-home fs-5 me-2"></i>  {{-- Ganti icon sesuai keinginan --}}
                            <span class="hide-menu">Home</span>
                        </a>
                    </li>
                @endif

                <!-- Menu Items -->
                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.struktur-organisasi.index') }}" aria-expanded="false">
                        <i class="ti ti-users fs-5 me-2"></i>
                        <span class="hide-menu">Organizational Structure</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.agendas.index') }}" aria-expanded="false">
                        <i class="ti ti-calendar fs-5 me-2"></i>
                        <span class="hide-menu">Agenda</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.beritas.index') }}" aria-expanded="false">
                        <i class="ti ti-article fs-5 me-2"></i>
                        <span class="hide-menu">Blog</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.galeri.index') }}" aria-expanded="false">
                        <i class="ti ti-camera fs-5 me-2"></i>
                        <span class="hide-menu">Gallery</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.galeri-kategori.index') }}" aria-expanded="false">
                        <i class="ti ti-camera fs-5 me-2"></i>
                        <span class="hide-menu">Category Gallery</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.visi_misi.index') }}" aria-expanded="false">
                        <i class="ti ti-target fs-5 me-2"></i>
                        <span class="hide-menu">Vision & Mission</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.feedback.index') }}" aria-expanded="false">
                        <i class="ti ti-message fs-5 me-2"></i>
                        <span class="hide-menu">Feedback</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.dosens.index') }}" aria-expanded="false">
                        <i class="ti ti-user-circle fs-5 me-2"></i>
                        <span class="hide-menu">Dosen</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.alumnis.index') }}" aria-expanded="false">
                        <i class="ti ti-users fs-5 me-2"></i>
                        <span class="hide-menu">Alumni</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.teaching_assistants.index') }}" aria-expanded="false">
                        <i class="ti ti-briefcase fs-5 me-2"></i>
                        <span class="hide-menu">Teaching Assistant</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.apa_kata_alumni.index') }}" aria-expanded="false">
                        <i class="ti ti-message-circle fs-5 me-2"></i>
                        <span class="hide-menu">Apa Kata Alumni</span>
                    </a>
                </li>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('admin.keuangan.index') }}" aria-expanded="false">
                        <i class="ti ti-wallet fs-5 me-2"></i>
                        <span class="hide-menu">Finance</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-expanded="false">
                        <i class="ti ti-logout fs-5 me-2"></i>
                        <span class="hide-menu">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>