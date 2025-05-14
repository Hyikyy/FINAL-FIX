@extends('layouts.app')

@section('title', 'Daftar Dosen & Asisten Dosen | Website Kami')
@section('description', 'Daftar lengkap dosen dan asisten dosen terbaik di website kami.')
@section('keywords', 'dosen, daftar dosen, pengajar, asisten dosen')

@section('content')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Daftar Dosen & Asisten Dosen</h2>
          <ol>
            <li><a href="{{ route('welcome') }}">Beranda</a></li>
            <li>Daftar Dosen & Asisten Dosen</li>
          </ol>
        </div>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Dosen Section ======= -->
    <section id="Dosen" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2 class="text-center">Dosen Pengajar Himatif</h2>
          <p class="text-center">Kenali dosen-dosen berdedikasi yang membimbing HIMATIF.</p>
        </div>

        <div class="row">
          @foreach($dosens as $dosen)
            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="member">
                @if($dosen->gambar)
                  <img src="{{ asset('storage/images/' . $dosen->gambar) }}" class="img-fluid" alt="{{ $dosen->nama }}">
                @else
                  <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid" alt="Default Image">
                @endif
                <h4><a href="{{ route('dosen.showPublic', $dosen->id) }}">{{ $dosen->nama }}</a></h4>
                <span>{{ $dosen->nama_jabatan }}</span>
                <p>{{ Str::limit($dosen->deskripsi_jabatan, 50) }}</p>
              </div>
            </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Dosen Section -->

     <!-- ======= Asisten Dosen Section ======= -->
    <section id="AsistenDosen" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2 class="text-center">Teaching Assistant</h2>
          <p class="text-center">Para asisten dosen yang membantu kelancaran kegiatan akademik.</p>
        </div>

        <div class="row">
          @foreach($teachingAssistants as $assistant)
            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="member">
                @if($assistant->gambar)
                  <img src="{{ asset('storage/teaching_assistants/' . $assistant->gambar) }}" class="img-fluid" alt="{{ $assistant->nama }}">
                @else
                  <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid" alt="Default Image">
                @endif
                <h4>{{ $assistant->nama }}</h4>
                <span>{{ $assistant->nama_jabatan }}</span>
                <p>{{ Str::limit($assistant->deskripsi_jabatan, 50) }}</p>
              </div>
            </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Asisten Dosen Section -->

    <!-- ======= Alumni Section ======= -->
    <section id="Alumni" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2 class="text-center">Alumni HIMATIF</h2>
          <p class="text-center">Alumni-alumni berprestasi dari HIMATIF.</p>
        </div>

        <div class="row">
          @foreach($alumnis as $alumni)
            <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="member">
                @if($alumni->gambar)
                  <img src="{{ asset('storage/' . $alumni->gambar) }}" class="img-fluid" alt="{{ $alumni->nama }}">
                @else
                  <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid" alt="Default Image">
                @endif
                <h4>{{ $alumni->nama }}</h4>
                <span>{{ $alumni->nama_cantik }}</span>
                <p>{{ Str::limit($alumni->deskripsi, 50) }}</p>
              </div>
            </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Alumni Section -->

  </main><!-- End #main -->

@endsection