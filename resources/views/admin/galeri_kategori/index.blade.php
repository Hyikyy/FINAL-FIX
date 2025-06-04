<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> {{-- Tambahkan locale app --}}

<head>
    {{-- Asumsi 'admin.head' berisi meta tags, title dasar, dan link CSS utama admin --}}
    @include('admin.head')
    <title>Manajemen Kategori Galeri - Admin Panel</title> {{-- Judul lebih spesifik --}}

    {{-- CSS Khusus untuk halaman ini atau Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif; /* Contoh font dari template SB Admin */
            background-color: #f8f9fc;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-sm i {
            font-size: 0.8rem;
        }
        /* Anda mungkin perlu menambahkan lebih banyak style di sini atau di admin.head */
        /* untuk mereplikasi tampilan layout jika sebelumnya bergantung pada file layout */
        .page-wrapper {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
        }
        .body-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-x: hidden; /* Mencegah scroll horizontal jika konten melebihi */
        }
        .container-fluid {
            padding-top: 1.5rem; /* Beri padding atas untuk konten setelah header */
            padding-bottom: 1.5rem;
        }
        /* Styling dasar untuk card dan header (sesuaikan dengan tema admin Anda) */
        .card {
            border: 0;
            margin-bottom: 1.5rem;
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: .75rem 1.25rem;
        }
        .text-gray-800 {
            color: #5a5c69 !important;
        }
        .font-weight-bold { /* Jika menggunakan Bootstrap 4, jika Bootstrap 5 pakai fw-bold */
            font-weight: 700 !important;
        }
        .text-primary {
            color: #4e73df !important; /* Warna primary contoh */
        }
        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
        }

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
    </style>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
      data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar Start -->
        {{-- Asumsi 'admin.sidebar' adalah file partial untuk sidebar --}}
        @include('admin.sidebar')
        <!--  Sidebar End -->

        <!--  Main wrapper (konten utama + header) -->
        <div class="body-wrapper">
            <!--  Header Start -->
            {{-- Asumsi 'admin.header' adalah file partial untuk header --}}
            @include('admin.header')
            <!--  Header End -->

            <!-- Konten Utama Halaman -->
            <div class="container-fluid">
                {{-- Header Halaman Konten --}}
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1>Gallery Category Management</h1>
                    <a href="{{ route('admin.galeri-kategori.create') }}" class="btn btn-primary btn-icon-split btn-sm shadow-sm">
                      
                        <span class="text">Create Category</span>
                    </a>
                </div>

                {{-- Notifikasi Sukses/Error --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Card untuk Tabel Daftar Kategori --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Gallery Category </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTableKategori" width="100%" cellspacing="0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Slug</th>
                                        <th class="text-center">Jumlah Item</th>
                                        <th>Deskripsi</th>
                                        <th class="text-center" style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kategoris as $index => $kategori)
                                        <tr>
                                            <td>{{ $kategoris->firstItem() + $index }}</td>
                                            <td>
                                                <a href="{{ route('admin.galeri-kategori.show', $kategori->slug) }}" title="Lihat detail kategori">{{ $kategori->nama_kategori }}</a>
                                            </td>
                                            <td>{{ $kategori->slug }}</td>
                                            <td class="text-center">{{ $kategori->galeris_count }}</td>
                                            <td>{{ Str::limit($kategori->deskripsi, 70) }}</td>
                                            <td class="action-buttons">
                                                <a href="{{ route('admin.galeri-kategori.show', $kategori->slug) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                                See
                                                </a>
                                                <form action="{{ route('admin.galeri-kategori.destroy', $kategori->slug) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori \'{{ $kategori->nama_kategori }}\'?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus Kategori">
                                                    Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada kategori galeri.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination Links --}}
                        @if($kategoris->hasPages())
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $kategoris->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Akhir Konten Utama Halaman -->

            {{-- Footer Admin (Jika ada partial terpisah) --}}
            {{-- @include('admin.footer') --}}
            <footer class="footer text-center py-3 bg-light mt-auto">
                <div class="container-fluid">
                    <span class="text-muted">Hak Cipta © {{ date('Y') }} Kelompok 7 PA1. All rights reserved.</span>
                </div>
            </footer>

        </div>
        <!--  Main wrapper End -->
  </div>
  <!--  Body Wrapper End -->

  {{-- Script JavaScript Dasar Admin --}}
  {{-- Asumsi ini adalah script utama yang dibutuhkan semua halaman admin --}}
  <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  {{-- Jika 'admin.sidebar' membutuhkan script ini, pastikan path benar --}}
  @if(file_exists(public_path('admin/assets/js/sidebarmenu.js')))
    <script src="{{ asset('admin/assets/js/sidebarmenu.js') }}"></script>
  @endif
  @if(file_exists(public_path('admin/assets/js/app.min.js')))
    <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
  @endif
  {{-- Script lain yang mungkin umum seperti simplebar, dll. bisa diletakkan di sini atau di 'admin.footer_scripts' jika ada partial --}}
  @if(file_exists(public_path('admin/assets/libs/simplebar/dist/simplebar.js')))
    <script src="{{ asset('admin/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  @endif
  {{-- <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script> --}} {{-- Mungkin tidak perlu di semua halaman --}}
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

  {{-- Script Khusus Halaman (jika ada) --}}
  {{-- @stack('scripts') --}}
</body>
</html>
