@extends('layouts.app')

@section('title', 'Profile Alumni: ' . ($alumni->nama_cantik ?: $alumni->nama))
@section('description', 'Profile alumni ' . ($alumni->nama_cantik ?: $alumni->nama))
@section('keywords', 'alumni, profile, ' . ($alumni->nama_cantik ?: $alumni->nama) . ', himatif')

@section('content')
<main id="main">

    <!-- ======= Detail Section ======= -->
    <section id="details" class="team" style="margin-top: 50px; margin-bottom: 10px;">
        <div class="container" data-aos="fade-up" style="margin-top: 90px; margin-bottom: 0px;">
            <div class="row justify-content-center" >
                <div class="col-md-8">
                    <div class="card shadow" style="border: 1px solid #000;">
                        <div class="row no-gutters"> {{-- g-0 di Bootstrap 5 --}}
                            <div class="col-md-4">
                                <div style="border-right: 1px solid #000; height: 100%; padding: 10px; display: flex; align-items: center; justify-content: center;">
                                    @if($alumni->gambar)
                                        {{-- Asumsi field 'gambar' di model Alumni berisi path relatif dari 'storage/app/public/' saja --}}
                                        {{-- Sesuaikan jika path berbeda, misal 'storage/alumni_fotos/' --}}
                                        <img src="{{ asset('storage/' . $alumni->gambar) }}" class="card-img rounded-left" alt="{{ $alumni->nama_cantik ?: $alumni->nama }}" style="object-fit: cover; max-height: 100%; max-width: 100%;">
                                    @else
                                        <img src="{{ asset('assets/img/no-image.png') }}" class="card-img rounded-left" alt="Default Image" style="object-fit: cover; max-height: 100%; max-width: 100%;">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" style="padding: 20px; position: relative;">
                                    <h4 class="card-title" style="color: black; margin-bottom: 15px;">
                                        <strong>{{ $alumni->nama ?: $alumni->nama_cantik   }}</strong>
                                         @if($alumni->nama_cantik && $alumni->nama !== $alumni->nama_cantik)
                                            <small class="text-muted d-block">({{ $alumni->nama_cantik }})</small>
                                         @endif
                                    </h4>
                                    <p class="card-text" style="margin-bottom: 10px; color:#000000">
                                        {{-- Untuk Alumni, kita tidak menampilkan "Jabatan" dari model lama, tapi nama cantik --}}
                                        {{-- Jika Anda ingin menampilkan info lain dari model alumni (misal 'teaching_asisten'), tambahkan di sini --}}
                                        @if($alumni->teaching_asisten)
                                            Status: Pernah menjadi Teaching Assistant
                                        @else
                                            {{-- Bisa kosong atau info lain yang relevan untuk alumni berdasarkan model Anda --}}
                                            Status: Alumni
                                        @endif
                                    </p>

                                    @if($alumni->angkatan)
                                        <p class="card-text mb-2" style="color:#000000;">
                                             <strong class="detail-info-label">Angkatan:</strong>
                                             <span class="detail-info-value">{{ $alumni->angkatan }}</span>
                                        </p>
                                    @endif
                                    {{-- Untuk Alumni, kita tidak menampilkan "Deskripsi Jabatan" dari model lama --}}
                                    {{-- Jika Anda punya field deskripsi untuk Alumni di modelnya, tampilkan di sini --}}

                                    {{-- Cek apakah model Alumni punya field 'email' dan 'bidang_keahlian' --}}
                                    {{-- Berdasarkan model Alumni Anda, field ini tidak ada. --}}
                                    {{-- @if(isset($alumni->email))
                                        <p class="card-text" style="margin-bottom: 10px; color:#000000"><strong>Email:</strong> {{ $alumni->email }}</p>
                                    @endif

                                    @if(isset($alumni->bidang_keahlian))
                                        <p class="card-text" style="margin-bottom: 10px;color:#000000"><strong>Bidang Keahlian:</strong> {{ $alumni->bidang_keahlian }}</p>
                                    @endif --}}
                                    <br><br><br>
                                    <div style="position: absolute; bottom: 20px; right: 20px;">
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
