<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('admin/assets/images/logos/logo.svg') }}" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Apps</span>
                </li>
                <!-- Struktur Organisasi Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.struktur-organisasi.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <iconify-icon icon="solar:users-group-rounded-line-duotone"></iconify-icon>
                            </span>
                            <span class="hide-menu">Struktur Organisasi</span>
                        </div>
                    </a>
                </li>
                <!-- Agenda Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.agendas.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
                            </span>
                            <span class="hide-menu">Agenda</span>
                        </div>
                    </a>
                </li>
                <!-- Berita Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.beritas.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <iconify-icon icon="solar:document-text-line-duotone"></iconify-icon>
                            </span>
                            <span class="hide-menu">Berita</span>
                        </div>
                    </a>
                </li>
                <!-- Galeri Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.galeri.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <iconify-icon icon="solar:gallery-line-duotone"></iconify-icon>
                            </span>
                            <span class="hide-menu">Galeri</span>
                        </div>
                    </a>
                </li>
                <!-- Visi Misi Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.visi_misi.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <iconify-icon icon="solar:target-line-duotone"></iconify-icon>
                            </span>
                            <span class="hide-menu">Visi & Misi</span>
                        </div>
                    </a>
                </li>
                <!-- Feedback Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.feedback.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <iconify-icon icon="solar:chat-round-line-duotone"></iconify-icon>
                            </span>
                            <span class="hide-menu">Feedback</span>
                        </div>
                    </a>
                </li>
                <!-- Dosen Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.dosens.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <iconify-icon icon="solar:users-line-duotone"></iconify-icon>
                            </span>
                            <span class="hide-menu">Dosen</span>
                        </div>
                    </a>
                </li>
                <!-- Alumni Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.alumnis.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <iconify-icon icon="solar:users-group-rounded-line-duotone"></iconify-icon>
                            </span>
                            <span class="hide-menu">Alumni</span>
                        </div>
                    </a>
                </li>
                <!-- Teaching Assistant Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.teaching_assistants.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <iconify-icon icon="solar:user-graduation-line-duotone"></iconify-icon>
                            </span>
                            <span class="hide-menu">Teaching Assistant</span>
                        </div>
                    </a>
                </li>
                <!-- Apa Kata Alumni Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.apa_kata_alumni.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <iconify-icon icon="solar:chat-round-line-duotone"></iconify-icon>
                            </span>
                            <span class="hide-menu">Apa Kata Alumni</span>
                        </div>
                    </a>
                </li>
                <!-- Keuangan Link -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.keuangan.index') }}" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                            <span class="d-flex">
                                <iconify-icon icon="solar:wallet-line-duotone"></iconify-icon>
                            </span>
                            <span class="hide-menu">Keuangan</span>
                        </div>
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                    </a>
                </li>


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>