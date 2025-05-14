<!DOCTYPE html>
<html>
<head>
    <title>Edit Alumni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1>Edit Alumni</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.alumnis.update', $alumni->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $alumni->nama }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_cantik" class="form-label">Nama Cantik:</label>
            <input type="text" class="form-control" id="nama_cantik" name="nama_cantik" value="{{ $alumni->nama_cantik }}">
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar:</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
            @if ($alumni->gambar)
                <img src="{{ asset('storage/' . $alumni->gambar) }}" alt="{{ $alumni->nama }}" width="100" class="mt-2">
            @endif
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.alumnis.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>