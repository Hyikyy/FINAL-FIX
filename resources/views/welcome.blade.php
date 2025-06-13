@extends('layouts.app')

@section('title', 'Home')
@section('description', 'Halaman Beranda Website HIMATIF')
@section('keywords', 'beranda, himatif, website')

@section('content')

<style>
    .table-bordered {
        border: 2px solid black !important; /* !important untuk menimpa style Bootstrap */
    }

    .table-bordered th,
    .table-bordered td {
        border: 2px solid black !important;
    }

    /* Style untuk gambar lingkaran */
    .rounded-image {
        border-radius: 50%; /* Membuat gambar menjadi lingkaran */
        object-fit: cover; /* Memastikan gambar memenuhi lingkaran */
        width: 100%; /* Lebar 100% dari container */
        height: 100%; /* Tinggi 100% dari container */
        max-width: 400px; /* Batasi lebar maksimum */
        max-height: 400px; /* Batasi tinggi maksimum */
    }

    /* Style untuk container gambar */
    .image-container {
        display: flex;
        justify-content: center; /* Tengahkan gambar horizontal */
        align-items: center; /* Tengahkan gambar vertikal */
        overflow: hidden; /* Sembunyikan bagian gambar yang keluar dari lingkaran */
        width: 100%; /* Lebar 100% dari container */
        height: 100%; /* Tinggi 100% dari container */
        max-width: 400px; /* Batasi lebar maksimum */
        max-height: 400px; /* Batasi tinggi maksimum */
        margin: 0 auto; /* Tengahkan container */
    }


    /* CSS untuk Berita Terbaru */
    .recent-posts article {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        overflow: hidden;
        /* h-100 dan d-flex flex-column sudah ada di class HTML, INI PENTING */
        /* Kita akan mengandalkan konten di dalamnya untuk menentukan tinggi "alami"
           sebelum align-items-stretch bekerja pada kolomnya. */
    }

    .recent-posts .post-img {
        max-height: 220px; /* Tinggi gambar tetap */
        margin: -20px -20px 15px -20px; /* Tarik gambar ke tepi padding card */
        overflow: hidden;
    }

    .recent-posts .post-img img {
        width: 100%;
        height: 220px; /* Pastikan konsisten dengan max-height di atas */
        object-fit: cover;
        transition: 0.3s;
    }

    .recent-posts article:hover .post-img img {
        transform: scale(1.05);
    }

    .recent-posts .post-category {
        font-size: 0.875rem; /* 14px */
        color: #777777;
        margin-bottom: 10px;
    }

    .recent-posts .title {
        font-size: 1.25rem; /* 20px */
        font-weight: 700;
        margin-bottom: 10px;
        line-height: 1.3; /* Sesuaikan untuk perhitungan min-height */
        color: #222222;
        /* Batasi judul ke 2 baris */
        display: -webkit-box;
        -webkit-line-clamp: 2; /* MAKSIMAL 2 BARIS */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        /* PAKSA tinggi untuk 2 baris, bahkan jika teksnya 1 baris */
        min-height: calc(1.25rem * 1.3 * 2); /* font-size * line-height * jumlah_baris */
    }

    .recent-posts .title a {
        color: inherit;
        transition: 0.3s;
        text-decoration: none;
    }

    .recent-posts .title a:hover {
        color: #007bff;
    }

    .recent-posts .description {
        font-size: 0.9375rem; /* 15px */
        color: #555555;
        line-height: 1.6;
        margin-bottom: 15px;
        /* Batasi deskripsi ke N baris */
        display: -webkit-box;
        -webkit-line-clamp: 3; /* MAKSIMAL 3 BARIS UNTUK DESKRIPSI, SESUAIKAN! */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        /* PAKSA tinggi untuk N baris, bahkan jika teksnya lebih pendek */
        min-height: calc(0.9375rem * 1.6 * 3); /* font-size * line-height * jumlah_baris */
    }

    .recent-posts .post-author-meta {
        font-size: 0.875rem;
        color: #777777;
        margin-top: auto; /* Ini mendorong ke bawah di dalam .post-content */
    }

    .recent-posts .post-author-meta .post-author,
    .recent-posts .post-author-meta .post-date {
        display: flex;
        align-items: center;
    }
    .recent-posts .post-author-meta .post-author {
        margin-right: 15px;
    }

    .recent-posts .post-author-meta i {
        margin-right: 6px;
        font-size: 1.1em;
        color: #008374;
    }

    #recent-posts .row > [class*="col-"] {
    /* Pastikan kolom tidak menyusut secara tidak semestinya.
       Bootstrap sudah mengatur flex-shrink: 0, jadi ini hanya penegasan. */
    flex-shrink: 0 !important;
    }

    #recent-posts .row > [class*="col-"] > article {
    /* Paksa artikel untuk mengisi 100% lebar kolomnya.
       Ini seharusnya sudah menjadi perilaku default untuk elemen block. */
    width: 100% !important;
    max-width: none !important; /* Hapus batasan max-width jika ada */
    /* Untuk memastikan padding tidak mengurangi lebar efektif konten jika box-sizing salah,
       tapi ini seharusnya sudah ditangani oleh Bootstrap. */
    box-sizing: border-box !important;
    }


