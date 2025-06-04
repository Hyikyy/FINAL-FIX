<!doctype html>
<html lang="en">

<head>
  @include('admin.head')
  <title>Daftar Feedback</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> {{-- Tambahkan Font Awesome jika belum ada global --}}
  <style>
    /* Styling untuk tombol aksi agar sebaris dan rapi */
    .action-buttons .btn,
    .action-buttons form {
        display: inline-block; /* Membuat form juga inline */
        margin-right: 5px;   /* Jarak antar tombol/form */
        margin-bottom: 5px;  /* Jarak jika tombol wrap ke baris baru di layar kecil */
        vertical-align: middle; /* Menyamakan alignment vertikal tombol */
    }

    /* Menghilangkan margin kanan pada elemen terakhir */
    .action-buttons .btn:last-child,
    .action-buttons form:last-child {
        margin-right: 0;
    }

    /* Opsional: Jika ingin tombol memiliki lebar minimum agar lebih seragam */
    /*
    .action-buttons .btn {
        min-width: 70px;
        text-align: center;
    }
    */
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
        <!-- Konten Feedback -->
        <div class="container-fluid">
            <h1>Feedback List</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Isi Feedback</th>
                            <th>Terkait Berita</th> {{-- Judul kolom diubah sedikit --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->nama }}</td>
                                <td>
                                    {{-- Format tanggal jika diperlukan, contoh: --}}
                                    {{ \Carbon\Carbon::parse($feedback->tanggal)->translatedFormat('d M Y H:i') }}
                                </td>
                                <td>{{ Str::limit($feedback->isi, 100) }}</td> {{-- Batasi panjang isi feedback di tabel --}}
                                <td>
                                    @if ($feedback->berita) {{-- Pastikan berita ada --}}
                                        {{ $feedback->berita->judul }}
                                    @else
                                        <span class="text-muted">Tidak terkait berita</span>
                                    @endif
                                </td>
                                <td class="action-buttons">
                                    {{-- AWAL TOMBOL BARU --}}
                                    @if ($feedback->berita) {{-- Hanya tampilkan tombol jika feedback terkait dengan berita --}}
                                        {{-- Ganti 'admin.berita.show' dengan nama route Anda untuk detail berita admin --}}
                                        {{-- Pastikan route tersebut menerima ID berita sebagai parameter --}}
                                        <a href="{{ route('admin.beritas.show', $feedback->berita->id) }}" class="btn btn-sm btn-info" title="Lihat Berita Terkait">
                                        See
                                        </a>
                                    @endif
                                    {{-- AKHIR TOMBOL BARU --}}

                                    <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Feedback" onclick="return confirm('Apakah Anda yakin ingin menghapus feedback ini?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Akhir Konten Feedback -->

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
