<!doctype html>
<html lang="en">

<head>
    @include('admin.head')
    <title>Detail Agenda</title>
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
            <!-- Konten Agenda -->
            <div class="container-fluid">
                <h1>Agenda Details</h1>

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Nama Kegiatan:</strong>
                            {{ $agenda->nama_kegiatan }}
                        </div>

                        <div class="mb-3">
                            <strong>Tanggal Kegiatan:</strong>
                            {{ $agenda->tanggal_kegiatan }}
                        </div>

                        <div class="mb-3">
                            <strong>Deskripsi:</strong>
                            {{ $agenda->deskripsi }}
                        </div>

                        <a href="{{ route('admin.agendas.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <!-- Akhir Konten Agenda -->

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
