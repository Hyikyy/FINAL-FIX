{{-- File: resources/views/public/teaching_assistants/show_detail_legacy.blade.php --}}
@extends('layouts.app')

@section('title', 'Profile Teaching Asisten: ' . $teachingAssistant->nama)

@push('styles')
<style>
    /* Tambahkan style berikut ke dalam file CSS Anda atau tag <style> */
    .image-container {
        height: 300px; /* Sesuaikan tinggi sesuai kebutuhan Anda */
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
        height: auto; /* Biarkan tinggi card menyesuaikan dengan konten */
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
                                    @if($teachingAssistant->gambar)
                                        <img src="{{ asset('storage/teaching_assistants/' . $teachingAssistant->gambar) }}" class="img-fluid rounded-start" alt="{{ $teachingAssistant->nama ?? 'Foto Asisten Dosen' }}">
                                    @else
                                        <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid rounded-start" alt="Default Image">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body" style="padding: 30px; position: relative;">
                                    @if($teachingAssistant->nama)
                                        <h4 class="card-title" style="color: black; margin-bottom: 20px; font-size: 1.5rem;">
                                            <strong>{{ $teachingAssistant->nama }}</strong>
                                        </h4>
                                    @endif

                                    <p class="card-text" style="margin-bottom: 15px; color:#000000; font-size: 1rem;">
                                        <strong>Jabatan:</strong> {{ $teachingAssistant->nama_jabatan ?? 'Tidak ada jabatan' }}
                                    </p>
                                    <p class="card-text" style="margin-bottom: 15px; color:#000000; font-size: 1rem;">
                                        <strong>Deskripsi:</strong>
                                        <div style="overflow-x: auto; white-space: normal;">
                                            {!! nl2br(e($teachingAssistant->deskripsi_jabatan ?? 'Tidak ada deskripsi.')) !!}
                                        </div>
                                    </p>
                                    <br><br><br>
                                    <div style="position: absolute; bottom: 30px; right: 30px;">
                                        <a href="{{ route('teaching_assistants.indexPublic') }}" class="btn btn-secondary">Back</a>
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