@extends('layouts.app') {{-- Sesuaikan dengan layout Anda --}}

@section('title', 'Struktur Organisasi')
@section('description', 'Struktur Organisasi HIMATIF')
@section('keywords', 'struktur, organisasi, himatif, pengurus')

@section('content')

  <main id="main">

    <!-- ======= Struktur Organisasi Section ======= -->
    <section id="struktur-organisasi" class="team section-bg py-5" style="margin-top: 30px; margin-bottom: 10px;">
      <div class="container" data-aos="fade-up">

        <div class="section-header mb-5" style="margin-top: 70px; margin-bottom: 10px;">
          <h2 class="text-center fw-bold" style="color: #333;">Struktur Organisasi HIMATIF</h2>
          <p class="text-center lead" style="color: #555;">
            Berikut adalah struktur organisasi Himpunan Mahasiswa Teknologi Informasi. Setiap anggota memiliki peran penting dalam menjalankan roda organisasi dan mencapai tujuan bersama.
          </p>
        </div>

        <div class="row gy-4 justify-content-center">

          @foreach($strukturOrganisasi as $item)
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="member">
                @if($item->gambar)
                  <img src="{{ asset('storage/struktur_organisasi/' . $item->gambar) }}" class="img-fluid" alt="{{ $item->nama_anggota }}">
                @else
                  <img src="{{ asset('assets/img/team/team-1.jpg') }}" class="img-fluid" alt="Default Image">
                @endif
                <h4 style="color: #000000;">{{ $item->nama_anggota }}</h4>
                <span style="color: #000000;">{{ $item->nama_jabatan }}</span>
                <p style="color: #000000;">
                  {{ $item->deskripsi_jabatan }}
                </p>
              </div>
            </div><!-- End Team Member -->
          @endforeach

        </div>

      </div>
    </section><!-- End Struktur Organisasi Section -->

  </main><!-- End #main -->

@endsection

@push('styles')
<style>
.team .member {
  /* height: 100% sudah di-handle oleh align-items-stretch pada parent kolom */
  /* d-flex dan flex-column sudah ditambahkan inline, bisa juga di sini */
}
.team .member .member-info {
  /* flex-grow: 1; sudah ditambahkan inline, bisa juga di sini */
  /* Ini memastikan bahwa bagian info akan meregang mengisi sisa ruang vertikal */
}
.section-bg {
    background-color: #f7f9fc;
}
</style>
@endpush
