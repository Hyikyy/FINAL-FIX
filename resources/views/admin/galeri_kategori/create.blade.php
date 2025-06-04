<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.head') {{-- Meta tags, CSS utama admin --}}
    <title>Tambah Kategori Galeri Baru - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- Style dasar jika tidak ada layout --}}
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
    </style>
</head>
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        @include('admin.sidebar')
        <div class="body-wrapper">
            @include('admin.header')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Create Gallery Category </h1>
                    <a href="{{ route('admin.galeri-kategori.index') }}" class="btn btn-secondary btn-icon-split btn-sm shadow-sm">
                        <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                        <span class="text">Back to List</span>
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops! Ada beberapa masalah dengan input Anda:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Formulir Kategori Galeri</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.galeri-kategori.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}" required autofocus>
                                @error('nama_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug (Opsional)</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Contoh: welpart-2024 (akan dibuat otomatis jika kosong)">
                                <small class="form-text text-muted">Jika dikosongkan, slug akan dibuat otomatis dari nama kategori. Gunakan huruf kecil, angka, dan tanda hubung (-).</small>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <a href="{{ route('admin.galeri-kategori.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
            <footer class="footer text-center py-3 bg-light mt-auto">
                <div class="container-fluid"><span class="text-muted">Hak Cipta © {{ date('Y') }} Kelompok 7 PA1.</span></div>
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
