@extends('layouts.app')

@section('title', '📸 Jelajahi Indahnya Dunia Informatika | Galeri HIMATIF')
@section('description', 'Galeri Foto HIMATIF: Abadikan momen-momen seru dan inspiratif dari kegiatan kami.')
@section('keywords', 'galeri, foto, himatif, kegiatan, informatika')

@section('content')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Galeri</h2>
          <ol>
            <li><a href="{{ route('welcome') }}">Beranda</a></li>
            <li>Galeri</li>
          </ol>
        </div>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Galeri Section ======= -->
    <section id="galeri" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2 class="text-center">Jejak Digital HIMATIF: Galeri Kegiatan Kami</h2>
          <p class="text-center">Telusuri berbagai momen berharga yang telah kami ukir dalam setiap langkah.</p>
        </div>

        <div class="row gy-4">

          @foreach($galeris as $galeri)
            <div class="col-xl-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="member">
                @if($galeri->gambar)
                  <img src="{{ asset('storage/' . $galeri->gambar) }}" class="img-fluid" alt="{{ $galeri->judul }}">
                @else
                  <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid" alt="Default Image">
                @endif
                <h4>{{ $galeri->judul }}</h4>
              </div>
            </div><!-- End Galeri Item -->
          @endforeach

        </div>

      </div>
    </section><!-- End Galeri Section -->

  </main><!-- End #main -->

@endsection