</style>

<br><br>
<!-- ======= Hero Section ======= -->
<section id="home" class="home" style="background-color: #414544">
    <div class="container position-relative">
        <div class="row gy-5" data-aos="fade-in">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                <h2 class="text">Selamat Datang di <span>HIMATIF</span></h2>
                <p>HIMATIF merupakan bagian dari organisasi kampus yang menjalankan peran serta tanggung jawabnya, dengan maksud untuk menggali,
                    mengoptimalkan, dan mengembangkan sumber daya mahasiswa yang tersedia. Ini bertujuan agar mereka dapat memenuhi peran dan fungsinya sebagai
                    mahasiswa.</p>
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <a href="https://www.youtube.com/watch?v=L8zotgIl4VY" class="glightbox btn-watch-video d-flex align-items-center"><i
                            class="bi bi-play-circle"></i><span>Watching Video</span></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="image-container" data-aos="zoom-out" data-aos-delay="100">
                    <img src="{{ asset('assets/img/himatif/himatif.jpg') }}" class="img-fluid rounded-image" alt="">
                </div>
            </div>
        </div>
    </div>

    <br>

    </div>
</section>
<!-- End Hero Section -->

<main id="main">

    <!-- ======= Agenda Calendar Section ======= -->
<!-- ======= Agenda Calendar Section ======= -->
<section id="agenda-calendar" class="agenda-calendar section-bg py-5" style="background-color: #414544"> {{-- Tambah section-bg dan padding --}}
    <div class="container" data-aos="fade-up">
        <div class="section-header text-center mb-5"> {{-- section-header lebih standar untuk judul section --}}
            <h2>Agenda Kegiatan</h2>
            <p>Ikuti perkembangan kegiatan HIMATIF melalui kalender agenda kami.</p>
        </div>

        <div class="row gy-4"> {{-- gy-4 untuk gutter vertikal --}}
            <!-- Kolom Kiri: Daftar Agenda -->
            <div class="col-lg-7 col-md-6"> {{-- Lebarkan sedikit kolom agenda --}}
                <div class="bg-white p-4 rounded shadow-sm mb-4" data-aos="fade-right" data-aos-delay="100">
                    <h3 class="h5 fw-bold text-primary mb-3"><i class="fas fa-calendar-alt me-2"></i>Agenda Terdekat</h3>
                    @if(isset($agendasTerdekat) && $agendasTerdekat->count() > 0)
                    <div class="list-group" style="max-height: 280px; overflow-y: auto;">
                        @foreach($agendasTerdekat as $agenda)
                            {{-- MODIFIKASI LINK AGENDA --}}
                            <a href="{{ $agenda->berita_id ? route('beritas.show', $agenda->berita_id) : route('agendas.public', $agenda->id) }}"
                                class="list-group-item list-group-item-action flex-column align-items-start mb-2 border-start-3 {{ $agenda->berita_id ? 'border-primary' : 'border-secondary' }}"
                                title="{{ $agenda->berita_id ? 'Lihat detail berita terkait' : 'Lihat detail agenda' }}">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 fw-semibold text-dark">{{ $agenda->nama_kegiatan }}</h5>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($agenda->tanggal_kegiatan)->isoFormat('D MMM YYYY') }}
                                    </small>
                                </div>
                                <p class="mb-1 text-muted small text-truncate">{{ Str::limit(strip_tags($agenda->deskripsi), 90) }}</p>
                                @if($agenda->berita_id)
                                    <small class="text-info fst-italic"><i class="fas fa-newspaper me-1"></i>Berita terkait tersedia</small>
                                @endif
                            </a>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted fst-italic">Tidak ada agenda terdekat saat ini.</p>
                    @endif
                </div>

                <div class="bg-white p-4 rounded shadow-sm mb-4" data-aos="fade-right" data-aos-delay="200">
                    <h3 class="h5 fw-bold text-success mb-3"><i class="fas fa-redo-alt me-2"></i>Agenda Rutin Bulan Ini</h3>
                    @if(isset($agendasRutin) && $agendasRutin->count() > 0)
                    <div class="list-group" style="max-height: 220px; overflow-y: auto;">
                        @foreach($agendasRutin as $agenda)
                            {{-- MODIFIKASI LINK AGENDA --}}
                            <a href="{{ $agenda->berita_id ? route('beritas.show', $agenda->berita_id) : route('agendas.public', $agenda->id) }}"
                               class="list-group-item list-group-item-action mb-2 border-start-3 {{ $agenda->berita_id ? 'border-primary' : 'border-secondary' }}"
                               title="{{ $agenda->berita_id ? 'Lihat detail berita terkait' : 'Lihat detail agenda' }}">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <span class="text-dark">{{ $agenda->nama_kegiatan }}</span>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($agenda->tanggal_kegiatan)->isoFormat('D MMM') }}
                                    </small>
                                </div>
                                @if($agenda->berita_id)
                                    <small class="text-info fst-italic d-block mt-1"><i class="fas fa-newspaper me-1"></i>Ada berita terkait</small>
                                @endif
                            </a>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted fst-italic">Tidak ada agenda rutin bulan ini.</p>
                    @endif
                </div>
            </div>


    <!-- Kolom Kanan: Kalender Bulanan -->
        <div class="col-lg-5 col-md-6">
            <div class="bg-white p-3 rounded shadow-sm sticky-top" style="top: 100px;" data-aos="fade-left" data-aos-delay="300">
                @php
                    // Variabel $currentYear, $currentMonth, dan $agendasForCalendar dikirim dari WelcomeController
                    $date = \Carbon\Carbon::createFromDate($currentYear, $currentMonth, 1);
                    $firstDayOfMonth = $date->copy()->startOfMonth();
                    $lastDayOfMonth = $date->copy()->endOfMonth();
                    $startDayOfWeek = $firstDayOfMonth->dayOfWeekIso; // Senin = 1, Minggu = 7
                @endphp

            <div class="d-flex justify-content-between align-items-center mb-2">
                    {{-- Pastikan route 'welcome' bisa menerima parameter 'month' dan 'year' --}}
                <a href="{{ route('welcome', ['month' => $date->copy()->subMonth()->month, 'year' => $date->copy()->subMonth()->year]) }}" class="btn btn-sm btn-outline-secondary">« Prev</a>
                <h4 class="text-center text-primary mb-0">{{ $date->isoFormat('MMMM YYYY') }}</h4>
                <a href="{{ route('welcome', ['month' => $date->copy()->addMonth()->month, 'year' => $date->copy()->addMonth()->year]) }}" class="btn btn-sm btn-outline-secondary">Next »</a>
            </div>

            <table class="table table-bordered text-center" style="font-size: 0.9rem;">
                <thead class="table-light">
                    <tr>
                        <th>Sn</th><th>Sl</th><th>Rb</th><th>Km</th><th>Jm</th><th class="text-danger">Sb</th><th class="text-danger">Mg</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @for ($i = 1; $i < $startDayOfWeek; $i++)
                            <td></td>
                        @endfor

                        @for ($day = 1; $day <= $lastDayOfMonth->day; $day++)
                            @php
                            $currentDayDate = \Carbon\Carbon::createFromDate($currentYear, $currentMonth, $day);
                            $isWeekend = $currentDayDate->isWeekend();
                            // Mengambil agenda untuk hari ke-$day dari collection yang sudah di-keyBy hari
                            $agendaHariIni = $agendasForCalendar->get($day);
                            $hasEvent = !is_null($agendaHariIni);
                            $isToday = $currentDayDate->isToday();

                            $link = null; // Inisialisasi link
                            $titleAttribute = ''; // Inisialisasi title untuk tooltip
                            $cellStyle = ''; // Untuk style inline jika perlu

                            if ($hasEvent) {
                                $titleAttribute = $agendaHariIni->nama_kegiatan; // Default title
                                // Tentukan link berdasarkan apakah agenda punya berita_id
                                if ($agendaHariIni->berita_id) {
                                    $link = route('beritas.show', $agendaHariIni->berita_id);
                                    $titleAttribute .= ' (Lihat Berita)';
                                } else {
                                    // Jika tidak ada berita_id, arahkan ke detail agenda publik
                                    // Pastikan route 'agendas.public' ada dan menerima parameter agenda (ID atau slug)
                                    $link = route('agendas.public', $agendaHariIni->id);
                                    $titleAttribute .= ' (Lihat Detail Agenda)';
                                }
                            }

                            // Styling visual di sel kalender
                            if ($hasEvent) {
                                 $cellStyle = 'background-color: #0d6efd; color: white; font-weight: bold; border-radius: 50%;'; // Biru primary Bootstrap
                            } elseif ($isToday) {
                                 $cellStyle = 'background-color: #cfe2ff; border-radius: 50%;'; // Biru info light Bootstrap
                            } elseif ($isWeekend) {
                                 $cellStyle = 'color: #dc3545;'; // Merah danger Bootstrap
                            }
                            @endphp
                            <td style="padding: 0.3rem 0.1rem; {{ $hasEvent && $link ? 'cursor:pointer;' : '' }}"
                                @if($link) onclick="window.location.href='{{ $link }}'" title="{{ $titleAttribute }}" @endif>
                                <span style="{{ $cellStyle }} display: inline-block; width: 2.2em; height: 2.2em; line-height: 1.8em; text-align:center;">
                                 {{ $day }}
                                </span>
                            </td>

                            @if (($startDayOfWeek + $day - 1) % 7 == 0 && $day != $lastDayOfMonth->day)
                                </tr><tr>
                            @endif
                        @endfor

                        @if (($startDayOfWeek + $lastDayOfMonth->day - 1) % 7 != 0)
                            @for ($i = ($startDayOfWeek + $lastDayOfMonth->day - 1) % 7; $i < 7-1; $i++)
                                <td></td>
                            @endfor
                        @endif
                    </tr>
                </tbody>
            </table>
            <div class="text-center mt-3">
                <a href="{{ route('agendas.index') }}" class="btn btn-outline-primary btn-sm">See All Agenda</a>
         </div>
        </div>
        </div>
        </div>
