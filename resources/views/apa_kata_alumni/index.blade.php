@extends('layouts.app')

@section('title', 'Apa Kata Alumni | Website Kami')
@section('description', 'Testimoni dan pesan dari alumni-alumni terbaik kami.')
@section('keywords', 'alumni, testimoni, apa kata alumni, pesan alumni')

@section('content')

<style>
    /* --- STYLE DASAR --- */
    .chat-item {
        background-color: #444544; /* Warna pesan WA */
        border-radius: 10px;
        padding: 20px; /* Tambah padding di dalam pesan */
        margin-bottom: 20px; /* Tambah spasi antar pesan */
        position: relative; /* Untuk style pseudo-element */
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        word-wrap: break-word; /* Agar teks panjang tidak keluar container */
        display: flex;
        align-items: flex-start; /* Agar avatar dan konten sejajar dari atas */
        height: 100%; /* Untuk memastikan semua chat-item dalam satu baris memiliki tinggi yang sama jika dibutuhkan */
    }

    .chat-item:before {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        bottom: 0;
        left: -12px; /* Letakkan di luar container */
        border-style: solid;
        border-width: 12px 12px 0 0;
        border-color: #444544 transparent transparent transparent; /* Warna segitiga sama dengan background pesan */
        transform: rotate(270deg);
    }

    .chat-avatar {
        width: 70px; /* Perbesar ukuran avatar */
        height: 70px; /* Perbesar ukuran avatar */
        border-radius: 50%;
        overflow: hidden;
        margin-right: 15px; /* Tambah jarak avatar dan konten */
        flex-shrink: 0; /* Mencegah avatar menyusut */
    }

    .chat-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .chat-bubble {
        flex-grow: 1; /* Agar bubble menggunakan sisa ruang */
        display: flex;
        flex-direction: column; /* Agar elemen di dalam bubble tersusun vertikal */
    }

    .chat-bubble h4 {
        font-size: 18px; /* Perbesar ukuran nama */
        font-weight: bold;
        color: #fff; /* Nama Putih */
        margin-bottom: 8px; /* Tambah spasi bawah nama */
    }

    .chat-bubble span {
        font-size: 13px; /* Perbesar ukuran angkatan */
        color: #ffffff; /* Putih */
        margin-bottom: 12px; /* Tambah spasi bawah angkatan */
        display: block; /* Agar span berada di baris baru */
    }

    .chat-message {
        flex-grow: 1; /* Agar pesan mengambil sisa ruang vertikal */
        margin-bottom: 15px; /* Jarak antara pesan dan tombol read more */
    }

    .chat-message p {
        margin-bottom: 8px; /* Tambah spasi bawah setiap paragraf */
        font-size: 15px; /* Perbesar ukuran teks pesan */
        line-height: 1.6; /* Atur line height agar teks lebih mudah dibaca */
        color: #fff; /* Putih */
    }

    .chat-message p b {
        color: #fff; /* Putih */
    }

    .chat-read-more {
        display: inline-block;
        padding: 10px 15px; /* Perbesar ukuran tombol */
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px; /* Perbesar ukuran teks tombol */
        transition: background-color 0.3s;
        margin-top: auto; /* Mendorong tombol ke bawah jika ada ruang ekstra */
        align-self: flex-start; /* Agar tombol tidak stretch full width */
    }

    .chat-read-more:hover {
        background-color: #0056b3;
    }

    /*Style untuk Section header agar center*/
    .section-header {
        text-align: center;
        margin-bottom: 40px; /* Tambah spasi bawah header */
    }

    .section-header h2 {
        font-size: 28px; /* Perbesar ukuran judul header */
        font-weight: bold;
        color: #333;
    }

    .section-header p {
        font-size: 17px; /* Perbesar ukuran deskripsi header */
        color: #555;
    }

    /* Class untuk item ganjil terakhir agar rata tengah */
    .last-odd-item-center {
        margin-left: auto !important;
        margin-right: auto !important;
    }


    /* RESPONSIVE */
    @media (max-width: 768px) {
        .col-lg-6.col-md-6 { /* Lebih spesifik untuk override */
            width: 100%; /* Full width di layar kecil */
            margin-left: 0 !important; /* Reset margin jika ada dari last-odd-item-center */
            margin-right: 0 !important; /* Reset margin jika ada dari last-odd-item-center */
        }

        .chat-avatar {
            width: 60px;
            height: 60px;
            margin-right: 10px;
        }

        .chat-bubble h4 {
            font-size: 16px;
        }

        .chat-bubble span {
            font-size: 12px;
        }

        .chat-message p {
            font-size: 14px;
        }

    }


    .chat-read-more {
        display: inline-block; /* Agar padding dan border bekerja baik */
        padding: 8px 18px;    /* Padding sedikit disesuaikan */
        background-color: transparent; /* Background transparan */
        color: #84ece0;;       /* Warna teks dan border (misalnya, warna aksen Anda) */
                                /* Anda bisa gunakan: var(--filter-text-color-active, #008374); jika variabel sudah ada */
        border: 2px solid #84ece0;; /* Border dengan warna aksen */
        text-decoration: none;
        border-radius: 20px;   /* Border radius lebih besar untuk tampilan "pill" atau rounded */
        font-size: 13px;
        font-weight: 600;      /* Teks sedikit lebih tebal */
        text-align: center;
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
        margin-top: auto;
        align-self: flex-start;
        cursor: pointer; /* Menunjukkan elemen bisa diklik */
    }

    .chat-read-more:hover,
    .chat-read-more:focus { /* Tambahkan :focus untuk aksesibilitas */
        background-color: #00c2a9; /* Background diisi dengan warna aksen saat hover/focus */
        color: #ffffff;             /* Teks menjadi putih */
        border-color: #00c2a9;      /* Pastikan border tetap warna aksen (atau bisa dihilangkan jika menyatu) */
        transform: translateY(-2px); /* Efek sedikit terangkat saat hover */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15); /* Tambahkan shadow saat hover untuk kedalaman */
        outline: none; /* Hapus outline default pada focus jika sudah ada visual lain */
    }
    /* === PERUBAHAN TOMBOL SELESAI DI SINI === */

     /* Untuk layar yang lebih besar dari md (768px), tapi lebih kecil dari lg (992px)
       jika ada kasus di mana .col-md-6 tidak cukup untuk centering dengan margin auto
       misalnya jika ada 3 item di md, item terakhir akan ada di baris baru.
       Namun, dengan col-lg-6 dan col-md-6, kasus 3 item akan membuat 2 item di baris pertama
       dan 1 item di baris kedua, yang sudah otomatis rata kiri.
       Class .last-odd-item-center akan bekerja baik jika ada 1 item di baris terakhir.
    */
