@extends('layouts.app')

@section('title', 'Apa Kata Alumni | Website Kami')
@section('description', 'Testimoni dan pesan dari alumni-alumni terbaik kami.')
@section('keywords', 'alumni, testimoni, apa kata alumni, pesan alumni')

@section('content')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Apa Kata Alumni</h2>
          <ol>
            <li><a href="{{ route('welcome') }}">Beranda</a></li>
            <li>Apa Kata Alumni</li>
          </ol>
        </div>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Apa Kata Alumni Section ======= -->
    <section id="ApaKataAlumni" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2 class="text-center">Pesan dan Testimoni Alumni</h2>
          <p class="text-center">Inspirasi dari alumni-alumni hebat kami.</p>
        </div>

        <div class="row">
          @foreach($apaKataAlumni as $alumni)
            <div class="col-xl-4 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="100">
              <div class="member">
                @if($alumni->gambar)
                  <img src="{{ asset('storage/' . $alumni->gambar) }}" class="img-fluid" alt="{{ $alumni->nama }}">
                @else
                  <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid" alt="Default Image">
                @endif
                <h4>{{ $alumni->nama }}</h4>
                <span>Angkatan: {{ $alumni->angkatan }}</span>
                <p>{{ Str::limit($alumni->isi, 150) }}</p>
              </div>
            </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Apa Kata Alumni Section -->

  </main><!-- End #main -->

@endsection