</section><!-- End Agenda Calendar Section -->

     <section id="recent-posts" class="recent-posts" style="background-color: #414544; color:#ffffff; padding-top: 60px; padding-bottom: 60px;">
        <div class="container" data-aos="fade-up">

            <div class="section-header text-center mb-5">
                <h2>Berita Terbaru</h2>
                <p style="color:#ffffff; font-size: 1.1rem;">Informasi terkini seputar kegiatan, prestasi, dan inovasi dari HIMATIF.</p>
            </div>

            {{-- .row adalah flex container untuk kolom-kolomnya --}}
            {{-- gy-4 memberikan gutter vertikal, justify-content-center untuk item ganjil terakhir --}}
            <div class="row gy-4 justify-content-center">
                @forelse($beritasTerbaru as $berita)
                    {{-- .col-- d-flex align-items-stretch AKAN MENYAMAKAN TINGGI KOLOM DALAM SATU BARIS --}}
                    <div class="col-xl-4 col-md-6 d-flex align-items-stretch">
                        {{-- article h-100 d-flex flex-column AKAN MEMBUAT CARD MENGISI TINGGI KOLOM
                             DAN MENGATUR KONTEN INTERNALNYA DENGAN FLEX --}}
                        <article class="h-100 d-flex flex-column">

                            <div class="post-img">
                                <a href="{{ route('beritas.public', $berita->id) }}">
                                    @if($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="img-fluid">
                                    @else
                                        <img src="{{ asset('assets/img/news.jpg') }}" alt="Default Image" class="img-fluid">
                                    @endif
                                </a>
                            </div>

                            <p class="post-category">{{ \Carbon\Carbon::parse($berita->tanggal)->isoFormat('D MMMM YYYY') }}</p>

                            {{-- .post-content akan meregang (flex-grow-1) mengisi sisa ruang di dalam article --}}
                            <div class="post-content flex-grow-1 d-flex flex-column">
                                <h2 class="title">
                                    <a href="{{ route('beritas.public', $berita->id) }}">{{ $berita->judul }}</a>
                                </h2>

                                <p class="description">
                                    {{ strip_tags($berita->deskripsi) }} {{-- Hapus Str::limit jika sudah dihandle CSS line-clamp --}}
                                </p>

                                {{-- .post-author-meta akan didorong ke bawah oleh mt-auto DI DALAM .post-content --}}
                                <div class="post-author-meta d-flex align-items-center mt-auto">
                                    <div class="post-author">
                                        <i class="bi bi-person"></i>
                                        <span>HIMATIF</span>
                                    </div>
                                    <div class="post-date ms-auto">
                                        <i class="bi bi-clock"></i>
                                        <time datetime="{{ $berita->tanggal }}">{{ \Carbon\Carbon::parse($berita->tanggal)->diffForHumans() }}</time>
                                    </div>
                                </div>
                            </div>

                        </article>
                    </div><!-- End post list item -->
                @empty
                    <div class="col-12">
                        <p class="text-center" style="color: #ffffff; font-style: italic;">Tidak ada berita terbaru saat ini.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('beritas.public') }}" class="btn btn-outline-light btn-lg">See Al Blogs</a>
            </div>

        </div>
    </section><!-- End Recent Blog Posts Section -->

