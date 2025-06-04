<!doctype html>
<html lang="en">

<head>
  @include('admin.head')

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

    <!-- Sidebar Start -->
    @include('admin.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('admin.header')
      <!--  Header End -->
<br><br>
        <!-- Konten Asisten Dosen -->
        <div class="container-fluid">
            <h1>Asisten Dosen List</h1>

            <a href="{{ route('admin.teaching_assistants.create') }}" class="btn btn-primary mb-3">Create Asisten Dosen</a>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachingAssistants as $teachingAssistant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $teachingAssistant->nama }}</td>
                                <td>{{ $teachingAssistant->nama_jabatan }}</td>
                                <td>
                                    @if($teachingAssistant->gambar)
                                        <img src="{{ asset('storage/teaching_assistants/' . $teachingAssistant->gambar) }}" alt="{{ $teachingAssistant->nama }}" width="50">
                                    @else
                                        Tidak ada gambar
                                    @endif
                                </td>
                                <td class="action-buttons">
                                    <a href="{{ route('teaching_assistants.indexPublic', $teachingAssistant->id) }}" class="btn btn-sm btn-info">See</a>
                                    <a href="{{ route('admin.teaching_assistants.edit', $teachingAssistant->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.teaching_assistants.destroy', $teachingAssistant->id) }}" method="POST" style="display: inline-block;">
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
        <!-- Akhir Konten Asisten Dosen -->

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
