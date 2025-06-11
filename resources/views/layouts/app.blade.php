<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'Himatif')</title> {{-- Judul dinamis --}}
  <meta name="description" content="@yield('description', '')"> {{-- Deskripsi dinamis --}}
  <meta name="keywords" content="@yield('keywords', '')"> {{-- Keywords dinamis --}}

  <link href="{{ asset('assets\img\data himatif\himatif.jpg') }}" rel="icon" type="image/png">
  <link href="{{ asset('assets/data himatif/logo.png') }}" rel="apple-touch-icon" type="image/png">


  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  <!-- Glide JS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.6.0/dist/css/glide.core.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.6.0/dist/css/glide.theme.min.css">

  {{-- Ini adalah style inline yang sudah ada, bisa dipertahankan atau dipindah ke main.css --}}
  <style>
    .navbar-hidden {
    transform: translateY(-100%); /* Geser navbar ke atas */
    transition: transform 0.3s ease-in-out; /* Efek transisi halus */
    }

  body {
      /* background-color: #414544; */ /* Warna background body sudah di-set di tag body, bisa dihapus dari sini jika duplikat */
    }
  </style>

  {{-- =======================================================
    INI YANG PERLU DITAMBAHKAN:
    Untuk menampung style yang di-push dari view anak
  ======================================================== --}}
  @stack('styles')

  <!-- =======================================================
  * Template Name: Impact
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page" style="background-color: #414544;">
<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.6.0/dist/glide.min.js"></script> 
  <header id="header" class="header fixed-top ">
    {{-- ... (isi header Anda) ... --}}
    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-cente">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
          <h1 class="sitename"><img src="{{ asset('assets/img/himatif/himatif.jpg') }}">HIMATIF</h1>
        </a>

        @include('layouts.navbar')

      </div>

    </div>
  </header>

  <main class="main">
    @yield('content') {{-- Tempat konten halaman spesifik --}}
  </main>

  @include("layouts.footer")

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
    var header = document.getElementById('header');
    var prevScrollPos = window.pageYOffset;

    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;

        if (prevScrollPos > currentScrollPos) {
            // Scroll ke atas
            header.classList.remove('navbar-hidden');
        } else {
            // Scroll ke bawah
            header.classList.add('navbar-hidden');
        }

        prevScrollPos = currentScrollPos;
    }
});
  </script>

  {{-- Tambahkan ini jika Anda juga menggunakan @push('scripts') --}}
  @stack('scripts')

</body>
</html>
