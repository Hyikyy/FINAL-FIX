@extends('layouts.app')

@section('title', 'Beranda')
@section('description', 'Halaman Beranda Website HIMATIF')
@section('keywords', 'beranda, himatif, website')

@section('content')

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2 class="text text-dark">Selamat Datang di <span>HIMATIF</span></h2>
          <p>HIMATIF merupakan bagian dari organisasi kampus yang menjalankan peran serta tanggung jawabnya, dengan maksud untuk menggali, mengoptimalkan, dan
            mengembangkan sumber daya mahasiswa yang tersedia. Ini bertujuan agar mereka dapat memenuhi peran dan fungsinya sebagai mahasiswa.</p>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#about" class="btn-get-started">Mulai</a>
            <a href="https://www.youtube.com/watch?v=L8zotgIl4VY" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Tonton Video</span></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="{{ asset('assets/img/himatif/himatif.jpg') }}" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div>
      </div>
    </div>
   
    <br><br><br>

    </div>
  </section>
  <!-- End Hero Section -->

  <main id="main">

  <!-- ======= Visi Misi Section ======= -->
  <section id="visi-misi" class="py-5">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2 class="text-center">Visi dan Misi HIMATIF</h2>
        <p class="text-center">Arahan strategis yang memandu setiap langkah dan tindakan kami.</p>
      </div>

      <div class="row">
        <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-eye me-2"></i> Visi</h5>
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

        <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-list-check me-2"></i> Misi</h5>
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

   <!-- ======= Agenda Calendar Section ======= -->
   <section id="agenda-calendar" class="py-5 bg-light">
    <div class="container">
      <div class="text-center mb-4">
        <h2>Agenda Kegiatan</h2>
        <p class="text-muted">Ikuti perkembangan kegiatan HIMATIF melalui kalender agenda kami.</p>
      </div>

      <div class="row">
        <!-- Kolom Kiri: Daftar Agenda -->
        <div class="col-md-8">
          <div class="bg-white p-3 rounded shadow-sm mb-4">
            <h3 class="text-primary mb-3">Agenda Terdekat</h3>
            @if($agendasTerdekat->count() > 0)
            <div class="list-group" style="max-height: 300px; overflow-y: auto;">
              @foreach($agendasTerdekat as $agenda)
              <a href="{{ route('agendas.public', $agenda->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1 text-info">{{ $agenda->nama_kegiatan }}</h5>
                  <small class="text-muted">
                    {{ \Carbon\Carbon::parse($agenda->tanggal_kegiatan)->isoFormat('dddd, D MMMM YYYY') }}
                  </small>
                </div>
                <p class="mb-1 text-truncate">{{ Str::limit($agenda->deskripsi, 100) }}</p>
              </a>
              @endforeach
            </div>
            @else
            <p class="text-muted">Tidak ada agenda terdekat saat ini.</p>
            @endif
          </div>

          <div class="bg-white p-3 rounded shadow-sm">
            <h3 class="text-success mb-3">Agenda Rutin Bulan Ini</h3>
            @if($agendasRutin->count() > 0)
            <div class="list-group" style="max-height: 200px; overflow-y: auto;">
              @foreach($agendasRutin as $agenda)
              <a href="{{ route('agendas.public', $agenda->id) }}" class="list-group-item list-group-item-action">
                {{ $agenda->nama_kegiatan }} -
                {{ \Carbon\Carbon::parse($agenda->tanggal_kegiatan)->isoFormat('dddd, D MMMM YYYY') }}
              </a>
              @endforeach
            </div>
            @else
            <p class="text-muted">Tidak ada agenda rutin bulan ini.</p>
            @endif
          </div>
        </div>

        <!-- Kolom Kanan: Kalender Bulanan -->
        <div class="col-md-4">
          <div class="bg-white p-3 rounded shadow-sm">
            @php
            $currentDate = \Carbon\Carbon::now();
            $year = $currentDate->year;
            $month = $currentDate->month;

            $date = \Carbon\Carbon::createFromDate($year, $month, 1);
            $firstDayOfMonth = $date->copy()->startOfMonth();
            $lastDayOfMonth = $date->copy()->endOfMonth();
            $startDayOfWeek = $firstDayOfMonth->dayOfWeekIso;

            // Kumpulkan tanggal agenda di bulan ini untuk penandaan
            $eventDatesThisMonth = \App\Models\Agenda::whereYear('tanggal_kegiatan', $year)
            ->whereMonth('tanggal_kegiatan', $month)
            ->pluck('tanggal_kegiatan')
            ->map(function($dateStr) {
              return \Carbon\Carbon::parse($dateStr)->day;
            })->unique()->toArray();
            @endphp

            <h4 class="text-center text-info">{{ $date->isoFormat('MMMM YYYY') }}</h4>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Sn</th>
                  <th>Sl</th>
                  <th>Rb</th>
                  <th>Km</th>
                  <th>Jm</th>
                  <th class="text-danger">Sb</th>
                  <th class="text-danger">Mg</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @for ($i = 1; $i < $startDayOfWeek; $i++)
                    <td></td>
                    @endfor

                    @for ($day = 1; $day <= $lastDayOfMonth->day; $day++)
                      @php
                      $currentDayDate = \Carbon\Carbon::createFromDate($year, $month, $day);
                      $isWeekend = $currentDayDate->isWeekend();
                      $hasEvent = in_array($day, $eventDatesThisMonth);
                      $isToday = $currentDayDate->isToday();

                      $dayClass = '';
                      if ($isWeekend) $dayClass .= 'text-danger ';
                      if ($hasEvent) $dayClass .= 'bg-info text-white ';
                      if ($isToday) $dayClass .= 'table-primary font-weight-bold';

                      @endphp
                      <td class="{{ trim($dayClass) }}">
                        {{ $day }}
                      </td>

                      @if (($startDayOfWeek + $day - 1) % 7 == 0)
                </tr>
                <tr>
                  @endif
                  @endfor

                  @if (($startDayOfWeek + $lastDayOfMonth->day - 1) % 7 != 0)
                    @for ($i = ($startDayOfWeek + $lastDayOfMonth->day - 1) % 7 + 1; $i <= 7; $i++)
                      <td></td>
                      @endfor
                      @endif
                </tr>
              </tbody>
            </table>

            <div class="text-center">
              <a href="{{ route('agendas.index') }}" class="btn btn-primary">Lihat Semua Agenda</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Agenda Calendar Section -->

  <!-- ======= Recent Blog Posts Section ======= -->
  <section id="recent-posts" class="recent-posts sections-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>Berita Terbaru</h2>
        <p>Informasi terkini seputar kegiatan, prestasi, dan inovasi dari HIMATIF.</p>
      </div>

      <div class="row gy-4">
        @foreach($beritasTerbaru as $berita)
        <div class="col-xl-4 col-md-6">
          <article>

            <div class="post-img">
              <a href="{{ route('beritas.public', $berita->id) }}">
                @if($berita->gambar)
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="img-fluid" style="width: 100%; object-fit: cover; height: 220px;">
                @else
                <img src="{{ asset('assets/img/news.jpg') }}" alt="Default Image" class="img-fluid" style="width: 100%; object-fit: cover; height: 220px;">
                @endif
              </a>
            </div>

            <p class="post-category">{{ \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') }}</p>

            <h2 class="title">
              <a href="{{ route('beritas.public', $berita->id) }}">{{ $berita->judul }}</a>
            </h2>

            <p class="description">
              {{ Str::limit($berita->deskripsi, 120) }}
            </p>

            <div class="d-flex align-items-center mt-3">
              <div class="post-author d-flex align-items-center">
                <i class="bi bi-person"></i>
                <div>
                  <span>HIMATIF</span>
                </div>
              </div>
              <div class="post-date">
                <i class="bi bi-clock"></i>
                <time datetime="{{ $berita->tanggal }}">{{ \Carbon\Carbon::parse($berita->tanggal)->diffForHumans() }}</time>
              </div>
            </div>

          </article>
        </div><!-- End post list item -->
        @endforeach

      </div>
      <div class="text-center mt-4">
        <a href="{{ route('beritas.public') }}" class="btn btn-primary">Lihat Semua Berita</a>
      </div>

    </div>
  </section><!-- End Recent Blog Posts Section -->

</main><!-- End #main -->

@endsection