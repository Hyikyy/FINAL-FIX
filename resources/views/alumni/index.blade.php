@extends('layouts.app')

@section('title', 'Daftar Alumni HIMATIF | Website Kami')
@section('description', 'Daftar lengkap alumni berprestasi dari HIMATIF.')
@section('keywords', 'alumni, daftar alumni, himatif, lulusan')

@push('styles')
<style>
    :root {
        --filter-text-color-default: #555555;
        --filter-text-color-hover: #008374;
        --filter-text-color-active: #008374;
    }

    .alumni-filter-section {
        margin-bottom: 35px;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .alumni-filter-nav {
        text-align: center;
    }

    .alumni-filter-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: inline-flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 5px 20px;
        border-bottom: 0px solid #e0e0e0;
        padding-bottom: 10px;
    }

    .alumni-filter-nav ul li a {
        display: inline-block;
        padding: 8px 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--filter-text-color-default);
        background-color: transparent;
        border: none;
        border-radius: 0;
        transition: color 0.25s ease;
        position: relative;
        outline: none;
    }

    .alumni-filter-nav ul li a:hover {
        color: var(--filter-text-color-hover);
    }

    .alumni-filter-nav ul li a.active {
        color: var(--filter-text-color-active);
        font-weight: 700;
    }

    .alumni-filter-nav ul li a.active::after {
        content: "";
        position: absolute;
        display: block;
        width: 80%;
        height: 2.5px;
        background: var(--filter-text-color-active);
        bottom: -10px;
        left: 10%;
        border-radius: 1px;
    }

    .team .member {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .team .member:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .team .member .member-action {
        margin-top: auto;
    }

    .team .member .member-action .btn {
        border-radius: 20px;
        padding: 8px 20px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        border: 1.5px solid #343a40;
        color: #343a40;
    }

    .team .member .member-action .btn:hover {
        background-color: #343a40;
        color: #ffffff !important;
        border-color: #343a40;
    }

    .team .member .member-img {
        position: relative;
        overflow: hidden;
        padding-bottom: 90%;
    }

    .team .member .member-img img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px 12px 0 0;
        transition: transform 0.3s ease;
        clip-path: ellipse(100% 100% at 50% 0%);
    }

    .team .member .member-img:hover img {
        transform: scale(1.03);
    }

    .team .member .member-info {
        padding: 1rem;
    }

    .team .member .member-info h4 {
        font-size: 1rem;
        margin-bottom: 0.4rem;
        color: #212529;
    }

    .team .member .member-info span {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .team .member .member-info p {
        font-size: 0.8rem;
        color: #495057;
        margin-bottom: 0.6rem;
    }

    @media (min-width: 992px) {
        .col-xl-3 {
            flex: 0 0 auto;
            width: 22%;
        }
    }
</style>
@endpush

@section('content')

  <main id="main">

    <section id="Alumni" class="team py-5" style="margin-top: 70px; margin-bottom: 10px;">
      <div class="container" data-aos="fade-up">

        <div class="section-header mb-4">
          <h2 class="text-center fw-bold" style="margin-top: 50px; margin-bottom: 10px;">Alumni HIMATIF</h2>
          <p class="text-center" style="color:#000000">
            Alumni-alumni berprestasi dari HIMATIF.
            @if($selectedAngkatan)
                <br>Menampilkan Angkatan: <strong>{{ $selectedAngkatan }}</strong>
            @endif
          </p>
        </div>

        @if(isset($angkatans) && $angkatans->count() > 0)
        <div class="row">
            <div class="col-lg-12">
                <nav class="alumni-filter-nav">
                    <ul>
                        <li>
                            <a href="{{ route('alumni.indexPublic') }}" class="{{ !$selectedAngkatan ? 'active' : '' }}">All</a>
                        </li>
                        @foreach($angkatans as $angkatan_th)
                            <li>
                                <a href="{{ route('alumni.indexPublic', ['angkatan' => $angkatan_th]) }}" class="{{ $selectedAngkatan == $angkatan_th ? 'active' : '' }}">
                                    {{ $angkatan_th }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
        @endif

        <br>
        <br>

        @if($alumnis->count() > 0)
            <div class="row justify-content-center">
            @foreach($alumnis as $index => $alumni)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 col-12 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($index % 4 + 1) * 100 }}">
                    <div class="member h-100 w-100 d-flex flex-column shadow-sm rounded">
                        <div class="member-img w-100">
                            @if($alumni->gambar)
                                <img src="{{ asset('storage/' . $alumni->gambar) }}" class="img-fluid w-100" alt="{{ $alumni->nama }}">
                            @else
                                <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid w-100" alt="Default Image">
                            @endif
                        </div>
                        <div class="member-info p-3 d-flex flex-column flex-grow-1">
                            <h4 style="color: black;">{{ $alumni->nama }}</h4>
                            <span>
                                @if($alumni->nama_cantik) {{ $alumni->nama_cantik }} <br> @endif
                                @if($alumni->angkatan) Angkatan {{ $alumni->angkatan }} @endif
                            </span>
                            @if($alumni->deskripsi_jabatan || $alumni->deskripsi)
                                <p class="flex-grow-1">{{ Str::limit($alumni->deskripsi_jabatan ?? $alumni->deskripsi, 60) }}</p>
                            @endif
                            <div class="member-action mt-auto">
                                <a href="{{ route('alumni.showPublicDetail', $alumni->id) }}" class="btn btn-outline-dark">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

            @if ($alumnis->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $alumnis->links() }}
                </div>
            @endif
        @else
            <div class="row">
                <div class="col text-center py-5">
                    <p class="lead text-muted">
                        Tidak ada data alumni
                        @if($selectedAngkatan)
                            untuk angkatan <strong>{{ $selectedAngkatan }}</strong>
                        @endif.
                    </p>
                    @if(!$selectedAngkatan && (!isset($angkatans) || $angkatans->count() == 0))
                        <p class="text-muted"><small>Belum ada data angkatan yang bisa difilter.</small></p>
                    @endif
                </div>
            </div>
        @endif

      </div>
    </section><!-- End Alumni Section -->
</main><!-- End #main -->
@endsection

@push('scripts')
<script>
</script>
@endpush