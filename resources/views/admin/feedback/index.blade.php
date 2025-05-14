<!doctype html>
<html lang="en">

<head>
  @include('admin.head')
  <title>Daftar Feedback</title>
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
        <!-- Konten Feedback -->
        <div class="container-fluid">
            <h1>Daftar Feedback</h1>

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
                            <th>Isi</th>
                            <th>Berita</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->nama }}</td>
                                <td>{{ $feedback->tanggal }}</td>
                                <td>{{ $feedback->isi }}</td>
                                <td>{{ $feedback->berita->judul }}</td>
                                <td>
                                    <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus feedback ini?')">Hapus</button>
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