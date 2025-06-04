<!doctype html>
<html lang="en">

<head>
  @include('admin.head')
  <title>Agenda List</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

      <!--  App Topstrip - DIHAPUS -->
    <!-- Sidebar Start -->
    @include('admin.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class  ="body-wrapper">
      <!--  Header Start -->
      @include('admin.header')
      <!--  Header End -->
<br><br>
        <!-- Konten Agenda -->
        <div class="container-fluid">
            <h1>Agendas List</h1>

            <a href="{{ route('admin.agendas.create') }}" class="btn btn-primary mb-3">Create Agenda</a>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agendas as $agenda)
                            <tr>
                                <td>{{ $agenda->nama_kegiatan }}</td>
                                <td>{{ $agenda->tanggal_kegiatan }}</td>
                                <td>{{ $agenda->deskripsi }}</td>
                                <td class="action-buttons">
                                    <a href="{{ route('agendas.index', $agenda->id) }}" class="btn btn-sm btn-info">See</a>
                                    <a href="{{ route('admin.agendas.edit', $agenda->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.agendas.destroy', $agenda->id) }}" method="POST" style="display: inline-block;">
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
        <!-- Akhir Konten Agenda -->

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
