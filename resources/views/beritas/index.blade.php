@extends('layouts.app')

@section('title', 'Blog HIMATIF')
@section('description', 'Berita dan Artikel Terbaru dari HIMATIF')
@section('keywords', 'blog, berita, artikel, himatif')

@push('styles')
<style>
    .blog-card .card-title {
    }

    .blog-card .card-text.description-text {
    }

    .blog-card .card-img-top {
        height: 225px;
        object-fit: cover;
    }

    .blog-card .card-body {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .blog-card .card-body .description-text {
        flex-grow: 1;
    }
    .blog-card .card-body .mt-auto {
    }

    .category-filter {
        margin-bottom: 20px;
        text-align: left;
        background-color: #f8f9fa;
        padding: 10px;
    }

    .category-filter .btn {
        margin: 0 5px;
        border: none;
        text-decoration: none;
        outline: none;
        padding: 8px 16px;
        border-radius: 20px;
        background-color: #e9ecef;
        color: #495057;
        transition: all 0.2s ease-in-out;
    }

    .category-filter .btn:hover {
        background-color: #dee2e6;
    }

    .category-filter .btn.active {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
    }

    .blog-card .card-body .mt-auto .btn {
        border-radius: 20px;
    }

    .berita-category {
        display: inline-block;
        padding: 4px 8px;
        border: 1px solid #ced4da;
        border-radius: 12px;
        color: #495057;
        font-size: 0.75rem;
        margin-bottom: 5px;
        font-weight: bold;
        max-width: fit-content;
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

  <div class="category-filter container">
      <a href="{{ route('beritas.public') }}" class="btn {{ request('category') ? '' : 'active' }}">Semua</a>
      @foreach($categories as $category)
          <a href="{{ route('beritas.public', ['category' => $category->id]) }}" class="btn {{ request('category') == $category->id ? 'active' : '' }}">{{ $category->nama }}</a>
      @endforeach
  </div>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 justify-content-center">
        @forelse($beritas as $berita)
          <div class="col d-flex align-items-stretch">
            <div class="card box-shadow d-flex flex-column blog-card">
              @if($berita->gambar)
                <img class="card-img-top" src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ Str::limit($berita->judul, 50) }}">
              @else
                <img class="card-img-top" src="{{ asset('assets/img/news.jpg') }}" alt="Default Image">
              @endif

              <div class="card-body">
                <h5 class="card-title fw-bold" style="color: black;">{{ Str::limit($berita->judul, 60) }}</h5>
                <div class="berita-category">
                    {{ $berita->category->nama ?? 'Tidak Ada Kategori' }}
                </div>
                <small class="text-muted mb-2">
                    • {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}  •  {{ \Carbon\Carbon::parse($berita->tanggal)->diffForHumans() }}
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

        cards.forEach(card => {
            card.style.height = 'auto';
        });

        cards.forEach(card => {
            if (card.offsetHeight > maxHeight) {
                maxHeight = card.offsetHeight;
            }
        });

        if (maxHeight > 0) {
            cards.forEach(card => {
                card.style.height = maxHeight + 'px';
            });
        }
    }

    equalizeCardHeights('.blog-card');

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