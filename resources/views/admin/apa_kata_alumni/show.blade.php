<!doctype html>
<html lang="en">

<head>
    @include('admin.head')
    <title>Detail Apa Kata Alumni</title>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
      data-sidebar-position="fixed" data-header-position="fixed">

      <!--  App Topstrip - DIHAPUS -->
        <!-- Sidebar Start -->
        @include('admin.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('admin.header')
            <!--  Header End -->
            <br><br>
            <!-- Konten Apa Kata Alumni -->
            <div class="container-fluid">
                <h1>Detail Apa Kata Alumni</h1>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nama: {{ $apaKataAlumni->nama }}</h5>
                        <p class="card-text"><strong>Pekerjaan:</strong> {{ $apaKataAlumni->pekerjaan }}</p> <!-- Tambahkan Pekerjaan -->
                        <p class="card-text"><strong>Angkatan:</strong> {{ $apaKataAlumni->angkatan }}</p>
                        <p class="card-text"><strong>Isi:</strong> {{ $apaKataAlumni->isi }}</p>
                          <!-- Tampilkan Gambar -->
                        @if($apaKataAlumni->gambar)
                            <img src="{{ asset('storage/apa_kata_alumni/' . $apaKataAlumni->gambar) }}" alt="{{ $apaKataAlumni->nama }}" width="200">
                        @endif
                        <a href="{{ route('admin.apa_kata_alumni.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
            <!-- Akhir Konten Apa Kata Alumni -->

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
