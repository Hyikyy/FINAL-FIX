<!DOCTYPE html>
<html>
<head>
    <title>Tambah Asisten Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1>Tambah Asisten Dosen</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.teaching_assistants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_jabatan" class="form-label">Nama Jabatan:</label>
            <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan') }}" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar:</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
        </div>

        <div class="mb-3">
            <label for="deskripsi_jabatan" class="form-label">Deskripsi Jabatan:</label>
            <textarea class="form-control" id="deskripsi_jabatan" name="deskripsi_jabatan" rows="3" required>{{ old('deskripsi_jabatan') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.teaching_assistants.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>