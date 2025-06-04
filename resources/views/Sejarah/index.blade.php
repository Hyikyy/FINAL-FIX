@extends('layouts.app')

@section('title', 'Sejarah Himatif')
@section('description', 'Sejarah berdiri dan terbentuk nya Himatif')
@section('keywords', 'sejarah, berdiri, terbentuknya, Himatif')

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
  </main>
  @endsection
