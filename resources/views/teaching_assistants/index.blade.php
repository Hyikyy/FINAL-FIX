@extends('layouts.app')

@section('title', 'Daftar Teaching Asisten Himatif')
@section('description', 'Daftar lengkap Teaching Asisten yang mengajar Himatif.')
@section('keywords', 'Teaching, daftar Teaching Assistant, pengajar, asisten')

@section('content')

<style>
    /* ============================================= */
/* == CARD STYLING UNTUK BAGIAN TEAM/DOSEN == */
/* ============================================= */

.team .member {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
    padding: 20px; /* Padding internal untuk keseluruhan card */
    text-align: center;

    /* Kunci untuk tinggi dan struktur card: */
    /* h-100 dan w-100 akan dari class Bootstrap di HTML */
    /* Struktur flex column untuk menyusun img-wrapper dan content */
    display: flex;
    flex-direction: column;
}

.team .member .member-img-wrapper {
    width: 100%; /* Mengambil lebar penuh dari padding card */
    /* TINGGI TETAP untuk frame gambar, sesuaikan nilainya */
    height: 230px; /* Misalnya, 230px. Sesuaikan agar proporsional! */
    border-radius: 10px;
    overflow: hidden; /* Penting untuk object-fit dan border-radius pada gambar */
    margin-bottom: 15px; /* Jarak dari gambar ke konten teks */
    /* display: flex; align-items: center; justify-content: center; /* Jika gambar lebih kecil dari wrapper dan tidak pakai object-fit*/
}

.team .member .member-img-wrapper img {
    width: 100%;
    height: 100%; /* Gambar mengisi tinggi wrapper */
    object-fit: cover; /* Kunci: Menjaga rasio, mengisi, dan memotong jika perlu */
    /* object-position: center; (default, bisa diubah: top, bottom, dll.) */
    display: block; /* Menghilangkan spasi ekstra di bawah gambar */
    transition: transform 0.3s ease-in-out;
}

.team .member:hover .member-img-wrapper img {
    transform: scale(1.03);
}

/* Konten Teks di Bawah Gambar */
.team .member .member-content {
    /* Kunci untuk mengisi sisa ruang dan menyusun elemen di dalamnya: */
    flex-grow: 1; /* Mengambil semua sisa ruang vertikal di dalam .member */
    display: flex;
    flex-direction: column;
    text-align: center; /* Teks di dalamnya rata tengah */
}

.team .member .member-content h4 { /* Nama */
    font-weight: 700;
    /* margin-top: 0; (Padding card sudah memberi jarak) */
    margin-bottom: 8px; /* Jarak dari nama ke jabatan */
    font-size: 1.25rem; /* Sesuaikan ukuran font */
    color: #222;
    line-height: 1.3;
    /* Pertimbangkan min-height jika ingin nama selalu mengambil ruang untuk X baris,
       contoh: min-height: 2.6em; untuk alokasi 2 baris */
}

.team .member .member-content span { /* Jabatan */
    font-style: normal;
    display: block;
    font-size: 0.8rem; /* Sesuaikan ukuran font */
    color: #6c757d; /* Warna abu-abu Bootstrap */
    margin-bottom: 12px; /* Jarak dari jabatan ke deskripsi */
    line-height: 1.4;
}

.team .member .member-content p { /* Deskripsi */
    font-size: 0.9rem; /* Sesuaikan ukuran font */
    line-height: 1.6;
    color: #333;
    /* Kunci agar deskripsi mengisi ruang dan mendorong tombol ke bawah: */
    flex-grow: 1;
    margin-bottom: 15px; /* Jarak dari deskripsi ke tombol */
    /* Jika deskripsi sangat pendek, flex-grow akan membuatnya "kosong"
       Jika ingin ada minimal tinggi: min-height: 4.5em; (misal utk 3 baris) */
}

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
}
/* Hover bisa diambil dari style Bootstrap atau custom: */
/* .team .member .member-action .btn:hover {
    background-color: #333;
    color: #fff;
    border-color: #333;
} */

 
</style>

  <main id="main">


{{-- File Blade Anda --}}
{{-- ... bagian atas file ... --}}

<!-- ======= Asisten Dosen Section ======= -->
<section id="AsistenDosen" class="team section-bg py-5" style="margin-top: 70px; margin-bottom: 10px;">
  <div class="container" data-aos="fade-up">

    <div class="section-header text-center mb-5">
      <h2 class="fw-bold">Teaching Assistant</h2>
      <p style="color:#000000">Para asisten dosen yang membantu kelancaran kegiatan akademik.</p>
    </div>

    <div class="row gy-4 justify-content-center">
      @forelse($teachingAssistants as $teachingAssistant)
        {{-- Kolom Bootstrap: d-flex dan align-items-stretch sangat penting di sini --}}
        <div class="col-xl-3 col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          {{-- Card Utama (.member): h-100, w-100, dan dari CSS akan ada d-flex flex-column --}}
          <div class="member h-100 w-100">
            <div class="member-img-wrapper">
              @if($teachingAssistant->gambar)
                <img src="{{ asset('storage/teaching_assistants/' . $teachingAssistant->gambar) }}" alt="{{ $teachingAssistant->nama }}">
              @else
                <img src="{{ asset('assets/img/no-image.png') }}" alt="Default Image">
              @endif
            </div>
            {{-- Konten Teks: Dari CSS akan ada d-flex flex-column dan flex-grow: 1 --}}
            <div class="member-content">
                <h4 style="color: black;">{{ $teachingAssistant->nama }}</h4>
                <span>{{ $teachingAssistant->nama_jabatan }}</span>
                {{-- Paragraf Deskripsi: Dari CSS akan ada flex-grow: 1 --}}
                <p style="color:#000000;">{{ Str::limit($teachingAssistant->deskripsi_jabatan, 50) }}</p>
                {{-- Tombol Aksi: Dari CSS akan ada mt-auto --}}
                <div class="member-action">
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

{{-- ... sisa file ... --}}
</main><!-- End #main -->
@endsection
