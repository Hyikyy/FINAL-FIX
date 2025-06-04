@extends('layouts.app')

@section('title', isset($judulHalaman) ? $judulHalaman : 'Galeri HIMATIF')
@section('description', 'Galeri Portfolio HIMATIF: Abadikan momen-momen seru dan inspiratif dari kegiatan kami.')
@section('keywords', 'galeri, portfolio, foto, himatif, kegiatan, informatika' . (isset($selectedKategori) ? ', ' . $selectedKategori->nama_kategori : ''))

@section('content')

<main id="main">

    <!-- ======= Galeri Section (Portfolio Style) ======= -->
    <section id="portfolio" class="portfolio section-bg py-5" style="margin-top: 70px; margin-bottom: 10px;">
      <div class="container" data-aos="fade-up">

        <div class="section-title text-center mb-4" style="margin-top: 70px; margin-bottom: 10px;">
          {{-- Hapus span .title-underline-wrapper jika hanya untuk garis bawah, karena garis bawah dipindah --}}
          <h2 class="fw-bold" style="color: #000000;">Jejak Digital HIMATIF</h2>
           @if(isset($selectedKategori))
            <p style="color: #000000;">Menampilkan Galeri dari Kategori: <strong>{{ $selectedKategori->nama_kategori }}</strong></p>
          @else
            <p style="color: #000000;">Telusuri berbagai momen berharga yang telah kami ukir dalam setiap langkah.</p>
          @endif
        </div>

        {{-- AWAL NAVIGASI FILTER KATEGORI --}}
        @if(isset($kategoriGaleris) && $kategoriGaleris instanceof \Illuminate\Support\Collection && $kategoriGaleris->count() > 0)
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center mb-4">
                    <ul id="portfolio-flters">
                        <li> {{-- Hapus class filter-active dari LI --}}
                            <a href="{{ route('galeri.index') }}" class="{{ !isset($selectedKategori) ? 'filter-active' : '' }}">All</a> {{-- Pindahkan class filter-active ke A --}}
                        </li>
                        @foreach($kategoriGaleris as $kategori)
                            <li> {{-- Hapus class filter-active dari LI --}}
                                <a href="{{ route('galeri.byCategory', $kategori->slug) }}" class="{{ (isset($selectedKategori) && $selectedKategori && $selectedKategori->slug == $kategori->slug) ? 'filter-active' : '' }}"> {{-- Pindahkan class filter-active ke A --}}
                                    {{ $kategori->nama_kategori }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12 text-center">
                    <p style="color:orange; font-weight:bold; border:1px solid orange;">Kondisi IF untuk filter GAGAL. Tidak ada kategori atau count 0.</p>
                </div>
            </div>
        @endif
        {{-- AKHIR NAVIGASI FILTER KATEGORI --}}

        <div class="row gy-4 portfolio-container justify-content-center" data-aos="fade-up" data-aos-delay="200">
          @forelse($galeris as $galeri)
            <div class="col-lg-4 col-md-6 portfolio-item">
              <div class="portfolio-wrap d-flex flex-column rounded overflow-hidden shadow-sm bg-white">
                  <a href="{{ asset('storage/' . $galeri->gambar) }}"
                     data-gallery="portfolioGallery"
                     class="glightbox portfolio-image-container d-block"
                     title="{{ $galeri->judul }}@if($galeri->kategoriGaleri) - Kategori: {{ $galeri->kategoriGaleri->nama_kategori }}@endif @if($galeri->deskripsi)<br>{{ Str::limit($galeri->deskripsi, 150) }}@endif">
                      @if($galeri->gambar)
                        <img src="{{ asset('storage/' . $galeri->gambar) }}" class="img-fluid" alt="{{ $galeri->judul }}">
                      @else
                        <img src="{{ asset('assets_beck/img/no-image.png') }}" class="img-fluid" alt="Default Image">
                      @endif
                  </a>
                  <div class="portfolio-info p-3 text-center">
                       <h4 class="portfolio-title h6 mb-1">
                           <a href="#" class="text-decoration-none" style="color: #000000 !important; font-weight: bold;">{{ Str::limit($galeri->judul, 35) }}</a>
                       </h4>
                       @if($galeri->kategoriGaleri)
                       <p class="portfolio-category small mb-0" style="color: #000000 !important;">{{ $galeri->kategoriGaleri->nama_kategori }}</p>
                       @endif
                  </div>
              </div>
            </div><!-- End Portfolio Item -->
          @empty
            <div class="col-12">
                <p class="text-center fst-italic py-5" style="color: #000000;">
                    Tidak ada foto di galeri
                    @if(isset($selectedKategori))
                        untuk kategori <strong>"{{ $selectedKategori->nama_kategori }}"</strong>
                    @endif.
                </p>
            </div>
          @endforelse
        </div>

        @if($galeris->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $galeris->appends(request()->query())->links() }}
        </div>
        @endif

      </div>
    </section><!-- End Portfolio Section -->

