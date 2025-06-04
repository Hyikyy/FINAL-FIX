<!doctype html>
<html lang="en">

<head>
  @include('admin.head')
  <style>
    /* Custom CSS untuk Dashboard */
    .dashboard-container {
      padding: 20px;
    }

    .welcome-message {
      background-color: #f8f9fa;
      padding: 30px; /* Tambah padding agar lebih luas */
      border-radius: 12px; /* Border radius yang lebih besar */
      margin-bottom: 20px;
      text-align: center; /* Tengahkan konten */
    }

    .welcome-image {
      width: 150px; /* Ukuran gambar lebih besar */
      height: 150px;
      border-radius: 50%; /* Membuat lingkaran */
      object-fit: cover; /* Memastikan gambar mengisi lingkaran dengan benar */
      margin-top: 20px; /* Ruang antara teks dan gambar */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); /* Efek bayangan untuk gambar */
    }

    .welcome-message h2 {
      font-size: 2rem; /* Ukuran judul lebih besar */
      margin-bottom: 10px;
    }

    .welcome-message p {
      font-size: 1.1rem; /* Ukuran paragraf lebih besar */
      color: #555; /* Warna teks lebih lembut */
    }

    .dashboard-card {
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-title {
      font-size: 1.2rem;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .card-value {
      font-size: 2rem;
      font-weight: bold;
      color: #007bff; /* Warna biru untuk nilai penting */
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!-- Sidebar Start -->
    @include('admin.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('admin.header')
      <!--  Header End -->
      <div class="container-fluid dashboard-container">
        <!-- Welcome Message -->
        <div class="welcome-message">
          <h2>Selamat Datang, Admin HIMATIF!</h2>
          <p>Selamat datang di dashboard admin. Gunakan menu di samping untuk mengelola sistem.</p>
          <img src="{{ asset('assets/img/himatif/himatif.jpg') }}" alt="Logo HIMATIF" class="welcome-image">
        </div>

        <!-- Isi Dashboard Lainnya (Grafik, Tabel, dll.) -->
      </div>
    </div>
  </div>
  </div>
  <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>