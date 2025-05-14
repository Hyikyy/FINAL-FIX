<!doctype html>
<html lang="en">

<head>
    @include('admin.head')
    <title>Daftar Keuangan</title>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
      data-sidebar-position="fixed" data-header-position="fixed">

      <!--  App Topstrip -->
      <div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
          </a>

          <div class="d-none d-xl-flex align-items-center gap-3">
              <i class="ti ti-lifebuoy fs-5"></i>
            </a>
              <i class="ti ti-gift fs-5"></i>
            </a>
          </div>
        </div>

        <div class="d-lg-flex align-items-center gap-2">
          <div class="d-flex align-items-center justify-content-center gap-2">
            <div class="dropdown d-flex">
                data-bs-toggle="dropdown" aria-expanded="false">
              </a>
              <div class="-" aria-labelledby="drop3">
                <div class="message-body">
                  <a target="_blank"
                    class="dropdown-item d-flex align-items-center gap-1">
                  </a>
                  </a>
                </div>
              </div>
            </div>
            <div class="dropdown d-flex">
              <a class="-" href="javascript:void(0)" id="drop4"
                data-bs-toggle="dropdown" aria-expanded="false">
              </a>
              <div class="-" aria-labelledby="drop4">
                <div class="message-body">
                  <a target="_blank"
                    class="dropdown-item d-flex align-items-center gap-1">

                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Sidebar Start -->
      @include('admin.sidebar')
      <!--  Sidebar End -->
      <!--  Main wrapper -->
      <div class="body-wrapper">
        <!--  Header Start -->
        @include('admin.header')
        <!--  Header End -->
  <br><br>
          <!-- Konten Keuangan -->
          <div class="container-fluid">
              <h1>Daftar Keuangan</h1>

              <a href="{{ route('admin.keuangan.create') }}" class="btn btn-primary mb-3">Tambah Data Keuangan</a>

              @if(session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif

              <div class="table-responsive">
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th>Pemasukan</th>
                              <th>Pengeluaran</th>
                              <th>Saldo</th>
                              <th>Laporan</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($keuangan as $data)
                              <tr>
                                  <td>{{ number_format($data->pemasukan, 2, ',', '.') }}</td>
                                  <td>{{ number_format($data->pengeluaran, 2, ',', '.') }}</td>
                                  <td>{{ number_format($data->saldo, 2, ',', '.') }}</td>
                                  <td>{{ $data->laporan }}</td>
                                  <td>
                                      <a href="{{ route('admin.keuangan.show', $data->id) }}" class="btn btn-sm btn-info">Lihat</a>
                                      <a href="{{ route('admin.keuangan.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                      <form action="{{ route('admin.keuangan.destroy', $data->id) }}" method="POST" style="display: inline-block;">
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
          <!-- Akhir Konten Keuangan -->

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