</style>

<main id="main" style="padding-top: 80px; padding-bottom: 50px; ">
    <!-- ======= Apa Kata Alumni Section ======= -->
    <section id="ApaKataAlumni" class="team apa-kata-alumni-chat" style="margin-top: 20px; margin-bottom: 10px;" >
        <div class="container" data-aos="fade-up">

            <div class="section-header" style="margin-top: 30px; margin-bottom: 10px;">
                <h2 class="text-center">Pesan dan Testimoni Alumni</h2>
                <p class="text-center">Inspirasi dari alumni-alumni hebat kami.</p>
            </div>

            {{-- Menggunakan class .row untuk membungkus semua chat item --}}
            {{-- Menambahkan justify-content-center pada row agar item ganjil terakhir bisa lebih mudah di tengah jika hanya satu --}}
            <div class="row gy-4 justify-content-center"> {{-- gy-4 untuk gutter vertikal, justify-content-center untuk membantu centering item tunggal di baris terakhir --}}
                @foreach($apaKataAlumni as $alumni)
                @php
                    // Cek apakah ini item terakhir dan jumlah total item adalah ganjil
                    $isLastOdd = $loop->last && ($loop->count % 2 != 0);
                @endphp
                {{-- Setiap item chat akan mengambil setengah lebar di layar medium ke atas (col-md-6) --}}
                {{-- Di layar kecil (di bawah medium), akan mengambil lebar penuh (1 kolom) --}}
                {{-- Menambahkan class 'last-odd-item-center' jika kondisi terpenuhi --}}
                <div class="col-lg-6 col-md-6 {{ $isLastOdd ? 'last-odd-item-center' : '' }}" data-aos="fade-up" data-aos-delay="100">
                    <div class="chat-item">
                        {{-- Hapus class 'member' jika hanya ingin styling chat --}}
                        <div class="chat-avatar">
                            @if($alumni->gambar)
                            <img src="{{ asset('storage/apa_kata_alumni/' . $alumni->gambar) }}" class="img-fluid" alt="{{ $alumni->nama }}">
                            @else
                            <img src="{{ asset('assets/img/no-image.png') }}" class="img-fluid" alt="Default Image">
                            @endif
                        </div>
                        <div class="chat-bubble">
                            <h4 class="alumni-name">{{ $alumni->nama }}</h4>
                            <span class="alumni-meta">Angkatan: {{ $alumni->angkatan }}</span>
                            <div class="chat-message">
                                <p><b>Pekerjaan:</b> {{ $alumni->pekerjaan }}</p>
                                <p class="main-testimonial-text"><b>Pesan: </b>{{ Str::limit($alumni->isi, 180) }}</p>
                                {{-- Sedikit dikurangi limitnya untuk layout 2 kolom --}}
                            </div>
                            <a href="{{ route('apa_kata_alumni.show', $alumni->id) }}" class="chat-read-more">Read more</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Apa Kata Alumni Section -->

</main><!-- End #main -->

@endsection
