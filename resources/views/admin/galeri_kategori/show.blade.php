<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('admin.head')
    <title>Detail Kategori: {{ $kategoriGaleri->nama_kategori }} - Admin Panel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* ... (style Anda yang sudah ada tetap di sini) ... */
        .gallery-item-admin img {
            height: 120px; /* Sedikit lebih kecil agar muat lebih banyak atau sesuaikan */
            width: 100%; /* Membuat gambar responsif terhadap lebar kolom */
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            margin-bottom: 0.5rem;
        }
        .gallery-item-admin p {
            font-size: 0.85rem; /* Sedikit lebih kecil */
            margin-bottom: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.2; /* Untuk judul yang mungkin 2 baris */
            height: 2.4em; /* Batasi tinggi untuk maksimal 2 baris teks */
        }
        .gallery-item-admin {
            margin-bottom: 1rem; /* Jarak antar item galeri */
        }
    </style>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
      data-sidebar-position="fixed" data-header-position="fixed">

        @include('admin.sidebar')

        <div class="body-wrapper">
            @include('admin.header')

            <div class="container-fluid">
                {{-- Header Halaman Konten --}}
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Category Details : {{ $kategoriGaleri->nama_kategori }}</h1>
                    <div>

                        <a href="{{ route('admin.galeri-kategori.index') }}" class="btn btn-secondary btn-icon-split btn-sm shadow-sm">
                            <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                            <span class="text">Back</span>
                        </a>
                    </div>
                </div>

                {{-- Card untuk Detail Kategori --}}
                <div class="card shadow mb-4">
                    {{-- ... (bagian detail kategori tetap sama seperti sebelumnya) ... --}}
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Kategori</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3"><strong>Nama Kategori:</strong></div>
                            <div class="col-md-9">{{ $kategoriGaleri->nama_kategori }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3"><strong>Slug:</strong></div>
                            <div class="col-md-9">{{ $kategoriGaleri->slug }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3"><strong>Deskripsi:</strong></div>
                            <div class="col-md-9">
                                @if($kategoriGaleri->deskripsi)
                                    {!! nl2br(e($kategoriGaleri->deskripsi)) !!}
                                @else
                                    <span class="text-muted"><em>Tidak ada deskripsi.</em></span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3"><strong>Jumlah Item Galeri:</strong></div>
                            <div class="col-md-9">{{ $kategoriGaleri->galeris_count ?? $kategoriGaleri->galeris->count() }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3"><strong>Dibuat Pada:</strong></div>
                            <div class="col-md-9">{{ $kategoriGaleri->created_at->format('d F Y H:i') }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3"><strong>Diperbarui Pada:</strong></div>
                            <div class="col-md-9">{{ $kategoriGaleri->updated_at->format('d F Y H:i') }}</div>
                        </div>
                    </div>
                </div>

                {{-- Card untuk Daftar Item Galeri dalam Kategori Ini --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Item Galeri dalam Kategori "{{ $kategoriGaleri->nama_kategori }}"</h6>
                    </div>
                    <div class="card-body">
                        @if($kategoriGaleri->galeris && $kategoriGaleri->galeris->count() > 0)
                            <div class="row">
                                @foreach($kategoriGaleri->galeris as $index => $itemGaleri)
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <div class="gallery-item-admin text-center">
                                            {{-- AWAL BLOK DEBUGGING GAMBAR ITEM GALERI --}}
                                            <div style="font-size: 0.7rem; background-color: #eee; padding: 3px; margin-bottom: 2px; border: 1px dashed #ccc;">
                                                Item Index: {{ $index }}<br>
                                                ID Galeri: {{ $itemGaleri->id }}<br>
                                                Nilai path_gambar: "{{ $itemGaleri->path_gambar }}"<br>
                                                @if($itemGaleri->path_gambar)
                                                    URL Coba: {{ asset('storage/' . $itemGaleri->path_gambar) }}
                                                @endif
                                            </div>
                                            {{-- AKHIR BLOK DEBUGGING GAMBAR ITEM GALERI --}}

                                            @if($itemGaleri->path_gambar)
                                                <a href="{{ asset('storage/' . $itemGaleri->path_gambar) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Gambar: {{ $itemGaleri->judul }}">
                                                    <img src="{{ asset('storage/' . $itemGaleri->path_gambar) }}" class="img-fluid" alt="{{ $itemGaleri->judul ?? 'Gambar Galeri' }}">
                                                </a>
                                            @else
                                                <img src="{{ asset('assets_beck/img/no-image.png') }}" class="img-fluid" alt="No Image Available"> {{-- Pastikan path default image benar --}}
                                            @endif
                                            <p title="{{ $itemGaleri->judul ?? 'Tanpa Judul' }}">{{ Str::limit($itemGaleri->judul ?? 'Tanpa Judul', 25) }}</p>
                                            {{-- Link untuk edit item galeri individual (jika ada) --}}
                                            {{-- <a href="{{ route('admin.galeri.edit', $itemGaleri->id) }}" class="btn btn-sm btn-outline-secondary mt-1">Edit</a> --}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-muted"><em>Tidak ada item galeri yang termasuk dalam kategori ini.</em></p>
                            {{-- DEBUG: Jika relasi galeris ada tapi kosong --}}
                            @if(isset($kategoriGaleri->galeris))
                                <p class="text-center text-muted small">(DEBUG: Relasi 'galeris' ada tapi count() adalah 0)</p>
                            @else
                                <p class="text-center text-muted small">(DEBUG: Relasi 'galeris' tidak ter-load atau null)</p>
                            @endif
                        @endif
                    </div>
                </div>

            </div>

            {{-- ... (footer dan script tetap sama) ... --}}
            <footer class="footer text-center py-3 bg-light mt-auto">
                <div class="container-fluid">
                    <span class="text-muted">Hak Cipta © {{ date('Y') }} Kelompok 7 PA1. All rights reserved.</span>
                </div>
            </footer>
        </div>
  </div>

  <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  @if(file_exists(public_path('admin/assets/js/sidebarmenu.js')))
    <script src="{{ asset('admin/assets/js/sidebarmenu.js') }}"></script>
  @endif
  @if(file_exists(public_path('admin/assets/js/app.min.js')))
    <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
  @endif
  @if(file_exists(public_path('admin/assets/libs/simplebar/dist/simplebar.js')))
    <script src="{{ asset('admin/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  @endif
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  <script>
    // Inisialisasi tooltip Bootstrap jika digunakan
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>

</body>
</html>
