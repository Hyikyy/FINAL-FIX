@extends('layouts.app') {{-- Sesuaikan layout Anda --}}

@section('title', 'Profil Dosen: ' . $dosen->nama)
@section('description', 'Profil dosen ' . $dosen->nama)
@section('keywords', 'dosen, profil, ' . $dosen->nama . ', himatif')

@section('content')
<main id="main">
    <!-- ======= Detail Section ======= -->
    <section id="details" class="team" style="margin-top: 70px; margin-bottom: 10px;">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow" style="border: 1px solid #000;">
                        <div class="row no-gutters"> {{-- g-0 di Bootstrap 5 untuk no-gutters --}}
                            <div class="col-md-4">
                                <div style="border-right: 1px solid #000; height: 100%; padding: 10px; display: flex; align-items: center; justify-content: center;">
                                    @if($dosen->gambar)
                                        {{-- Asumsi field 'gambar' di model Dosen berisi path relatif dari 'storage/app/public/images/' --}}
                                        {{-- Jika tidak, sesuaikan pathnya. Jika $dosen->gambar sudah 'images/namafile.jpg', ini benar --}}
                                        <img src="{{ asset('storage/images/' . $dosen->gambar) }}" class="card-img rounded-left" alt="{{ $dosen->nama }}" style="object-fit: cover; max-height: 100%; max-width: 100%;">
                                    @else
                                        <img src="{{ asset('assets/img/no-image.png') }}" class="card-img rounded-left" alt="Default Image" style="object-fit: cover; max-height: 100%; max-width: 100%;">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" style="padding: 20px; position: relative;">
                                    <h4 class="card-title" style="color: black; margin-bottom: 15px;"><strong>{{ $dosen->nama }}</strong></h4>
                                    <p class="card-text" style="margin-bottom: 10px; color:#000000">
                                        <strong>Jabatan:</strong> {{ $dosen->nama_jabatan ?? 'Tidak ada jabatan' }}
                                    </p>
                                    <p class="card-text" style="margin-bottom: 10px; color:#000000">
                                        <strong style="color:#000000">Deskripsi:</strong>
                                        <div style="overflow-x: auto; white-space: normal;">
                                            {!! nl2br(e($dosen->deskripsi_jabatan ?? 'Tidak ada deskripsi.')) !!}
                                        </div>
                                    </p>
                                    {{-- Field 'email' dan 'bidang_keahlian' TIDAK ADA di model Dosen Anda saat ini ($fillable). --}}
                                    {{-- Jika Anda ingin menampilkannya, Anda harus: --}}
                                    {{-- 1. Tambahkan kolom ke tabel 'dosens'. --}}
                                    {{-- 2. Tambahkan field ke $fillable di model Dosen.php. --}}
                                    {{-- 3. Pastikan admin bisa menginputnya. --}}
                                    {{-- 4. Baru uncomment dan gunakan di sini. --}}
                                    {{--
                                    @if(isset($dosen->email_kontak)) // Misalkan Anda menamainya email_kontak
                                        <p class="card-text" style="margin-bottom: 10px; color:#000000"><strong>Email:</strong> {{ $dosen->email_kontak }}</p>
                                    @endif

                                    @if(isset($dosen->bidang_keahlian_dosen)) // Misalkan Anda menamainya bidang_keahlian_dosen
                                        <p class="card-text" style="margin-bottom: 10px;color:#000000"><strong>Bidang Keahlian:</strong> {{ $dosen->bidang_keahlian_dosen }}</p>
                                    @endif
                                    --}}
                                    <div style="height: 60px;"></div> {{-- Memberi ruang agar tombol kembali tidak menimpa teks jika konten sedikit --}}
                                    <div style="position: absolute; bottom: 20px; right: 20px;">
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
