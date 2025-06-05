@extends('layouts.app')

@section('title', 'Profile Alumni: ' . ($alumni->nama_cantik ?: $alumni->nama))
@section('description', 'Profile alumni ' . ($alumni->nama_cantik ?: $alumni->nama))
@section('keywords', 'alumni, profile, ' . ($alumni->nama_cantik ?: $alumni->nama) . ', himatif')

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
                                <div style="height: 100%; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                                    @if($alumni->gambar)
                                        <img src="{{ asset('storage/' . $alumni->gambar) }}" class="img-fluid rounded-start" alt="{{ $alumni->nama_cantik ?: $alumni->nama }}" style="object-fit: cover; width: 100%; height: 100%; border-radius: 20px 0 0 20px;">
                                    @else
                                        <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid rounded-start" alt="Default Image" style="object-fit: cover; width: 100%; height: 100%; border-radius: 20px 0 0 20px;">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body" style="padding: 30px; position: relative;">
                                    <h4 class="card-title" style="color: black; margin-bottom: 20px; font-size: 1.5rem;">
                                        <strong>{{ $alumni->nama ?: $alumni->nama_cantik }}</strong>
                                         @if($alumni->nama_cantik && $alumni->nama !== $alumni->nama_cantik)
                                            <small class="text-muted d-block" style="font-size: 0.9rem;">({{ $alumni->nama_cantik }})</small>
                                         @endif
                                    </h4>
                                    <p class="card-text" style="margin-bottom: 15px; color:#000000; font-size: 1rem;">
                                        @if($alumni->teaching_asisten)
                                            Status: Pernah menjadi Teaching Assistant
                                        @else
                                            Status: Alumni
                                        @endif
                                    </p>

                                    @if($alumni->angkatan)
                                        <p class="card-text mb-3" style="color:#000000; font-size: 1rem;">
                                             <strong class="detail-info-label">Angkatan:</strong>
                                             <span class="detail-info-value">{{ $alumni->angkatan }}</span>
                                        </p>
                                    @endif
                                <br><br><br><br><br><br>
                                    <div style="position: absolute; bottom: 30px; right: 30px;">
                                        <a href="{{ route('alumni.indexPublic') }}" class="btn btn-secondary">Back</a>
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