</main><!-- End #main -->
@endsection

@push('scripts')
<script src="{{ asset('assets_beck/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script>
  const lightbox = GLightbox({
    selector: '.glightbox'
  });
</script>
@endpush

@push('styles')
<link href="{{ asset('assets_beck/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet"> {{-- Pastikan ini di-uncomment jika dibutuhkan --}}
<style>
    /* Variabel Warna */
    :root {
        --filter-gallery-text-default: #444444;
        --filter-gallery-text-hover: #008374;   /* Biru untuk hover filter (contoh, bisa disesuaikan) */
        --filter-gallery-active-color: #008374; /* Hijau toska untuk aktif (teks & garis) */
        /* --section-title-underline-color: #008374;  DIHAPUS karena garis pindah */
    }

    /* Styling untuk Section Title (Judul "Jejak Digital HIMATIF") */
    .section-title {
        margin-bottom: 10px !important;
        text-align: center !important;
    }
    .section-title h2 {
        font-size: 2.2rem !important;
        font-weight: 700 !important;
        margin-bottom: 10px !important;
        padding-bottom: 0 !important; /* Hapus padding-bottom jika tidak ada garis lagi */
        color: #000000 !important;
        line-height: 1.2;
        display: inline-block !important;
        position: relative !important;
    }

    .section-title h2::after {
        display: none !important; /* Ini akan menyembunyikan garis bawah */
    }
    /* HAPUS CSS untuk garis bawah pada judul section */
    /* .section-title h2 .title-underline-wrapper { ... } */
    /* .section-title h2 .title-underline-wrapper::after { ... } */
    /* Jika sebelumnya ada .section-title h2::after, hapus juga */

    .section-title p {
        margin-top: 0px !important;
        margin-bottom: 0 !important;
        color: #000000 !important;
        font-size: 1rem;
    }
    .section-bg {
        background-color: #ffffff !important; /* Atau #f8f9fa jika ingin bg abu-abu muda */
    }

    /* --- CSS UNTUK FILTER KATEGORI GALERI (GAYA TEKS DENGAN GARIS BAWAH AKTIF) --- */
    #portfolio-flters {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 auto 5px auto !important;
        text-align: center !important;
    }

    #portfolio-flters li {
        cursor: pointer !important;
        display: inline-block !important;
        margin: 0 10px !important; /* Jarak antar item filter */
    }

    #portfolio-flters li a {
        display: inline-block !important;
        padding: 8px 5px !important; /* Padding vertikal, dan sedikit horizontal jika diinginkan agar garis tidak terlalu mepet */
        text-decoration: none !important;
        font-weight: 600 !important;
        font-size: 1rem !important;
        color: var(--filter-gallery-text-default) !important;
        background-color: transparent !important;
        border: none !important;
        border-radius: 0 !important;
        transition: color 0.25s ease !important;
        position: relative !important; /* Untuk garis bawah pada item aktif */
    }

    #portfolio-flters li a:hover {
        color: var(--filter-gallery-text-hover) !important;
    }

    /* Gaya untuk link filter yang aktif */
    #portfolio-flters li a.filter-active {
        color: var(--filter-gallery-active-color) !important; /* Warna teks sesuai warna aktif */
        font-weight: 700 !important;
    }

    /* Garis bawah untuk item filter aktif */
    #portfolio-flters li a.filter-active::after {
        content: "" !important;
        position: absolute !important;
        display: block !important;
        width: 100% !important; /* Garis selebar konten <a> */
        height: 3px !important;  /* Ketebalan garis bawah */
        background: var(--filter-gallery-active-color) !important; /* Warna garis bawah sesuai warna aktif */
        bottom: -2px !important; /* Posisi tepat di bawah teks (sesuaikan jika padding atas/bawah a berbeda) */
        left: 0 !important;
    }
    /* --- AKHIR CSS UNTUK FILTER --- */


    /* Style untuk card galeri (pastikan ini sudah ada dan sesuai) */
    .portfolio-wrap {
        transition: 0.3s;
        position: relative;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.07);
        overflow: hidden;
        height: 100%; /* Tambahkan ini jika ingin semua card sama tinggi */
    }
    .portfolio-image-container {
        display: block;
        width: 100%;
        aspect-ratio: 4 / 3;
        overflow: hidden;
    }
    .portfolio-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.35s ease-in-out;
    }
    .portfolio-wrap:hover .portfolio-image-container img {
        transform: scale(1.08);
    }
    .portfolio-info {
        padding: 15px;
        text-align: center;
        background-color: #ffffff;
    }
    .portfolio-title a,
    .portfolio-category {
        color: #000000 !important;
    }
    .portfolio-title a {
        font-weight: bold;
    }
</style>
@endpush
