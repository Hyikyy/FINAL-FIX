{{-- File: resources/views/public/teaching_assistants/show_detail_legacy.blade.php (atau nama yang sesuai) --}}
@extends('layouts.app') {{-- Sesuaikan dengan layout Anda --}}

@section('title', 'Profile Teaching Asisten: ' . $teachingAssistant->nama)
{{-- Pastikan breadcrumbs diisi dengan benar --}}
@section('content')
<main id="main">

    <!-- ======= Detail Section ======= -->
    <section id="details" class="team" style="margin-top: 70px; margin-bottom: 10px;">
        <div class="container" data-aos="fade-up" style="margin-top: 70px; margin-bottom: 0px;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow" style="border: 1px solid #000;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div style="border-right: 1px solid #000; height: 100%; padding: 10px; display: flex; align-items: center; justify-content: center;">
                                   @if($teachingAssistant->gambar)
        {{-- INI CARA YANG BENAR BERDASARKAN OUTPUT DEBUGGING ANDA --}}
        <img src="{{ asset('storage/teaching_assistants/' . $teachingAssistant->gambar) }}" class="card-img rounded-left" alt="{{ $teachingAssistant->nama ?? 'Foto Asisten Dosen' }}" style="object-fit: cover; max-height: 100%; max-width: 100%;">
    @else
        <img src="{{ asset('assets/img/no-image.png') }}" class="card-img rounded-left" alt="Default Image" style="object-fit: cover; max-height: 100%; max-width: 100%;">
    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" style="padding: 20px; position: relative; min-height: 200px;">
                                    {{-- Tampilkan nama jika ada --}}
                                    @if($teachingAssistant->nama)
                                        <h4 class="card-title" style="color: black; margin-bottom: 15px;"><strong>{{ $teachingAssistant->nama }}</strong></h4>
                                    @endif

                                    <p class="card-text" style="margin-bottom: 10px; color:#000000">
                                        <strong>Jabatan:</strong> {{ $teachingAssistant->nama_jabatan ?? 'Tidak ada jabatan' }}
                                    </p>
                                    <p class="card-text" style="margin-bottom: 10px; color:#000000">
                                        <strong style="color:#000000">Deskripsi:</strong>
                                        <div style="overflow-x: auto; white-space: normal;">
                                            {!! nl2br(e($teachingAssistant->deskripsi_jabatan ?? 'Tidak ada deskripsi.')) !!}
                                        </div>
                                    </p>
                                    {{-- Field lain dari model TeachingAssistant bisa ditambahkan di sini --}}

                                    <div style="position: absolute; bottom: 20px; right: 20px;">
                                        {{-- Link kembali seharusnya ke daftar TA publik --}}
                                        <a href="{{ route('teaching_assistants.indexPublic') }}" class="btn btn-secondary">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Detail Section -->
</main>
@endsection
