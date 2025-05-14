<!doctype html>
<html lang="en">

<head>
  @include('admin.head')
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
        <!-- Konten Struktur Organisasi -->
            <div class="container-fluid">
            <h1>Edit Struktur Organisasi</h1>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.struktur-organisasi.update', $strukturOrganisasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_anggota" class="form-label">Nama Anggota</label>
                            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" value="{{ $strukturOrganisasi->nama_anggota }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="{{ $strukturOrganisasi->nama_jabatan }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="periode" class="form-label">Periode</label>
                            <input type="text" class="form-control" id="periode" name="periode" value="{{ $strukturOrganisasi->periode }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar">
                            @if($strukturOrganisasi->gambar)
                                <img src="{{ asset('storage/struktur_organisasi/' . $strukturOrganisasi->gambar) }}" alt="{{ $strukturOrganisasi->nama_anggota }}" width="100">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_jabatan" class="form-label">Deskripsi Jabatan</label>
                            <textarea class="form-control" id="deskripsi_jabatan" name="deskripsi_jabatan" rows="3">{{ $strukturOrganisasi->deskripsi_jabatan }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.struktur-organisasi.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Konten Struktur Organisasi -->

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