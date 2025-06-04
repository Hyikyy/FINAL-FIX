<!doctype html>
<html lang="en">

<head>
    @include('admin.head')
    <title>Financial Transaction Details</title> {{-- Judul disesuaikan --}}
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
            <br><br>
            <!-- Konten Keuangan -->
            <div class="container-fluid">
                <h1>Financial Transaction Details</h1>

                <div class="card">
                    <div class="card-header">
                        Detail Transaksi ID: #{{ $keuangan->id }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Tanggal Transaksi:</strong> {{ $keuangan->tanggal ? \Carbon\Carbon::parse($keuangan->tanggal)->translatedFormat('l, d F Y') : 'N/A' }}</p>
                                <p><strong>Deskripsi:</strong> {{ $keuangan->deskripsi }}</p>
                                <p><strong>Jenis Transaksi:</strong>
                                    @if($keuangan->jenis == 'pemasukan')
                                        <span class="badge bg-success text-capitalize">{{ $keuangan->jenis }}</span>
                                    @elseif($keuangan->jenis == 'pengeluaran')
                                        <span class="badge bg-danger text-capitalize">{{ $keuangan->jenis }}</span>
                                    @else
                                        <span class="badge bg-secondary text-capitalize">{{ $keuangan->jenis ?? 'Tidak Diketahui' }}</span>
                                    @endif
                                </p>
                                <p><strong>Jumlah:</strong> Rp {{ number_format($keuangan->jumlah, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Dicatat Oleh:</strong> {{ $keuangan->user->name ?? 'Sistem' }}</p>
                                <p><strong>Dibuat Pada:</strong> {{ $keuangan->created_at ? $keuangan->created_at->translatedFormat('l, d F Y H:i:s') : 'N/A' }}</p>
                                <p><strong>Diperbarui Pada:</strong> {{ $keuangan->updated_at ? $keuangan->updated_at->translatedFormat('l, d F Y H:i:s') : 'N/A' }}</p>
                            </div>
                        </div>

                        <hr>
                        <a href="{{ route('admin.keuangan.edit', $keuangan->id) }}" class="btn btn-warning">
                         Edit
                        </a>
                        <a href="{{ route('admin.keuangan.index') }}" class="btn btn-secondary">
                         Back to List
                        </a>
                    </div>
                </div>
            </div>
            <!-- Akhir Konten Keuangan -->

        </div>
    </div>
    {{-- Script assets --}}
    <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    {{-- Pastikan Anda menyertakan Font Awesome jika menggunakan ikon seperti fas fa-edit --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>

</html>
