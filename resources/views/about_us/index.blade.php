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
          <h2></h2>
          <ol>
            <li></li>
            <li></li>
          </ol>
        </div>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Sejarah Section ======= -->
    <section id="sejarah" class="inner-page">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2 class="text-center fw-bold">Sejarah HIMATIF</h2>
          <p class="text-center">Perjalanan panjang yang membentuk HIMATIF menjadi organisasi yang solid dan berprestasi.</p>
        </div>

        <!-- Gambar HIMATIF (Lingkaran) -->
        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="text-center mb-4">
              <img src="{{ asset('assets/img/himatif/himatif.jpg') }}" alt="Logo HIMATIF" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="sejarah-content">
              <p>
                HIMATIF (Himpunan Mahasiswa Teknologi Informasi) Institut Teknologi Del didirikan pada tanggal [Tanggal Pendirian] dengan tujuan utama untuk menjadi wadah bagi mahasiswa Program Studi S1 Teknologi Informasi dalam mengembangkan potensi akademik, non-akademik, serta karakter kepemimpinan.
              </p>
              <p>
                Sejak awal berdirinya, HIMATIF telah berkomitmen untuk menyelenggarakan berbagai kegiatan yang positif dan bermanfaat, baik bagi anggotanya maupun bagi masyarakat luas. Kegiatan-kegiatan tersebut mencakup seminar teknologi, workshop, pelatihan soft skill, bakti sosial, serta berbagai kompetisi yang mengasah kemampuan mahasiswa di bidang IT.
              </p>
              <p>
                Dalam perjalanannya, HIMATIF terus beradaptasi dengan perkembangan zaman dan teknologi. Kami berusaha untuk selalu relevan dan inovatif dalam setiap program kerja yang kami rancang. Dukungan dari pihak program studi, dosen, alumni, serta seluruh mahasiswa IT Del menjadi pilar penting dalam setiap pencapaian HIMATIF.
              </p>
              <p>
                Kami bercita-cita untuk terus mencetak generasi penerus bangsa yang tidak hanya unggul dalam penguasaan teknologi informasi, tetapi juga memiliki integritas, etos kerja yang tinggi, dan kepedulian sosial. HIMATIF IT Del akan terus bergerak maju, berkontribusi, dan menginspirasi.
              </p>
              {{-- Tambahkan lebih banyak paragraf atau poin sejarah sesuai kebutuhan --}}
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Sejarah Section -->

    <!-- ======= Dosen Section ======= -->
<section id="Dosen" class="team py-5"> {{-- Tambahkan padding vertikal pada section jika belum ada --}}
  <div class="container" data-aos="fade-up">

    <div class="section-header mb-4"> {{-- Margin bawah pada header section --}}
      <h2 class="text-center fw-bold">Dosen Pengajar HIMATIF</h2>
      <p class="text-center" style="color:#000000">Kenali dosen-dosen berdedikasi yang membimbing HIMATIF.</p>
    </div>

    {{-- Tambahkan gy-4 untuk jarak vertikal antar baris card --}}
    {{-- Tambahkan justify-content-center agar jika baris terakhir tidak penuh, cardnya rata tengah --}}
    <div class="row gy-4 justify-content-center">
      @foreach($dosens as $index => $dosen)
        {{-- Kolom card --}}
        <div class="col-xl-3 col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($index % 4 + 1) * 100 }}">
          {{-- Card utama --}}
          <div class="member">
            <div class="member-img">
              @if($dosen->gambar)
                {{-- PASTIKAN PATH INI BENAR SESUAI LOKASI FILE ANDA --}}
                <img src="{{ asset('storage/images/' . $dosen->gambar) }}" class="img-fluid" alt="{{ $dosen->nama }}">
              @else
                <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid" alt="Default Image">
              @endif
            </div>
            <div class="member-content-wrapper"> {{-- Wrapper baru untuk fleksibilitas konten --}}
                <h4>{{ $dosen->nama }}</h4>
                <span>{{ $dosen->nama_jabatan }}</span>
                <p>{{ Str::limit($dosen->deskripsi_jabatan, 70) }}</p> {{-- Sesuaikan limit --}}
            </div>
            <div class="member-action">
              {{-- Pastikan route 'dosen.show' ada dan menerima $dosen->id --}}
              <a href="{{ route('dosen.showPublicDetail', $dosen->id) }}" class="btn btn-outline-dark">Lihat Detail</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>

  </div>
