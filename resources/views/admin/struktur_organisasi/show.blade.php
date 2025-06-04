<!doctype html>
<html lang="en">

<head>
    @include('admin.head')
    <style>
        /* CSS dari tampilan user yang relevan untuk satu kartu */
        .team .member {
            position: relative;
            box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 5px;
            background: #fff;
            transition: 0.5s;
            height: 100%; /* Untuk align-items-stretch jika digunakan pada kolom */
            display: flex; /* Tambahkan ini */
            flex-direction: column; /* Tambahkan ini */
        }

        .team .member img {
            /* Ukuran gambar bisa disesuaikan jika ingin lebih besar untuk detail view */
            max-width: 100%; /* Default agar responsive */
            /* width: 200px; */ /* Contoh jika ingin ukuran tetap */
            /* height: 200px; */
            /* object-fit: cover; */
            border-radius: 5px;
            margin: 0 auto 30px auto; /* Tengah dan spasi bawah */
            display: block;
        }

        .team .member h4 {
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 20px;
            color: #37517e; /* Sesuaikan dengan warna tema Anda jika perlu */
        }

        .team .member span {
            display: block;
            font-size: 15px;
            padding-bottom: 10px;
            position: relative;
            font-weight: 500;
        }

        .team .member span::after {
            content: "";
            position: absolute;
            display: block;
            width: 50px;
            height: 1px;
            background: #cbd6e9; /* Sesuaikan dengan warna tema Anda jika perlu */
            bottom: 0;
            left: 0; /* Rata kiri di bawah span jabatan */
        }

        .team .member p {
            margin: 10px 0 0 0;
            font-size: 14px;
            flex-grow: 1; /* Agar deskripsi mengisi sisa ruang */
        }

        /* Styling tambahan untuk halaman detail admin */
        .detail-card-container {
            max-width: 700px; /* Batasi lebar maksimum kartu detail */
            margin: 0 auto; /* Pusatkan kartu */
        }

        .info-label {
            font-weight: 600;
            color: #555;
        }
        .info-value {
            color: #000;
        }

        /* Tombol back */
        .btn-back-custom {
            margin-top: 20px;
        }

    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar Start -->
        @include('admin.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('admin.header')
            <!--  Header End -->

            <!-- Konten Detail Struktur Organisasi -->
            <div class="container-fluid" style="padding-top: 20px;">
                <div class="row mb-3">
                    <div class="col-12">
                         {{-- Judul halaman bisa disesuaikan --}}
                        <h3 class="fw-bold text-center">Detail Anggota Organisasi</h3>
                    </div>
                </div>

                <div class="detail-card-container"> {{-- Wrapper untuk membatasi lebar dan memusatkan --}}
                    <div class="team"> {{-- Class team untuk mengambil style dasar member --}}
                        <div class="member">
                            @if($strukturOrganisasi->gambar)
                            <img src="{{ asset('storage/struktur_organisasi/' . $strukturOrganisasi->gambar) }}" class="img-fluid"
                                alt="{{ $strukturOrganisasi->nama_anggota }}">
                            @else
                            {{-- Ganti dengan path default image yang sesuai untuk admin jika ada, atau yang sama dengan user --}}
                            <img src="{{ asset('assets/img/team/team-1.jpg') }}" class="img-fluid" alt="Default Image">
                            @endif

                            {{-- Nama Anggota --}}
                            <h4 style="color: #000000;">{{ $strukturOrganisasi->nama_anggota }}</h4>
                            {{-- Jabatan --}}
                            <span style="color: #000000;">{{ $strukturOrganisasi->nama_jabatan }}</span>
                            {{-- Deskripsi Jabatan --}}
                            <p style="color: #000000;">
                                {{ $strukturOrganisasi->deskripsi_jabatan }}
                            </p>

                            {{-- Informasi Tambahan seperti Periode, bisa diletakkan di sini jika ingin tetap ada --}}
                            <div style="margin-top: 15px; padding-top:15px; border-top: 1px solid #eee;">
                                <p class="mb-1">
                                    <strong class="info-label">Periode:</strong>
                                    <span class="info-value">{{ $strukturOrganisasi->periode }}</span>
                                </p>
                                {{-- Anda bisa menambahkan field lain di sini jika perlu --}}
                            </div>

                        </div>
                    </div>
                </div>

                <div class="text-center"> {{-- Pusatkan tombol back --}}
                    <a href="{{ route('admin.struktur-organisasi.index') }}" class="btn btn-secondary btn-back-custom">Kembali ke Daftar</a>
                </div>

            </div>
            <!-- Akhir Konten Struktur Organisasi -->

        </div>
    </div>
    <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
