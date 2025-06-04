<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.head')
    <title>Detail Item Galeri: {{ $galeri->judul }} - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #f8f9fc; }
        .page-wrapper { display: flex; min-height: 100vh; }
        .body-wrapper { flex-grow: 1; display: flex; flex-direction: column; }
        .container-fluid { padding-top: 1.5rem; padding-bottom: 1.5rem; }
        .card { border: 0; margin-bottom: 1.5rem; }
        .card-header { background-color: #fff; border-bottom: 1px solid #e3e6f0; padding: .75rem 1.25rem; }
        .text-gray-800 { color: #5a5c69 !important; }
        .font-weight-bold { font-weight: 700 !important; }
        .text-primary { color: #4e73df !important; }
        .shadow-sm { box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important; }
        .btn-icon-split .icon { background: rgba(0,0,0,0.15); display: inline-block; padding: .375rem .75rem; }
        .btn-icon-split .text { padding: .375rem .75rem; display: inline-block; }
        .detail-image {
            max-width: 100%;
            max-height: 500px; /* Batasi tinggi gambar agar tidak terlalu besar */
            display: block;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: .25rem;
        }
        .detail-info p { margin-bottom: 0.75rem; }
        .detail-info strong { min-width: 150px; display: inline-block;}
    </style>
</head>
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        @include('admin.sidebar')
        <div class="body-wrapper">
            @include('admin.header')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Gallery Item Detail</h1>
                     <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary btn-icon-split btn-sm shadow-sm">
                        <span class="text">Back to Gallery Item</span>
                    </a>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">{{ $galeri->judul }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-center mb-3 mb-md-0">
                                @if($galeri->gambar)
                                    <a href="{{ asset('storage/' . $galeri->gambar) }}" target="_blank" title="Lihat gambar ukuran penuh">
                                        <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}" class="detail-image img-fluid rounded shadow-sm">
                                    </a>
                                @else
                                    <div class="text-center p-5 bg-light">
                                        <i class="fas fa-image fa-5x text-gray-400"></i>
                                        <p class="text-muted mt-2">Gambar tidak tersedia</p>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 detail-info">
                                <h4 class="mb-3">{{ $galeri->judul }}</h4>
                                <p><strong>ID Gambar:</strong> #{{ $galeri->id }}</p>
                                <p><strong>Kategori:</strong>
                                    @if($galeri->kategoriGaleri)
                                        <a href="{{ route('admin.galeri-kategori.show', $galeri->kategoriGaleri->slug) }}">{{ $galeri->kategoriGaleri->nama_kategori }}</a>
                                    @else
                                        Tidak Berkategori
                                    @endif
                                </p>
                                <p><strong>Deskripsi:</strong></p>
                                <p>{{ $galeri->deskripsi_gambar ?: '-' }}</p>
                                <hr>
                                <p><strong>Diupload Oleh:</strong> {{ $galeri->user->name ?? 'Sistem/Tidak Diketahui' }}</p>
                                <p><strong>Tanggal Upload:</strong> {{ $galeri->created_at->translatedFormat('l, d F Y H:i:s') }}</p>
                                <p><strong>Terakhir Diperbarui:</strong> {{ $galeri->updated_at->translatedFormat('l, d F Y H:i:s') }}</p>
                                <hr>
                                <a href="{{ route('admin.galeri.edit', $galeri->id) }}" class="btn btn-warning btn-icon-split me-2">
                                    <span class="text">Edit</span>
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item galeri \'{{ $galeri->judul }}\'?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-icon-split">
                                        <span class="text">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer text-center py-3 bg-light mt-auto">
                <div class="container-fluid"><span class="text-muted">Hak Cipta © {{ date('Y') }} HIMATIF.</span></div>
            </footer>
        </div>
    </div>
    {{-- Script JS dasar admin --}}
    <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    @if(file_exists(public_path('admin/assets/js/sidebarmenu.js'))) <script src="{{ asset('admin/assets/js/sidebarmenu.js') }}"></script> @endif
    @if(file_exists(public_path('admin/assets/js/app.min.js'))) <script src="{{ asset('admin/assets/js/app.min.js') }}"></script> @endif
</body>
</html>
