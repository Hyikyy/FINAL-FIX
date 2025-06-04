@extends('layouts.app')

@section('title', 'Blog HIMATIF')
@section('description', 'Berita dan Artikel Terbaru dari HIMATIF')
@section('keywords', 'blog, berita, artikel, himatif')

@push('styles')
<style>
    /* CSS untuk card berita agar konten internalnya tertata baik */
    .blog-card .card-title {
        /* Batasi judul ke N baris jika diperlukan (opsional) */
        /* display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis; */
        /* min-height: X; // Jika ingin tinggi judul selalu sama */
    }

    .blog-card .card-text.description-text { /* Beri class spesifik untuk deskripsi */
        /* Batasi deskripsi ke N baris (opsional, bisa diatur agar JS yang handle tinggi) */
        /* display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis; */
        /* min-height: Y; // Jika ingin tinggi deskripsi selalu sama */
    }

    /* Pastikan gambar memiliki tinggi yang konsisten */
    .blog-card .card-img-top {
        height: 225px; /* Tinggi gambar tetap */
        object-fit: cover; /* Gambar mengisi area tanpa distorsi */
    }

    /* Untuk memastikan tombol "Read more" selalu di bawah */
    .blog-card .card-body {
        display: flex;
        flex-direction: column;
        flex-grow: 1; /* Agar card-body mengambil sisa ruang di card (jika card juga flex-column) */
    }
    .blog-card .card-body .description-text {
        flex-grow: 1; /* Agar deskripsi mengambil sisa ruang sebelum tombol */
    }
    .blog-card .card-body .mt-auto {
        /* mt-auto sudah ada di HTML, ini hanya konfirmasi */
    }
</style>
@endpush

@section('content')

<main role="main">
<br><br><br>
  <section class="jumbotron text-center py-5">
    <div class="container">
      <h1 class="jumbotron-heading fw-bold" style="color: black;">Berita HIMATIF</h1>
      <p class="lead" style="color: black;">
        Informasi terbaru mengenai kegiatan, prestasi, dan informasi penting lainnya dari Himpunan Mahasiswa Teknologi Informasi.
      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      {{-- Menggunakan row-cols-* untuk responsivitas kolom dan g-4 untuk gutter --}}
      {{-- justify-content-center untuk meratakan jika item ganjil di baris terakhir --}}
      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 justify-content-center">
        @forelse($beritas as $berita) {{-- Menggunakan forelse --}}
          {{-- Kolom dengan d-flex align-items-stretch agar card dalam SATU BARIS sama tinggi --}}
          {{-- JavaScript akan menyamakan tinggi SEMUA card --}}
          <div class="col d-flex align-items-stretch">
            {{-- Tambahkan class 'blog-card' untuk penargetan JS dan CSS spesifik jika perlu --}}
            {{-- h-100 dihapus agar JS yang mengatur tinggi absolut --}}
            <div class="card box-shadow d-flex flex-column blog-card"> {{-- d-flex flex-column pada card utama --}}
              @if($berita->gambar)
                <img class="card-img-top" src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ Str::limit($berita->judul, 50) }}">
              @else
                <img class="card-img-top" src="{{ asset('assets/img/news.jpg') }}" alt="Default Image">
              @endif

              <div class="card-body"> {{-- card-body sudah flex-column dari CSS --}}
                <h5 class="card-title fw-bold" style="color: black;">{{ Str::limit($berita->judul, 60) }}</h5>
                <small class="text-muted mb-2">
                  {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}  •  {{ \Carbon\Carbon::parse($berita->tanggal)->diffForHumans() }}
                </small>
                <p class="card-text description-text" style="color: black;">{{ Str::limit(strip_tags($berita->deskripsi), 100) }}</p>
                <div class="mt-auto">
                  <a href="{{ route('beritas.show', $berita->id) }}" class="btn btn-sm btn-outline-dark">Read more</a>
                </div>
              </div>
            </div>
          </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="lead text-muted">Tidak ada berita saat ini.</p>
            </div>
        @endforelse
      </div>

      @if ($beritas instanceof \Illuminate\Pagination\LengthAwarePaginator && $beritas->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $beritas->links() }}
        </div>
      @endif

    </div>
  </div>

</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    function equalizeCardHeights(selector) {
        const cards = document.querySelectorAll(selector);
        let maxHeight = 0;

        if (cards.length === 0) return;

        // Reset height to 'auto'
        cards.forEach(card => {
            card.style.height = 'auto';
        });

        // Find the max height
        cards.forEach(card => {
            if (card.offsetHeight > maxHeight) {
                maxHeight = card.offsetHeight;
            }
        });

        // Set all cards to the max height
        if (maxHeight > 0) {
            cards.forEach(card => {
                card.style.height = maxHeight + 'px';
            });
        }
    }

    // Panggil fungsi untuk card berita Anda
    // Menggunakan class .blog-card yang kita tambahkan pada elemen card
    equalizeCardHeights('.blog-card');

    // Panggil lagi saat ukuran window berubah (dengan debounce)
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            equalizeCardHeights('.blog-card');
        }, 250);
    });
});
</script>
@endpush
