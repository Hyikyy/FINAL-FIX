@extends('layouts.app')

@section('title', 'Dosen Pengajar HIMATIF')
@section('description', 'Dosen Pengajar HIMATIF')
@section('keywords', 'profile, dosen, pengajar, himatif')

@section('content')

<style>
    .team .member {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .team .member:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .team .member .member-action {
        margin-top: auto;
    }

    .team .member .member-action .btn {
        border-radius: 25px;
        padding: 10px 25px;
        font-size: 1rem;
        font-weight: 500;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        border: 2px solid #343a40;
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
        padding-bottom: 120%;
    }

    .team .member .member-img img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px 15px 0 0;
        transition: transform 0.3s ease;
        clip-path: ellipse(100% 100% at 50% 0%);
    }

    .team .member .member-img:hover img {
        transform: scale(1.05);
    }

    .team .member .member-info {
        padding: 1.5rem;
    }

    .team .member .member-info h4 {
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
        color: #212529;
    }

    .team .member .member-info span {
        font-size: 1rem;
        color: #6c757d;
    }

    .team .member .member-info p {
        font-size: 1rem;
        color: #495057;
        margin-bottom: 1rem;
    }
</style>

<main role="main">
    <!-- ======= Dosen Section ======= -->
    <section id="Dosen" class="team py-5" style="margin-top: 70px; margin-bottom: 10px;">
        <div class="container" data-aos="fade-up">

            <div class="section-header mb-5">
                <h2 class="text-center fw-bold" style="font-size: 2.5rem;">Dosen Pengajar HIMATIF</h2>
                <p class="text-center lead" style="color:#495057;">Kenali dosen-dosen berdedikasi yang membimbing HIMATIF.</p>
            </div>

            <div class="row justify-content-center">
                @foreach($dosens as $index => $dosen)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 col-12 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($index % 4 + 1) * 100 }}">
                        <div class="member h-100 w-100 d-flex flex-column shadow-sm rounded">
                            <div class="member-img w-100">
                                @if($dosen->gambar)
                                    <img src="{{ asset('storage/images/' . $dosen->gambar) }}" class="img-fluid w-100" alt="{{ $dosen->nama }}">
                                @else
                                    <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid w-100" alt="Default Image">
                                @endif
                            </div>
                            <div class="member-info p-3 d-flex flex-column flex-grow-1">
                                <h4 style="color: black;">{{ $dosen->nama }}</h4>
                                <span>{{ $dosen->nama_jabatan }}</span>
                                <p class="flex-grow-1">{{ Str::limit($dosen->deskripsi_jabatan, 75) }}</p>
                                <div class="member-action mt-auto">
                                    <a href="{{ route('dosen.showPublicDetail', $dosen->id) }}" class="btn btn-outline-dark">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Dosen Section -->
</main>

@endsection