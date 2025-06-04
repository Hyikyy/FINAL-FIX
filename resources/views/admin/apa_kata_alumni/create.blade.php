<!doctype html>
<html lang="en">

<head>
    @include('admin.head')
    <title>Create Apa Kata Alumni</title>
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
          <!-- Konten Tambah Apa Kata Alumni -->
          <div class="container-fluid">
              <h1>Create Apa Kata Alumni</h1>

              {{-- Tampilkan error validasi jika ada --}}
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif

              <form action="{{ route('admin.apa_kata_alumni.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                      <label for="nama" class="form-label">Nama Alumni</label>
                      <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                  </div>

                  <div class="mb-3">
                      <label for="pekerjaan" class="form-label">Pekerjaan Saat Ini</label>
                      <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" required>
                  </div>

                  <div class="mb-3">
                      <label for="angkatan" class="form-label">Angkatan</label>
                      <input type="number" class="form-control" id="angkatan" name="angkatan" value="{{ old('angkatan') }}" placeholder="Contoh: 2018" required>
                  </div>

                  <div class="mb-3">
                      <label for="isi" class="form-label">Apa Kata Alumni (Testimoni)</label>
                      <textarea class="form-control" id="isi" name="isi" rows="5" required>{{ old('isi') }}</textarea>
                  </div>

                  <div class="mb-3">
                      <label for="gambar" class="form-label">Gambar Alumni (Opsional)</label>
                      <input type="file" class="form-control" id="gambar" name="gambar" onchange="previewImage()">
                      <img id="image-preview" src="#" alt="Preview Gambar" style="max-width: 200px; max-height: 200px; margin-top: 10px; display: none;"/>
                  </div>

                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{ route('admin.apa_kata_alumni.index') }}" class="btn btn-secondary">Cancel</a>
              </form>
          </div>
          <!-- Akhir Konten Tambah Apa Kata Alumni -->

      </div>
    </div>

    {{-- @include('admin.scripts') Atau daftar script individual seperti di index --}}

    <script>
        function previewImage() {
            const image = document.querySelector('#gambar');
            const imgPreview = document.querySelector('#image-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
</body>
</html>
