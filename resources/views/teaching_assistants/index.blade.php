@extends('layouts.app')

@section('title', 'Daftar Teaching Asisten Himatif')
@section('description', 'Daftar lengkap Teaching Asisten yang mengajar Himatif.')
@section('keywords', 'Teaching, daftar Teaching Assistant, pengajar, asisten')

@section('content')

<style>
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
        padding-bottom: 100%;
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
        padding: 1.2rem;
    }

    .team .member .member-info h4 {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: #212529;
    }

    .team .member .member-info span {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .team .member .member-info p {
        font-size: 0.9rem;
        color: #495057;
        margin-bottom: 0.8rem;
    }

    @media (min-width: 992px) {
        .col-lg-4 {
            flex: 0 0 auto;
            width: 30%;
        }
    }
</style>

  <main id="main">

    <!-- ======= Asisten Dosen Section ======= -->
    <section id="AsistenDosen" class="team py-5" style="margin-top: 70px; margin-bottom: 10px;">
        <div class="container" data-aos="fade-up">
            <div class="section-header mb-5">
                <h2 class="fw-bold text-center" style="font-size: 2.5rem;">Teaching Assistant</h2>
                <p class="text-center lead" style="color:#495057;">Para asisten dosen yang membantu kelancaran kegiatan akademik.</p>
            </div>
            <div class="row justify-content-center">
                @forelse($teachingAssistants as $index => $teachingAssistant)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 col-12 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($index % 4 + 1) * 100 }}">
                        <div class="member h-100 w-100 d-flex flex-column shadow-sm rounded">
                            <div class="member-img w-100">
                                @if($teachingAssistant->gambar)
                                    <img src="{{ asset('storage/teaching_assistants/' . $teachingAssistant->gambar) }}" class="img-fluid w-100" alt="{{ $teachingAssistant->nama }}">
                                @else
                                    <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid w-100" alt="Default Image">
                                @endif
                            </div>
                            <div class="member-info p-3 d-flex flex-column flex-grow-1">
                                <h4 style="color: black;">{{ $teachingAssistant->nama }}</h4>
                                <span>{{ $teachingAssistant->nama_jabatan }}</span>
                                <p class="flex-grow-1">{{ Str::limit($teachingAssistant->deskripsi_jabatan, 75) }}</p>
                                <div class="member-action mt-auto">
                                    <a href="{{ route('teaching_assistants.showPublicDetail', $teachingAssistant->id) }}" class="btn btn-outline-dark">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center fst-italic">Belum ada data asisten dosen.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section><!-- End Asisten Dosen Section -->
</main><!-- End #main -->
@endsection