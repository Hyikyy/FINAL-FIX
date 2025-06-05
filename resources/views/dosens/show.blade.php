@extends('layouts.app')

@section('title', 'Profil Dosen: ' . $dosen->nama)
@section('description', 'Profil dosen ' . $dosen->nama)
@section('keywords', 'dosen, profil, ' . $dosen->nama . ', himatif')

@push('styles')
    <style>
        .image-container {
            height: 300px; /* Sesuaikan tinggi sesuai kebutuhan */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }

        .image-container img {
            object-fit: cover;
            width: 100%;
            height: 100%;
            border-radius: 20px 0 0 20px;
        }

        .card {
            height: auto; /* Tinggi card menyesuaikan konten */
        }
    </style>
@endpush

@section('content')
<main id="main">

    <!-- ======= Detail Section ======= -->
    <section id="details" class="team py-5" style="margin-top: 120px; margin-bottom: 10px;">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow" style="border: 3px solid #000; border-radius: 20px; overflow: hidden;">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <div class="image-container">
                                    @if($dosen->gambar)
                                        <img src="{{ asset('storage/images/' . $dosen->gambar) }}" class="img-fluid rounded-start" alt="{{ $dosen->nama }}">
                                    @else
                                        <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid rounded-start" alt="Default Image">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body" style="padding: 30px; position: relative;">
                                    <h4 class="card-title" style="color: black; margin-bottom: 20px; font-size: 1.5rem;">
                                        <strong>{{ $dosen->nama }}</strong>
                                    </h4>
                                    <p class="card-text" style="margin-bottom: 15px; color:#000000; font-size: 1rem;">
                                        <strong>Jabatan:</strong> {{ $dosen->nama_jabatan ?? 'Tidak ada jabatan' }}
                                    </p>
                                    <p class="card-text" style="margin-bottom: 15px; color:#000000; font-size: 1rem;">
                                        <strong>Deskripsi:</strong>
                                        <div style="overflow-x: auto; white-space: normal;">
                                            {!! nl2br(e($dosen->deskripsi_jabatan ?? 'Tidak ada deskripsi.')) !!}
                                        </div>
                                    </p>

                                    <div style="position: absolute; bottom: 30px; right: 30px;">
                                        <a href="{{ route('dosen.showPublic') }}" class="btn btn-secondary">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Detail Section -->
</main><!-- End #main -->
@endsection