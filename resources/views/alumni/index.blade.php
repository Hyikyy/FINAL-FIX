@extends('layouts.app')

@section('title', 'Daftar Alumni HIMATIF | Website Kami')
@section('description', 'Daftar lengkap alumni berprestasi dari HIMATIF.')
@section('keywords', 'alumni, daftar alumni, himatif, lulusan')

@push('styles')
<style>
 :root {
        --filter-text-color-default: #555555; /* Warna teks filter biasa (abu-abu sedikit gelap) */
        --filter-text-color-hover: #008374;    /* Warna teks saat hover (biru Bootstrap default, sesuaikan!) */
        --filter-text-color-active: #008374;   /* Warna teks DAN garis bawah untuk filter aktif (biru Bootstrap default, sesuaikan!) */
        /* Ganti #007bff dengan warna primer tema Anda jika berbeda, misalnya #008374 jika itu warna utama Anda */
    }

    /* Bagian Filter Utama */
    .alumni-filter-section {
        margin-bottom: 35px; /* Jarak dari filter ke card alumni */
        padding-top: 10px; /* Sedikit ruang di atas filter */
        padding-bottom: 10px; /* Sedikit ruang di bawah filter */
    }

    .alumni-filter-nav {
        text-align: center; /* Pusatkan navigasi filter */
    }

    .alumni-filter-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: inline-flex; /* Membuat ul hanya selebar kontennya, lalu text-align:center pada parent akan bekerja */
        flex-wrap: wrap;      /* Jika filter terlalu banyak, akan pindah baris */
        justify-content: center; /* Sejajarkan item jika wrap */
        gap: 5px 20px;        /* Jarak vertikal 5px, jarak horizontal 20px antar item filter */
        border-bottom: 0px solid #e0e0e0; /* Garis abu-abu tipis di bawah seluruh navigasi filter */
        padding-bottom: 10px; /* Jarak dari item filter ke garis bawah navigasi */
    }

    .alumni-filter-nav ul li {
        /* Tidak perlu style khusus di sini */
    }

    .alumni-filter-nav ul li a {
        display: inline-block;
        padding: 8px 12px; /* Padding internal link filter */
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem; /* Ukuran font filter */
        color: var(--filter-text-color-default);
        background-color: transparent;
        border: none;
        border-radius: 0; /* Tidak ada border radius pada link */
        transition: color 0.25s ease;
        position: relative; /* Diperlukan untuk pseudo-element ::after */
        outline: none; /* Hapus outline default saat fokus (opsional) */
    }

    .alumni-filter-nav ul li a:hover {
        color: var(--filter-text-color-hover);
        /* Tidak perlu background-color saat hover jika ingin tetap transparan */
    }

    /* Gaya untuk filter yang AKTIF */
    .alumni-filter-nav ul li a.active {
        color: var(--filter-text-color-active); /* Warna teks untuk filter aktif */
        font-weight: 700; /* Teks lebih tebal untuk filter aktif */
    }

    /* Garis bawah untuk filter yang AKTIF */
    .alumni-filter-nav ul li a.active::after {
        content: "";
        position: absolute;
        display: block;
        width: 80%; /* Lebar garis bawah (misalnya 80% dari lebar link <a>) */
        height: 2.5px; /* Ketebalan garis bawah */
        background: var(--filter-text-color-active); /* Warna garis bawah SAMA dengan teks aktif */
        bottom: -10px; /* Posisi di bawah teks, sedikit di atas garis navigasi utama jika ada */
                       /* Sesuaikan nilai ini. Jika ul punya padding-bottom dan border-bottom,
                          maka bottom: -padding-bottom-ul; akan menempatkannya di atas border ul */
        left: 10%; /* Untuk menengahkan garis (100% - 80% = 20% / 2 = 10%) */
        border-radius: 1px; /* Sedikit radius pada garis bawah (opsional) */
    }



    .team .member-alumni {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.08);
        padding: 20px;
        display: flex;
        flex-direction: column;
        text-align: center;
        /* height diatur oleh JS */
    }

    .team .member-alumni .img-container-alumni {
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 15px; /* Sedikit dikurangi dari 20px */
        height: 220px; /* Tinggi frame gambar tetap */
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa; /* Warna placeholder lebih netral */
    }

    .team .member-alumni .img-container-alumni img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease-in-out;
    }

    .team .member-alumni:hover .img-container-alumni img {
        transform: scale(1.03);
    }

    .team .member-alumni .info-alumni {
        flex-grow: 1; /* Pastikan info-alumni mengisi sisa ruang vertikal di card */
        display: flex;
        flex-direction: column;
        text-align: center;
    }

    .team .member-alumni .info-alumni h4 { /* Nama Alumni */
        font-weight: 700;
        font-size: 1.15rem; /* Sedikit disesuaikan */
        color: #000000;
        line-height: 1.3;
        margin-top: 0; /* Dihapus karena padding card sudah ada */
        margin-bottom: 0.4em; /* Jarak ke elemen berikutnya */
        /* MIN-HEIGHT untuk mengakomodasi NAMA PANJANG (misal 2 baris) */
        min-height: 2.6em; /* (1.3em line-height * 2 baris). Sesuaikan! */
        /* Untuk meratakan teks jika hanya 1 baris dalam ruang 2 baris: */
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column; /* Jika nama jadi 2 baris, agar tetap di tengah bloknya */
    }

    /* Wrapper untuk Nama Cantik/Julukan */
    .team .member-alumni .info-alumni .nama-cantik-wrapper {
        /* MIN-HEIGHT untuk mengakomodasi 1 baris NAMA CANTIK */
        min-height: 1.4em; /* (sekitar 1 baris teks + sedikit ruang). Sesuaikan! */
        margin-bottom: 0.4em; /* Jarak ke elemen berikutnya */
        display: flex; /* Untuk meratakan teks di dalamnya jika ada */
        align-items: center;
        justify-content: center;
    }

    .team .member-alumni .info-alumni .nama-cantik-wrapper span.nama-cantik-alumni {
        display: block;
        font-size: 0.8rem;
        color: #6c757d; /* Warna abu-abu Bootstrap */
        line-height: 1.3;
        /* Tidak perlu min-height di sini, wrapper-nya yang mengatur */
    }

    .team .member-alumni .info-alumni span.jabatan-alumni { /* Angkatan */
        display: block;
        font-size: 0.85rem;
        color: #555;
        line-height: 1.3;
        margin-bottom: 1em; /* Jarak SEBELUM tombol (jika tidak ada spacer eksplisit) */
        /* min-height: 1.3em; (Opsional, jika ingin memastikan 1 baris) */
    }

    /* Tombol Aksi */
    .team .member-alumni .action-alumni {
        margin-top: auto; /* Ini PENTING untuk mendorong tombol ke bawah */
        /* padding-top: 10px; (Opsional, memberi jarak dari konten di atas jika perlu) */
    }

    .team .member-alumni .action-alumni .btn {
        border-radius: 20px;
        padding: 8px 25px;
        font-weight: 500;
        font-size: 0.85rem;
        border: 1px solid #ced4da;
        color: #212529;
        background-color: #fff;
        border: 1px solid #adb5bd; /* Border awal */
        text-decoration: none;
        display: inline-block;
        text-align: center;
        transition: background-color 0.2s ease, border-color 0.2s ease;
    }

    .team .member-alumni .action-alumni .btn:hover {
        background-color: #000000; /* Warna background menjadi GELAP */
        color: #ffffff !important;            /* Warna font TETAP GELAP/PEKAT (sama seperti warna awal) */
        border-color: #343a40;
    }
