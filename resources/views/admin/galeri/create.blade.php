<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.head')
    <title>Tambah Item Galeri Baru - Admin Panel</title>
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
        .img-preview-container { margin-top: 10px; }
        .img-preview { max-width: 200px; max-height: 200px; border: 1px solid #ddd; padding: 5px; }
    </style>
</head>
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        @include('admin.sidebar')
        <div class="body-wrapper">
            @include('admin.header')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Tambah Item Galeri Baru</h1>
                     <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary btn-icon-split btn-sm shadow-sm">
                        <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                        <span class="text">Kembali ke Daftar Galeri</span>
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
                        <h6 class="m-0 font-weight-bold text-primary">Formulir Item Galeri</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Foto/Video <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required autofocus>
                                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kategori_galeri_id" class="form-label">Kategori Kegiatan <span class="text-danger">*</span></label>
                                <select class="form-select @error('kategori_galeri_id') is-invalid @enderror" id="kategori_galeri_id" name="kategori_galeri_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori) {{-- Variabel $kategoris dikirim dari GaleriController@create --}}
                                        <option value="{{ $kategori->id }}" {{ old('kategori_galeri_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_galeri_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gambar" class="form-label">Upload Gambar <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" required onchange="previewImage(event)">
                                <small class="form-text text-muted">Format: JPG, JPEG, PNG, GIF, WEBP. Maks: 2MB.</small>
                                @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div class="img-preview-container mt-2">
                                    <img id="imgPreview" src="#" alt="Preview Gambar" class="img-preview" style="display:none;"/>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi_gambar" class="form-label">Deskripsi Gambar (Opsional)</label>
                                <textarea class="form-control @error('deskripsi_gambar') is-invalid @enderror" id="deskripsi_gambar" name="deskripsi_gambar" rows="4">{{ old('deskripsi_gambar') }}</textarea>
                                @error('deskripsi_gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Item Galeri
                            </button>
                            <a href="{{ route('admin.galeri.index') }}" class="btn btn-light">Batal</a>
                        </form>
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
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('imgPreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