</section><!-- End Dosen Section -->

{{-- TERAPKAN POLA YANG SAMA UNTUK SECTION ASISTEN DOSEN --}}
<!-- ======= Asisten Dosen Section ======= -->
<section id="AsistenDosen" class="team py-5">
  <div class="container" data-aos="fade-up">
    <div class="section-header mb-4">
      <h2 class="text-center fw-bold">Teaching Assistant</h2>
      <p class="text-center" style="color:#000000">Para asisten dosen yang membantu kelancaran kegiatan akademik.</p>
    </div>
    <div class="row gy-4 justify-content-center">
      @foreach($teachingAssistants as $index => $assistant)
        <div class="col-xl-3 col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($index % 4 + 1) * 100 }}">
          <div class="member">
            <div class="member-img">
              @if($assistant->gambar)
                {{-- PASTIKAN PATH INI BENAR --}}
                <img src="{{ asset('storage/teaching_assistants/' . $assistant->gambar) }}" class="img-fluid" alt="{{ $assistant->nama }}">
              @else
                <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid" alt="Default Image">
              @endif
            </div>
             <div class="member-content-wrapper">
                <h4>{{ $assistant->nama }}</h4>
                <span>{{ $assistant->nama_jabatan }}</span>
                <p>{{ Str::limit($assistant->deskripsi_jabatan, 70) }}</p>
            </div>
            <div class="member-action">
                <a href="{{ route('teaching_assistants.showPublicDetail', $assistant->id) }}" class="btn btn-outline-dark">Lihat Detail</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section><!-- End Asisten Dosen Section -->


