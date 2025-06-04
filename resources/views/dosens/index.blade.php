@extends('layouts.app')

@section('title', 'Dosen Pengajar HIMATIF')
@section('description', 'Dosen Pengajar HIMATIF')
@section('keywords', 'profile, dosen, pengajar, himatif')

@section('content')

<style>
    .team .member .member-action { /* Wrapper Tombol */
    /* Kunci agar tombol selalu di paling bawah: */
    margin-top: auto;
    /* Pastikan tidak ada padding atau margin bawah pada .member-content
       yang bisa membuat ruang ekstra di bawah tombol jika .member-action tidak punya background.
       Padding pada .member (card utama) sudah cukup. */
}

.team .member .member-action .btn {
    border-radius: 20px;
    padding: 8px 25px;
    font-size: 0.85rem;
    font-weight: 500;
    /* Biarkan style default btn-outline-dark, atau sesuaikan: */
    /* border: 1px solid #ccc; */
    /* color: #333; */
    text-decoration: none;
    display: inline-block;
    text-align: center;
    transition: background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease;
}

.team .member .member-action .btn:hover {
        background-color: #000000; /* Warna background menjadi GELAP (misalnya, abu-abu gelap Bootstrap) */
                                   /* Anda bisa ganti dengan #212529 (lebih gelap), atau #000000 (hitam pekat) */
        color: #ffffff !important;            /* Warna font menjadi PUTIH */
        border-color: #343a40;     /* Warna border juga menjadi GELAP, sesuaikan dengan background-color */
                                   /* Ganti juga jika background-color di atas diubah */
    }

</style>


<main role="main">

<!-- ======= Dosen Section ======= -->
    <section id="Dosen" class="team py-5" style="margin-top: 70px; margin-bottom: 10px;">
      <div class="container" data-aos="fade-up">

        <div class="section-header mb-4" style="margin-top: 70px; margin-bottom: 10px;">
          <h2 class="text-center fw-bold">Dosen Pengajar HIMATIF</h2>
          <p class="text-center" style="color:#000000">Kenali dosen-dosen berdedikasi yang membimbing HIMATIF.</p>
        </div>

        <div class="row justify-content-center">
          @foreach($dosens as $index => $dosen)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 col-12 mb-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($index % 4 + 1) * 100 }}">
              {{-- Tambahkan w-100 di sini --}}
              <div class="member h-100 w-100 d-flex flex-column">
                {{-- Anda bisa menambahkan w-100 di sini juga jika perlu, tapi img-fluid biasanya cukup --}}
                <div class="member-img w-100">
                  @if($dosen->gambar)
                    <img src="{{ asset('storage/images/' . $dosen->gambar) }}" class="img-fluid w-100" alt="{{ $dosen->nama }}">
                    {{-- Menambahkan w-100 pada img juga bisa, meski img-fluid seringkali cukup --}}
                  @else
                    <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid w-100" alt="Default Image">
                  @endif
                </div>
                <div class="member-info p-3 d-flex flex-column flex-grow-1">
                    <h4 style="color: black;">{{ $dosen->nama }}</h4>
                    <span>{{ $dosen->nama_jabatan }}</span>
                    <p style="color:#000000" class="flex-grow-1">{{ Str::limit($dosen->deskripsi_jabatan, 50) }}</p>
                    <div class="member-action mt-auto">
                        <a href="{{ route('dosen.showPublicDetail', $dosen->id) }}" class="btn btn-outline-dark" style="color:#000000">Read more</a>
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
