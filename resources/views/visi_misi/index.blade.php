@extends('layouts.app')

@section('title', 'Visi dan Misi')
@section('description', 'Visi dan Misi HIMATIF')
@section('keywords', 'visi, misi, himatif')

@section('content')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Visi dan Misi</h2>
          <ol>
            <li><a href="{{ route('welcome') }}">Beranda</a></li>
            <li>Visi dan Misi</li>
          </ol>
        </div>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Visi Misi Section ======= -->
    <section id="visi-misi" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Visi dan Misi HIMATIF</h2>
          <p>Berikut adalah visi dan misi Himpunan Mahasiswa Teknologi Informasi. Visi kami adalah ..., dan misi kami adalah ...</p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Visi</h5>
                <p class="card-text">
                  @if(count($visiMisi) > 0)
                    {{ $visiMisi[0]->visi }}
                  @else
                    Belum ada visi yang ditetapkan.
                  @endif
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Misi</h5>
                <p class="card-text">
                  @if(count($visiMisi) > 0)
                      {{ $visiMisi[0]->misi }}
                  @else
                      Belum ada misi yang ditetapkan.
                  @endif
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Visi Misi Section -->

  </main><!-- End #main -->

@endsection