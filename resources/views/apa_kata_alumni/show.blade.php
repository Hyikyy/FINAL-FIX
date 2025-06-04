@extends('layouts.app')

@section('title', 'Detail Alumni | Website Kami')
@section('description', 'Detail informasi alumni')
@section('keywords', 'alumni, detail alumni')

@section('content')

<style>
    /* Style Card */
    .alumni-card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
        width: 350px; /* Lebar card lebih besar */
        margin: 20px auto;
        display: flex; /* Menggunakan flexbox */
        flex-direction: column; /* Susun elemen vertikal */
        align-items: center; /* Tengahkan horizontal */
        text-align: center; /* Tengahkan teks */
        border: 2px solid #000; /* Border Hitam */
    }

    .alumni-card:hover {
        transform: translateY(-5px);
    }

   /* Style Gambar Lingkaran */
    .alumni-card .image-container {
        width: 200px; /* Ukuran gambar lebih besar */
        height: 200px; /* Ukuran gambar lebih besar */
        border-radius: 50%;
        overflow: hidden;
        margin: 20px auto 10px; /* Margin atas, samping, bawah */
        border: 5px solid #444547;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease; /* Efek hover gambar */
    }

    .alumni-card:hover .image-container {
        transform: scale(1.1); /* Efek hover zoom gambar */
    }

    .alumni-card .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Style Info */
    .alumni-card-info {
        padding: 20px;
        background-color: #f9f9f9;
        width: 100%; /* Info selebar card */
    }

    .alumni-card-info h3 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .alumni-card-info h4 {
        font-size: 14px;
        color: #777;
        margin-bottom: 10px;
    }

    .alumni-card-info p {
        font-size: 14px;
        line-height: 1.5;
        color: #555;
        margin-bottom: 8px;
    }

    .alumni-card-info p b {
        font-weight: bold;
        color: #333;
    }

    /* Style Tombol */
    .alumni-card-info .btn-primary {
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 5px;
        display: inline-block;
        transition: background-color 0.3s ease;
        border: none;
    }

    .alumni-card-info .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    /* Tambahkan margin atas pada section utama */
    #alumni-details {
        margin-top: 50px;
    }

     /* Responsive design */
     @media (max-width: 768px) {
        .alumni-card {
            width: 90%; /* Card selebar layar */
        }

        .alumni-card .image-container {
            width: 150px;
            height: 150px;
        }

        .alumni-card-info {
            padding: 15px;
        }

        .alumni-card-info h3 {
            font-size: 18px;
        }

        .alumni-card-info h4 {
            font-size: 13px;
        }

        .alumni-card-info p {
            font-size: 13px;
            line-height: 1.4;
        }

        .alumni-card-info .btn-primary {
            font-size: 12px;
            padding: 6px 12px;
        }
    }

</style>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2></h2>
          <ol>
            <li></li>
            <li></li>
            <li></li>
          </ol>
        </div>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Alumni Details Section ======= -->
    <section id="alumni-details" class="team">
      <div class="container" data-aos="fade-up">

        <div class="row justify-content-center"> <!-- Tengahkan kolom -->
          <div class="col-md-8"> <!-- Ubah ukuran kolom sesuai kebutuhan -->
            <div class="alumni-card">
              <div class="image-container">
                @if($apaKataAlumni->gambar)
                  <img src="{{ asset('storage/apa_kata_alumni/' . $apaKataAlumni->gambar) }}" alt="{{ $apaKataAlumni->nama }}">
                @else
                  <img src="{{ asset('assets/img/no-image.png') }}" alt="Default Image">
                @endif
              </div>
              <div class="alumni-card-info">
                <h3>{{ $apaKataAlumni->nama }}</h3>
                <h4>Angkatan: {{ $apaKataAlumni->angkatan }}</h4>
                <p><b>Pekerjaan:</b> {{ $apaKataAlumni->pekerjaan }}</p>
                <p><b>Pesan: </b>{{ $apaKataAlumni->isi }}</p>
                <p>
                    <a href="{{ route('apa_kata_alumni.index') }}" class="btn btn-primary">Kembali</a>
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Alumni Details Section -->

  </main><!-- End #main -->

@endsection
