<!doctype html>
<html lang="en">

<head>
    @include('admin.head')
    <title>Financial transaction management</title>
    {{-- Pastikan Anda menyertakan Font Awesome jika menggunakan ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    /* Styling untuk tombol aksi agar sebaris dan rapi */
    .action-buttons .btn,
    .action-buttons form {
        display: inline-block; /* Membuat form juga inline */
        margin-right: 5px;   /* Jarak antar tombol/form */
        margin-bottom: 5px;  /* Jarak jika tombol wrap ke baris baru di layar kecil */
        vertical-align: middle; /* Menyamakan alignment vertikal tombol */
    }

    /* Menghilangkan margin kanan pada elemen terakhir */
    .action-buttons .btn:last-child,
    .action-buttons form:last-child {
        margin-right: 0;
    }

    /* Opsional: Jika ingin tombol memiliki lebar minimum agar lebih seragam */
    /*
    .action-buttons .btn {
        min-width: 70px;
        text-align: center;
    }
    */

        .table th, .table td {
            vertical-align: middle;
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
            <br><br>
            <!-- Konten Keuangan -->
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Financial transaction management</h1>
                    <a href="{{ route('admin.keuangan.create') }}" class="btn btn-primary">
                        Create Transaction
                    </a>
                </div>


                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Filter --}}
                <div class="card mb-4">
                    <div class="card-header">
                        Filter Transaksi
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.keuangan.index') }}" class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label for="filter_bulan" class="form-label">Bulan:</label>
                                <select name="filter_bulan" id="filter_bulan" class="form-select">
                                    <option value="">Semua Bulan</option>
                                    @if(isset($monthsForFilter))
                                        @foreach($monthsForFilter as $num => $name)
                                            <option value="{{ $num }}" {{ request('filter_bulan') == $num ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filter_tahun" class="form-label">Tahun:</label>
                                <select name="filter_tahun" id="filter_tahun" class="form-select">
                                    <option value="">Semua Tahun</option>
                                     @if(isset($yearsForFilter))
                                        @foreach($yearsForFilter as $year)
                                             <option value="{{ $year }}" {{ request('filter_tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filter_jenis" class="form-label">Jenis:</label>
                                <select name="filter_jenis" id="filter_jenis" class="form-select">
                                    <option value="">Semua Jenis</option>
                                    <option value="pemasukan" {{ request('filter_jenis') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                    <option value="pengeluaran" {{ request('filter_jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info w-100"><i class="fas fa-filter"></i> Filter</button>
                            </div>
                             <div class="col-md-1">
                                <a href="{{ route('admin.keuangan.index') }}" class="btn btn-secondary w-100" title="Reset Filter">
                                    <i class="fas fa-sync-alt"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        Daftar Transaksi
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                        <th>Jenis</th>
                                        <th class="text-end">Jumlah (Rp)</th>
                                        <th>Oleh</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transaksis as $index => $transaksi) {{-- Variabel $transaksis dari controller --}}
                                        <tr>
                                            <td>{{ $transaksis->firstItem() + $index }}</td>
                                            <td>{{ $transaksi->tanggal->translatedFormat('d M Y') }}</td>
                                            <td>{{ Str::limit($transaksi->deskripsi, 50) }}</td>
                                            <td>
                                                @if($transaksi->jenis == 'pemasukan')
                                                    <span class="badge bg-success">Pemasukan</span>
                                                @else
                                                    <span class="badge bg-danger">Pengeluaran</span>
                                                @endif
                                            </td>
                                            <td class="text-end">{{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                                            <td>{{ $transaksi->user->name ?? 'N/A' }}</td>
                                            <td class="action-buttons">
                                                <a href="{{ route('admin.keuangan.show', $transaksi->id) }}" class="btn btn-sm btn-info" title="Detail">
                                                   See
                                                </a>
                                                <a href="{{ route('admin.keuangan.edit', $transaksi->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.keuangan.destroy', $transaksi->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada data transaksi yang sesuai dengan filter.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- Pagination --}}
                        @if(isset($transaksis) && $transaksis->hasPages())
                        <div class="mt-3">
                            {{ $transaksis->appends(request()->query())->links() }}
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Ringkasan Saldo --}}
                 @if(isset($totalPemasukanFiltered) && isset($totalPengeluaranFiltered) && isset($saldoKasKeseluruhan))
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="card bg-success text-white shadow">
                            <div class="card-body">
                                <div class="fw-bold text-uppercase mb-1">Total Pemasukan (Periode Difilter)</div>
                                <div class="h4 mb-0">Rp {{ number_format($totalPemasukanFiltered, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card bg-danger text-white shadow">
                            <div class="card-body">
                                <div class="fw-bold text-uppercase mb-1">Total Pengeluaran (Periode Difilter)</div>
                                <div class="h4 mb-0">Rp {{ number_format($totalPengeluaranFiltered, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card bg-info text-white shadow">
                            <div class="card-body">
                                <div class="fw-bold text-uppercase mb-1">Surplus/Defisit (Periode Difilter)</div>
                                <div class="h4 mb-0">Rp {{ number_format($totalPemasukanFiltered - $totalPengeluaranFiltered, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row mt-1">
                    <div class="col-md-12">
                        <div class="card bg-primary text-white shadow-lg">
                            <div class="card-body text-center">
                                <div class="fw-bold text-uppercase mb-1">SALDO KAS KESELURUHAN HIMATIF</div>
                                <div class="display-5 fw-bolder">Rp {{ number_format($saldoKasKeseluruhan, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif


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
</body>
</html>