</style>
@endpush

@section('content')

  <main id="main">



    <section id="Alumni" class="team py-5" style="margin-top: 70px; margin-bottom: 10px;">
      <div class="container" data-aos="fade-up">

        <div class="section-header mb-4">
          <h2 class="text-center fw-bold" style="margin-top: 50px; margin-bottom: 10px;">Alumni HIMATIF</h2>
          <p class="text-center" style="color:#000000">
            Alumni-alumni berprestasi dari HIMATIF.
            @if($selectedAngkatan)
                <br>Menampilkan Angkatan: <strong>{{ $selectedAngkatan }}</strong>
            @endif
          </p>
        </div>

        {{-- AWAL FILTER ANGKATAN --}}
        @if(isset($angkatans) && $angkatans->count() > 0)
        <div class="row">
            <div class="col-lg-12">
                {{-- <div class="alumni-filter-section"> --}} {{-- Wrapper ini opsional --}}
                    <nav class="alumni-filter-nav">
                        <ul>
                            <li>
                                <a href="{{ route('alumni.indexPublic') }}" class="{{ !$selectedAngkatan ? 'active' : '' }}">All</a>
                            </li>
                            @foreach($angkatans as $angkatan_th)
                                <li>
                                    <a href="{{ route('alumni.indexPublic', ['angkatan' => $angkatan_th]) }}" class="{{ $selectedAngkatan == $angkatan_th ? 'active' : '' }}">
                                        {{ $angkatan_th }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                {{-- </div> --}}
            </div>
        </div>
        @endif
        {{-- AKHIR FILTER ANGKATAN --}}


        <br> <br>
        @if($alumnis->count() > 0)
            {{-- ROW DENGAN justify-content-center dan gy-4 untuk gutter vertikal --}}
            {{-- Kita tidak lagi mengandalkan align-items-stretch di kolom untuk tinggi sama SEMUA card --}}
            <div class="row gy-4 justify-content-center">
            @foreach($alumnis as $index => $alumni)
                {{-- Di dalam loop @foreach($alumnis as $index => $alumni) --}}
{{-- Kolom Card --}}
<div class="col-xl-3 col-lg-4 col-md-6 col-sm-10 col-12" data-aos="fade-up" data-aos-delay="{{ ($index % 4 + 1) * 100 }}">
    <div class="member-alumni"> {{-- Tinggi diatur oleh JS --}}
        <div class="img-container-alumni">
            @if($alumni->gambar)
                <img src="{{ asset('storage/' . $alumni->gambar) }}" alt="{{ $alumni->nama }}">
            @else
                <img src="{{ asset('assets/img/no-image.png') }}" alt="Default Image">
            @endif
        </div>
        <div class="info-alumni"> {{-- Ini sudah display: flex; flex-direction: column; flex-grow: 1; --}}
            <h4>{{ $alumni->nama }}</h4> {{-- Akan diberi min-height via CSS --}}

            {{-- Wrapper untuk nama cantik agar selalu mengambil ruang --}}
            <div class="nama-cantik-wrapper">
                @if($alumni->nama_cantik)
                    <span class="nama-cantik-alumni">{{ $alumni->nama_cantik }}</span>
                @endif
                {{-- Jika kosong, wrapper ini tetap ada dan min-height CSS akan berlaku --}}
            </div>

            @if($alumni->angkatan)
                <span class="jabatan-alumni">Angkatan {{ $alumni->angkatan }}</span> {{-- Akan diberi min-height (opsional) --}}
            @endif

            {{-- Tombol Aksi akan didorong ke bawah oleh margin-top: auto --}}
            <div class="action-alumni">
                <a href="{{ route('alumni.showPublicDetail', $alumni->id) }}" class="btn btn-sm">Read more</a>
            </div>
        </div>
    </div>
</div>
            @endforeach
            </div>


            @if ($alumnis->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $alumnis->links() }}
                </div>
            @endif
        @else
            <div class="row">
                <div class="col text-center py-5">
                    <p class="lead text-muted">
                        Tidak ada data alumni
                        @if($selectedAngkatan)
                            untuk angkatan <strong>{{ $selectedAngkatan }}</strong>
                        @endif.
                    </p>
                    @if(!$selectedAngkatan && (!isset($angkatans) || $angkatans->count() == 0))
                        <p class="text-muted"><small>Belum ada data angkatan yang bisa difilter.</small></p>
                    @endif
                </div>
            </div>
        @endif

      </div>
    </section><!-- End Alumni Section -->
