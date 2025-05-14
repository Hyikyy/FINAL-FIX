<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Galeri</title>
    <!-- Tambahkan CSS Anda di sini -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Detail Galeri</h1>
        <table class="table">
            <tr>
                <th>Judul</th>
                <td>{{ $galeri->judul }}</td>
            </tr>
            <tr>
                <th>Gambar</th>
                <td><img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}" width="200"></td>
            </tr>
        </table>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>