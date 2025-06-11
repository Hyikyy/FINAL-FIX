<!doctype html>
<html lang="en">

<head>
  @include('admin.head')
  <title>Edit Gambar Berita</title>
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
        <!-- Konten Gambar Berita -->
        <div class="container-fluid">
            <h1>Edit Gambar Berita</h1>

            {{-- MENAMPILKAN ERROR VALIDASI GLOBAL --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops! Ada beberapa masalah dengan input Anda:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.berita_images.update', $beritaImage->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="berita_id" class="form-label">Berita</label>
                            <select class="form-control @error('berita_id') is-invalid @enderror" id="berita_id" name="berita_id" required>
                                <option value="">Pilih Berita</option>
                                @foreach($beritas as $berita)
                                    <option value="{{ $berita->id }}" {{ old('berita_id', $beritaImage->berita_id) == $berita->id ? 'selected' : '' }}>
                                        {{ $berita->judul }}
                                    </option>
                                @endforeach
                            </select>
                            @error('berita_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image_path" class="form-label">Gambar</label>
                            <input type="file" class="form-control @error('image_path') is-invalid @enderror" id="image_path" name="image_path">
                            @if($beritaImage->image_path && !$errors->has('image_path')) {{-- Hanya tampilkan gambar lama jika tidak ada error upload baru --}}
                                <div class="mt-2">
                                    <p class="mb-1">Gambar saat ini:</p>
                                    <img src="{{ asset('storage/' . $beritaImage->image_path) }}" alt="Gambar Berita" width="150" class="img-thumbnail">
                                </div>
                            @endif
                            @error('image_path')
                                <div class="invalid-feedback d-block">{{ $message }}</div> {{-- d-block agar tampil untuk input file --}}
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan', $beritaImage->keterangan) }}">
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.berita_images.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Konten Gambar Berita -->

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