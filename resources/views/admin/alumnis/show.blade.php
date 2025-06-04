<!doctype html>
<html lang="en">

<head>
    @include('admin.head')
    <title>Detail Alumni</title>
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
            <!-- Konten Alumni -->
            <div class="container-fluid">
                <h1>Alumni Details</h1>

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Nama:</strong>
                            {{ $alumni->nama }}
                        </div>

                        <div class="mb-3">
                            <strong>Nama Cantik:</strong>
                            {{ $alumni->nama_cantik }}
                        </div>

                        <div class="mb-3">
                            <strong>Gambar:</strong>
                            @if ($alumni->gambar)
                                <img src="{{ asset('storage/' . $alumni->gambar) }}" alt="{{ $alumni->nama }}" width="200">
                            @else
                                Tidak ada gambar
                            @endif
                        </div>

                        <a href="{{ route('admin.alumnis.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <!-- Akhir Konten Alumni -->

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