</main><!-- End #main -->
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    function equalizeCardHeights(selector) {
        const cards = document.querySelectorAll(selector);
        let maxHeight = 0;

        if (cards.length === 0) return;

        // Langkah 1: Reset tinggi ke 'auto' untuk mendapatkan tinggi alami
        // Ini penting jika fungsi dipanggil ulang (misalnya saat resize)
        cards.forEach(card => {
            card.style.height = 'auto';
        });

        // Langkah 2: Temukan tinggi maksimum
        cards.forEach(card => {
            const cardHeight = card.offsetHeight;
            if (cardHeight > maxHeight) {
                maxHeight = cardHeight;
            }
        });

        // Langkah 3: Atur semua card menjadi tinggi maksimum
        // Hanya lakukan jika maxHeight lebih dari 0 (ada card yang terlihat)
        if (maxHeight > 0) {
            cards.forEach(card => {
                card.style.height = maxHeight + 'px';
            });
        }
    }

    // Panggil fungsi untuk card alumni Anda
    // Pastikan selectornya benar, yaitu menargetkan elemen card utamanya
    // '.team .member-alumni' karena kita menggunakan class .member-alumni untuk card alumni
    equalizeCardHeights('.team .member-alumni');

    // Opsional: Panggil lagi saat ukuran window berubah (dengan debounce untuk performa)
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            equalizeCardHeights('.team .member-alumni');
        }, 250); // Tunggu 250ms setelah resize berhenti sebelum menjalankan
    });

    // Jika Anda menggunakan filter angkatan yang memuat ulang card (misalnya via AJAX atau full page reload),
    // Anda mungkin perlu memanggil equalizeCardHeights() lagi setelah filter diterapkan.
    // Jika filter menyebabkan full page reload, DOMContentLoaded akan menanganinya.
    // Jika filter via AJAX, panggil setelah konten AJAX berhasil dimuat.
});
</script>
@endpush
