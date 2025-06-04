<!doctype html>
<html lang="en">

<head>
    @include('admin.head')
    <title>Vision & Mission Details </title>
    <style>
        /* Style untuk paragraf visi agar lebih rapi */
        .vision-paragraph-detail, .mission-paragraph-detail {
            padding-left: 5px; /* Sedikit indentasi jika diinginkan, atau hapus jika tidak perlu */
            line-height: 1.6;
        }
        /* Jika misi ingin tetap sebagai daftar bernomor, style ini tidak perlu untuk misi */
        .mission-list ol {
            margin-bottom: 0; /* Menghilangkan margin bawah default dari ol jika ada */
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
<br><br>
        <!-- Konten Visi Misi -->
        <div class="container-fluid">
            <h1>Detail Visi & Misi</h1>

            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Visi:</strong>
                        {{-- AWAL PERUBAHAN UNTUK VISI --}}
                        <div class="vision-paragraph-detail" style="margin-top: 5px;">
                            {!! nl2br(e($visiMisi->visi)) !!}
                        </div>
                        {{-- AKHIR PERUBAHAN UNTUK VISI --}}
                    </div>

                    <hr> {{-- Tambahkan pemisah jika diinginkan --}}

                    <div class="mb-3">
                        <strong>Misi:</strong>
                        {{-- Misi tetap menggunakan daftar bernomor seperti sebelumnya --}}
                        <div class="mission-list" style="margin-top: 5px;">
                            <ol style="list-style-type: decimal; padding-left: 20px; margin-bottom: 0;">
                                @php
                                    $misi = $visiMisi->misi;
                                    $misi = str_replace(["\r\n", "\r"], "\n", $misi);
                                    $misiLines = explode("\n", $misi);
                                @endphp
                                @foreach($misiLines as $misiLine)
                                    @php
                                        $misiLine = trim($misiLine);
                                    @endphp
                                    @if(!empty($misiLine))
                                        <li>{{ $misiLine }}</li>
                                    @endif
                                @endforeach
                            </ol>
                        </div>
                    </div>

                    <hr> {{-- Tambahkan pemisah jika diinginkan --}}

                    <a href="{{ route('admin.visi_misi.index') }}" class="btn btn-secondary mt-2">Back</a>
                </div>
            </div>
        </div>
        <!-- Akhir Konten Visi Misi -->

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
