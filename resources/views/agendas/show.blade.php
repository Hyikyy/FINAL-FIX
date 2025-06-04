@extends('layouts.app')

@section('title', $agenda->nama_kegiatan)
@section('description', $agenda->deskripsi)
@section('keywords', 'agenda, kegiatan, himatif')

@section('content')

  <main id="main">

    <!-- ======= Agenda Details Section ======= -->
    <section id="agenda-details" class="agenda-details" style="margin-top: 70px; margin-bottom: 10px;">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-8">
            <div class="card shadow-lg" style="border: 1px solid black;">
              <div class="card-body p-4">
                <h5 class="card-title fw-bold mb-3">{{ $agenda->nama_kegiatan }}</h5>
                <p class="card-text" style="color:#000000">
                  <strong class="fw-bold" >Tanggal:</strong> {{ \Carbon\Carbon::parse($agenda->tanggal_kegiatan)->isoFormat('dddd, D MMMM YYYY') }}
                </p>
                <p class="card-text" style="color:#000000">
                  <strong class="fw-bold">Deskripsi:</strong> {{ $agenda->deskripsi }}
                </p>
              </div>
              <div class="card-footer bg-white border-top-0 p-4">  <!-- Footer putih tanpa border -->
                <a href="{{ route('agendas.index') }}" class="btn btn-secondary">Kembali ke Daftar Agenda</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar">
              <h3 class="sidebar-title fw-bold" style="color: black;">Agenda Lainnya</h3>
              <div class="sidebar-item recent-posts">
                <div class="mt-3">
                  @foreach(\App\Models\Agenda::orderBy('tanggal_kegiatan', 'asc')->take(5)->get() as $recentAgenda)
                  <div class="post-item mt-3">
                    <div>
                      <h4><a href="{{ route('agendas.public', $recentAgenda->id) }}">{{ $recentAgenda->nama_kegiatan }}</a></h4>
                      <time datetime="{{ $recentAgenda->tanggal_kegiatan }}">{{ \Carbon\Carbon::parse($recentAgenda->tanggal_kegiatan)->format('d F Y') }}</time>
                    </div>
                  </div><!-- End recent post item-->
                  @endforeach
                </div>
              </div><!-- End sidebar recent posts-->
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Agenda Details Section -->

  </main><!-- End #main -->
@endsection
