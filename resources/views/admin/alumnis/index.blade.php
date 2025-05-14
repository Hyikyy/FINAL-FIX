<!doctype html>
<html lang="en">

<head>
  @include('admin.head')
  <title>Daftar Alumni</title>
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

      <div class="container-fluid">
        <!-- Konten Alumni -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Daftar Alumni</h5>
            <a href="{{ route('admin.alumnis.create') }}" class="btn btn-primary mb-3">Tambah Alumni</a>

            @if ($message = Session::get('success'))
              <div class="alert alert-success">
                <p>{{ $message }}</p>
              </div>
            @endif

            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nama Cantik</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($alumnis as $alumni)
                    <tr>  
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $alumni->nama }}</td>
                      <td>{{ $alumni->nama_cantik }}</td>
                      <td>
                        @if ($alumni->gambar)
                          <img src="{{ asset('storage/' . $alumni->gambar) }}" alt="{{ $alumni->nama }}" width="100">
                        @else
                          Tidak ada gambar
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('admin.alumnis.show', $alumni->id) }}" class="btn btn-sm btn-info">Lihat</a>
                        <a href="{{ route('admin.alumnis.edit', $alumni->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.alumnis.destroy', $alumni->id) }}" method="POST" style="display: inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- Akhir Konten Alumni -->
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