{{-- TERAPKAN POLA YANG SAMA UNTUK SECTION ALUMNI --}}
<!-- ======= Alumni Section ======= -->
<section id="Alumni" class="team py-5">
  <div class="container" data-aos="fade-up">
    <div class="section-header mb-4">
      <h2 class="text-center fw-bold">Alumni HIMATIF</h2>
      <p class="text-center" style="color:#000000">Alumni-alumni berprestasi dari HIMATIF.</p>
    </div>
    <div class="row gy-4 justify-content-center">
      @foreach($alumnis as $index => $alumni)
        <div class="col-xl-3 col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($index % 4 + 1) * 100 }}">
          <div class="member">
            <div class="member-img">
              @if($alumni->gambar)
                <img src="{{ asset('storage/' . $alumni->gambar) }}" alt="{{ $alumni->nama }}">
            @else
                <img src="{{ asset('assets/img/no-image.png') }}" alt="Default Image">
            @endif
            </div>
            <div class="member-content-wrapper">
                <h4>{{ $alumni->nama }}</h4>
                {{-- Untuk Alumni, 'span' bisa untuk Angkatan jika ada --}}
                <span>
                    @if($alumni->nama_cantik) {{ $alumni->nama_cantik }} <br> @endif
                    @if($alumni->angkatan) Angkatan {{ $alumni->angkatan }} @endif
                </span>
                {{-- Di Alumni Anda menggunakan $alumni->deskripsi, pastikan field ini ada --}}
                <p>{{ Str::limit($alumni->deskripsi_jabatan ?? $alumni->deskripsi ?? 'Informasi tidak tersedia.', 70) }}</p>
            </div>
            <div class="member-action">
                {{-- Tombol untuk Alumni menggunakan btn-sm, pastikan CSS nya ada --}}
                <a href="{{ route('alumni.showPublicDetail', $alumni->id) }}" class="btn btn-sm">Lihat Detail</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section><!-- End Alumni Section -->

  </main><!-- End #main -->
  <style>
    .sejarah-content p {
      text-align: justify; /* Membuat teks rata kanan-kiri */
      margin-bottom: 15px; /* Menambah jarak antar paragraf */
      line-height: 1.6; /* Meningkatkan keterbacaan dengan mengatur tinggi baris */
      font-size: 1rem; /* Ukuran font yang diubah */
    }
    /* ... CSS Anda yang sudah ada untuk .sejarah-content ... */

    /* === CARD STYLING UMUM UNTUK SEMUA SECTION (DOSEN, ASISTEN, ALUMNI) === */
    .team .member { /* Ini adalah card utama Anda */
        background: #fff;
        border-radius: 10px; /* Sedikit radius pada card */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Shadow yang lebih terlihat */
        padding: 20px;
        text-align: center;
        width: 100%; /* Pastikan card mengisi lebar kolom */
        height: 100%; /* Pastikan card mengisi tinggi kolom (dari align-items-stretch) */
        display: flex;
        flex-direction: column; /* Susun elemen di dalam card secara vertikal */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .team .member:hover {
        transform: translateY(-5px); /* Efek sedikit terangkat saat hover */
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .team .member .member-img { /* Wrapper untuk gambar */
        width: 100%; /* Gambar mengambil lebar penuh */
        /* TINGGI TETAP untuk frame gambar agar konsisten */
        height: 200px; /* Sesuaikan nilai ini sesuai kebutuhan Anda! */
        border-radius: 8px; /* Radius pada frame gambar */
        overflow: hidden; /* Penting agar gambar di-crop dengan benar sesuai radius */
        margin-bottom: 15px; /* Jarak dari gambar ke teks nama */
        background-color: #f0f0f0; /* Warna placeholder jika gambar tidak ada */
    }

    .team .member .member-img img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Kunci: gambar mengisi frame, menjaga rasio, dan di-crop */
        display: block;
    }

    .team .member h4 { /* Nama */
        font-size: 1.1rem; /* Ukuran font nama */
        font-weight: 700;
        margin-top: 0; /* Margin atas sudah diatur oleh padding card */
        margin-bottom: 5px; /* Jarak dari nama ke jabatan/info lain */
        color: #333; /* Warna teks nama */
        line-height: 1.3;
        min-height: 2.6em; /* Alokasikan ruang untuk ~2 baris nama, agar rata */
                           /* (1.3em line-height * 2). Sesuaikan jika perlu. */
        display: flex; /* Untuk meratakan teks jika hanya 1 baris */
        align-items: center;
        justify-content: center;
    }

    .team .member span { /* Jabatan / Info Tambahan (misal Angkatan Alumni) */
        display: block;
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 10px;
        line-height: 1.4;
        min-height: 1.4em; /* Alokasikan ruang untuk ~1 baris info, agar rata */
    }

    .team .member p { /* Deskripsi Singkat */
        font-size: 0.9rem;
        color: #555;
        line-height: 1.5;
        flex-grow: 1; /* Ini akan membuat deskripsi mengisi sisa ruang vertikal */
        margin-bottom: 15px; /* Jarak dari deskripsi ke tombol */
        /* Anda bisa menggunakan Str::limit pada deskripsi yang lebih panjang jika mau */
        /* Dan tambahkan min-height jika ingin deskripsi juga punya tinggi minimal yang sama */
        /* min-height: 4.5em; (misal, untuk 3 baris) */
    }

    .team .member .member-action { /* Wrapper Tombol */
        margin-top: auto; /* Mendorong tombol ke paling bawah */
    }

    .team .member .member-action .btn {
        border-radius: 20px;
        padding: 6px 18px; /* Padding tombol */
        font-size: 0.8rem;
        font-weight: 500;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    /* Contoh gaya tombol yang lebih menarik (sesuaikan dengan tema Anda) */
    .team .member .member-action .btn.btn-outline-dark {
        border-color: #555;
        color: #555;
    }
    .team .member .member-action .btn.btn-outline-dark:hover {
        background-color: #333;
        color: #fff;
        border-color: #333;
    }
    /* Sesuaikan juga untuk .btn-outline-light atau .btn-sm jika digunakan */
    .team .member .member-action .btn.btn-outline-light {
        border-color: #ccc; /* Border lebih terlihat untuk light */
        color: #555; /* Teks lebih terlihat */
    }
     .team .member .member-action .btn.btn-outline-light:hover {
        background-color: #555;
        color: #fff;
        border-color: #555;
    }
     .team .member .member-action .btn.btn-sm { /* Gaya spesifik untuk .btn-sm jika digunakan di Alumni */
        border-color: #555; /* Contoh warna aksen */
        color: #555;
        background-color: transparent;
    }
    .team .member .member-action .btn.btn-sm:hover {
        background-color: #000000;
        color: #fff;
    }

  </style>

@endsection
