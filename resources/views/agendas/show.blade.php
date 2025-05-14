@extends('layouts.app')

@section('title', $agenda->nama_kegiatan)
@section('description', $agenda->deskripsi)
@section('keywords', 'agenda, kegiatan, himatif')

@section('content')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>{{ $agenda->nama_kegiatan }}</h2>
          <ol>
            <li><a href="{{ route('welcome') }}">Beranda</a></li>
            <li><a href="{{ route('agendas.index') }}">Agenda</a></li>
            <li>{{ $agenda->nama_kegiatan }}</li>
          </ol>
        </div>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Agenda Details Section ======= -->
    <section id="agenda-details" class="agenda-details">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{ $agenda->nama_kegiatan }}</h5>
                <p class="card-text">
                  <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($agenda->tanggal_kegiatan)->isoFormat('dddd, D MMMM YYYY') }}
                </p>
                <p class="card-text">
                  <strong>Waktu:</strong> {{ $agenda->waktu_kegiatan }}
                </p>
                <p class="card-text">
                  <strong>Lokasi:</strong> {{ $agenda->lokasi_kegiatan }}
                </p>
                <p class="card-text">{{ $agenda->deskripsi }}</p>
              </div>
              <div class="card-footer">
                <a href="{{ route('agendas.index') }}" class="btn btn-secondary">Kembali ke Daftar Agenda</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar">
              <h3 class="sidebar-title">Agenda Lainnya</h3>
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