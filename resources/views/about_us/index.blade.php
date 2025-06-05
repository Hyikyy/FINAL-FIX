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
    <section id="Dosen" class="team py-5">
        <div class="container" data-aos="fade-up">
            <div class="section-header mb-5">
                <h2 class="text-center fw-bold" style="font-size: 2.5rem;">Dosen Pengajar HIMATIF</h2>
                <p class="text-center lead" style="color:#495057;">Kenali dosen-dosen berdedikasi yang membimbing HIMATIF.</p>
            </div>
            <div class="row justify-content-center">
                @foreach($dosens as $index => $dosen)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 col-12 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($index % 4 + 1) * 100 }}">
                        <div class="member h-100 w-100 d-flex flex-column shadow-sm rounded">
                            <div class="member-img w-100">
                                @if($dosen->gambar)
                                    <img src="{{ asset('storage/images/' . $dosen->gambar) }}" class="img-fluid w-100" alt="{{ $dosen->nama }}">
                                @else
                                    <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid w-100" alt="Default Image">
                                @endif
                            </div>
                            <div class="member-info p-3 d-flex flex-column flex-grow-1">
                                <h4 style="color: black;">{{ $dosen->nama }}</h4>
                                <span>{{ $dosen->nama_jabatan }}</span>
                                <p class="flex-grow-1">{{ Str::limit($dosen->deskripsi_jabatan, 75) }}</p>
                                <div class="member-action mt-auto">
                                    <a href="{{ route('dosen.showPublicDetail', $dosen->id) }}" class="btn btn-outline-dark">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- End Dosen Section -->

    <!-- ======= Asisten Dosen Section ======= -->
    <section id="AsistenDosen" class="team py-5">
        <div class="container" data-aos="fade-up">
            <div class="section-header mb-5">
                <h2 class="text-center fw-bold" style="font-size: 2.5rem;">Teaching Assistant</h2>
                <p class="text-center lead" style="color:#495057;">Para asisten dosen yang membantu kelancaran kegiatan akademik.</p>
            </div>
            <div class="row justify-content-center">
                @foreach($teachingAssistants as $index => $assistant)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 col-12 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($index % 4 + 1) * 100 }}">
                        <div class="member h-100 w-100 d-flex flex-column shadow-sm rounded">
                            <div class="member-img w-100">
                                @if($assistant->gambar)
                                    <img src="{{ asset('storage/teaching_assistants/' . $assistant->gambar) }}" class="img-fluid w-100" alt="{{ $assistant->nama }}">
                                @else
                                    <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid w-100" alt="Default Image">
                                @endif
                            </div>
                            <div class="member-info p-3 d-flex flex-column flex-grow-1">
                                <h4 style="color: black;">{{ $assistant->nama }}</h4>
                                <span>{{ $assistant->nama_jabatan }}</span>
                                @if($assistant->deskripsi_jabatan)
                                    <p class="flex-grow-1">{{ Str::limit($assistant->deskripsi_jabatan, 75) }}</p>
                                @endif
                                <div class="member-action mt-auto">
                                    <a href="{{ route('teaching_assistants.showPublicDetail', $assistant->id) }}" class="btn btn-outline-dark">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- End Asisten Dosen Section -->

    <!-- ======= Alumni Section ======= -->
    <section id="Alumni" class="team py-5">
        <div class="container" data-aos="fade-up">
            <div class="section-header mb-5">
                <h2 class="text-center fw-bold" style="font-size: 2.5rem;">Alumni HIMATIF</h2>
                <p class="text-center lead" style="color:#495057;">Alumni-alumni berprestasi dari HIMATIF.</p>
            </div>
            <div class="row justify-content-center">
                @foreach($alumnis as $index => $alumni)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 col-12 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($index % 4 + 1) * 100 }}">
                        <div class="member h-100 w-100 d-flex flex-column shadow-sm rounded">
                            <div class="member-img w-100">
                                @if($alumni->gambar)
                                    <img src="{{ asset('storage/' . $alumni->gambar) }}" class="img-fluid w-100" alt="{{ $alumni->nama }}">
                                @else
                                    <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid w-100" alt="{{ $alumni->nama }}">
                                @endif
                            </div>
                            <div class="member-info p-3 d-flex flex-column flex-grow-1">
                                <h4 style="color: black;">{{ $alumni->nama }}</h4>
                                <span>
                                    @if($alumni->nama_cantik) {{ $alumni->nama_cantik }} <br> @endif
                                    @if($alumni->angkatan) Angkatan {{ $alumni->angkatan }} @endif
                                </span>
                                @if($alumni->deskripsi_jabatan ?? $alumni->deskripsi)
                                    <p class="flex-grow-1">{{ Str::limit($alumni->deskripsi_jabatan ?? $alumni->deskripsi, 75) }}</p>
                                @endif
                                <div class="member-action mt-auto">
                                    <a href="{{ route('alumni.showPublicDetail', $alumni->id) }}" class="btn btn-outline-dark">Lihat Detail</a>
                                </div>
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
      text-align: justify;
      margin-bottom: 15px;
      line-height: 1.6;
      font-size: 1rem;
    }

    /* === CARD STYLING UMUM UNTUK SEMUA SECTION (DOSEN, ASISTEN, ALUMNI) === */
    .team .member {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .team .member:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .team .member .member-action {
        margin-top: auto;
    }

    .team .member .member-action .btn {
        border-radius: 25px;
        padding: 10px 25px;
        font-size: 1rem;
        font-weight: 500;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        border: 2px solid #343a40;
        color: #343a40;
    }

    .team .member .member-action .btn:hover {
        background-color: #343a40;
        color: #ffffff !important;
        border-color: #343a40;
    }

    .team .member .member-img {
        position: relative;
        overflow: hidden;
        padding-bottom: 120%;
    }

    .team .member .member-img img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px 15px 0 0;
        transition: transform 0.3s ease;
        clip-path: ellipse(100% 100% at 50% 0%);
    }

    .team .member .member-img:hover img {
        transform: scale(1.05);
    }

    .team .member .member-info {
        padding: 1.5rem;
    }

    .team .member .member-info h4 {
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
        color: #212529;
    }

    .team .member .member-info span {
        font-size: 1rem;
        color: #6c757d;
    }

    .team .member .member-info p {
        font-size: 1rem;
        color: #495057;
        margin-bottom: 1rem;
    }

  </style>

@endsection