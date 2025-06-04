<!doctype html>
<html lang="en">

<head>
  @include('admin.head')
  <style>
    /* Tambahan style untuk paragraf visi agar lebih rapi */
    .vision-paragraph p {
        margin-bottom: 0.5em; /* Spasi antar paragraf jika visi terdiri dari beberapa paragraf */
        line-height: 1.6; /* Keterbacaan yang lebih baik */
    }
    .vision-paragraph p:last-child {
        margin-bottom: 0;
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
            <h1>Vision And Mission</h1>

            <a href="{{ route('admin.visi_misi.create') }}" class="btn btn-primary mb-3">Create Vision and Mission</a>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Visi</th>
                            <th>Misi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visiMisi as $item)
                            <tr>
                                <td>
                                    {{-- AWAL PERUBAHAN UNTUK VISI --}}
                                    <div class="vision-paragraph">
                                        @php
                                            // Mengganti baris baru (newline) dalam teks visi menjadi tag <br>
                                            // atau memprosesnya sebagai paragraf terpisah jika ada dua newline.
                                            // Opsi 1: Mengganti setiap newline menjadi <br> untuk menjaga pemformatan baris
                                            // $formattedVisi = nl2br(e($item->visi));

                                            // Opsi 2: Memecah berdasarkan dua newline untuk membuat paragraf terpisah,
                                            // kemudian setiap baris dalam paragraf itu bisa di-join atau nl2br juga.
                                            // Ini lebih kompleks tapi bisa lebih baik jika visi Anda memang punya struktur paragraf.
                                            // Untuk kesederhanaan, kita gunakan nl2br dulu.
                                        @endphp
                                        {{-- Menampilkan visi sebagai HTML yang sudah diformat dengan <br> --}}
                                        {!! nl2br(e($item->visi)) !!}
                                    </div>
                                    {{-- AKHIR PERUBAHAN UNTUK VISI --}}
                                </td>
                                <td>
                                    <ol style="list-style-type: decimal; padding-left: 20px;">
                                        @php
                                            $misi = $item->misi;
                                            // Normalisasi newline untuk konsistensi
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
                                </td>
                                <td>
                                    <a href="{{ route('visi_misi.public', $item->id) }}" class="btn btn-sm btn-info">See</a>
                                    <a href="{{ route('admin.visi_misi.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.visi_misi.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