</main><!-- End #main -->

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function equalizeCardHeights() {
        const recentPostsSection = document.getElementById('recent-posts');
        if (!recentPostsSection) {
            console.warn('Section with ID "recent-posts" not found.');
            return;
        }

        const cards = recentPostsSection.querySelectorAll('article.h-100'); // Lebih spesifik menargetkan article card kita
        if (cards.length === 0) {
            return; // Tidak ada kartu, tidak ada yang perlu dilakukan
        }

        let maxHeight = 0;

        // 1. Reset tinggi ke 'auto' untuk mendapatkan tinggi alami
        cards.forEach(card => {
            card.style.height = 'auto';
        });

        // 2. Temukan tinggi maksimum
        cards.forEach(card => {
            const cardHeight = card.offsetHeight;
            if (cardHeight > maxHeight) {
                maxHeight = cardHeight;
            }
        });

        // 3. Atur semua kartu ke tinggi maksimum tersebut
        // Hanya jika maxHeight lebih besar dari 0 (ada konten)
        if (maxHeight > 0) {
            cards.forEach(card => {
                card.style.height = maxHeight + 'px';
            });
        }
    }

    // Panggil fungsi saat halaman selesai dimuat
    equalizeCardHeights();

    // Panggil fungsi saat ukuran jendela diubah (dengan debounce untuk performa)
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(equalizeCardHeights, 150);
    });

    // Jika Anda memuat berita secara dinamis (misalnya dengan AJAX)
    // Anda mungkin perlu memanggil equalizeCardHeights() lagi setelah konten baru dimuat.
    // Salah satu cara adalah dengan membuat custom event atau menggunakan MutationObserver.
});
</script>
@endpush