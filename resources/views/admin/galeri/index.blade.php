<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin.head')
    <title>Manajemen Item Galeri - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #f8f9fc; }
        .page-wrapper { display: flex; min-height: 100vh; }
        .body-wrapper { flex-grow: 1; display: flex; flex-direction: column; }
        .container-fluid { padding-top: 1.5rem; padding-bottom: 1.5rem; }
        .card { border: 0; margin-bottom: 1.5rem; }
        .card-header { background-color: #fff; border-bottom: 1px solid #e3e6f0; padding: .75rem 1.25rem; }
        .text-gray-800 { color: #5a5c69 !important; }
        .font-weight-bold { font-weight: 700 !important; }
        .text-primary { color: #4e73df !important; }
        .shadow-sm { box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important; }
        .btn-icon-split .icon { background: rgba(0,0,0,0.15); display: inline-block; padding: .375rem .75rem; }
        .btn-icon-split .text { padding: .375rem .75rem; display: inline-block; }
        .table th, .table td { vertical-align: middle; }
        .img-thumbnail-custom { width: 100px; height: 75px; object-fit: cover; }

    /* Styling untuk tombol aksi agar sebaris dan rapi */
    .action-buttons .btn,
    .action-buttons form {
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 5px;
        vertical-align: middle;
    }

    .action-buttons .btn:last-child,
    .action-buttons form:last-child {
        margin-right: 0;
    }
    </style>
</head>
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        @include('admin.sidebar')
        <div class="body-wrapper">
            @include('admin.header')
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1>Gallery Item Management</h1>
                    <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary btn-icon-split btn-sm shadow-sm">
                        <span class="text">Create Item Galeri</span>
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header">Filter Galeri</div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.galeri.index') }}" class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="search" class="form-label">Cari Judul:</label>
                                <input type="text" name="search" id="search" class="form-control form-control-sm" value="{{ request('search') }}" placeholder="Masukkan judul...">
                            </div>
                            <div class="col-md-4">
                                <label for="kategori_filter" class="form-label">Kategori:</label>
                                <select name="kategori_filter" id="kategori_filter" class="form-select form-select-sm">
                                    <option value="">Semua Kategori</option>
                                    @if(isset($kategoris))
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}" {{ request('kategori_filter') == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info btn-sm w-100"><i class="fas fa-filter"></i> Filter</button>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary btn-sm w-100" title="Reset Filter">
                                    <i class="fas fa-sync-alt"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Item Gallery List</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTableGaleri" width="100%" cellspacing="0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Oleh</th>
                                        <th>Tgl Upload</th>
                                        <th class="text-center" style="width: 18%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($galeris as $index => $item)
                                        <tr>
                                            <td>{{ $galeris->firstItem() + $index }}</td>
                                            <td>
                                                @if($item->gambar)
                                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="img-thumbnail-custom">
                                                @else
                                                    <span class="text-muted">Tanpa Gambar</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->kategoriGaleri->nama_kategori ?? 'Tidak Berkategori' }}</td>
                                            <td>{{ $item->user->name ?? 'N/A' }}</td>
                                            <td>{{ $item->created_at->translatedFormat('d M Y H:i') }}</td>
                                            <td class="action-buttons">
                                                <a href="{{ route('admin.galeri.show', $item->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">See</a>
                                                <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">Edit</a>
                                                <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item galeri \'{{ $item->judul }}\'?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada item galeri.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination Links --}}
                        @if(isset($galeris) && $galeris->hasPages())
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $galeris->appends(request()->query())->links('vendor.pagination.gallery') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <footer class="footer text-center py-3 bg-light mt-auto">
                <div class="container-fluid"><span class="text-muted">Hak Cipta © {{ date('Y') }} HIMATIF.</span></div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    @if(file_exists(public_path('admin/assets/js/sidebarmenu.js'))) <script src="{{ asset('admin/assets/js/sidebarmenu.js') }}"></script> @endif
    @if(file_exists(public_path('admin/assets/js/app.min.js'))) <script src="{{ asset('admin/assets/js/app.min.js') }}"></script> @endif
</body>
</html>