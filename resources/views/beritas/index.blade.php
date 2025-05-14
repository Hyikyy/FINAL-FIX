@extends('layouts.app')

@section('title', 'Blog HIMATIF')
@section('description', 'Berita dan Artikel Terbaru dari HIMATIF')
@section('keywords', 'blog, berita, artikel, himatif')

@section('content')

<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Berita HIMATIF</h1>
      <p class="lead text-muted">Informasi terbaru mengenai kegiatan, prestasi, dan informasi penting lainnya dari Himpunan Mahasiswa Teknologi Informasi.</p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        @foreach($beritas as $berita)
          <div class="col-md-4">
            <div class="card mb-4 box-shadow">
              {{-- Gambar --}}
              @if($berita->gambar)
                <img class="card-img-top" src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="height: 225px; object-fit: cover;">
              @else
                <img class="card-img-top" src="{{ asset('assets/img/news.jpg') }}" alt="Default Image" style="height: 225px; object-fit: cover;">
              @endif

              <div class="card-body">
                {{-- Judul --}}
                <h5 class="card-title">{{ $berita->judul }}</h5>

                {{-- Tanggal Upload --}}
                <small class="text-muted">
                  {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}  •  {{ \Carbon\Carbon::parse($berita->tanggal)->diffForHumans() }}
                </small>
                <hr>

                {{-- Deskripsi Singkat --}}
                <p class="card-text">{{ Str::limit($berita->deskripsi, 100) }}</p>

                {{-- Link Baca Selengkapnya --}}
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="{{ route('beritas.show', $berita->id) }}" class="btn btn-sm btn-outline-secondary">Baca Selengkapnya</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

</main>
@endsection