@extends('layouts.app')

@section('title', $berita->judul)
@section('description', Str::limit(strip_tags($berita->deskripsi), 150))
@section('keywords', 'berita, detail, himatif, ' . $berita->judul)

<style>
    /* Variabel Warna (Definisikan di :root jika belum atau sesuaikan) */
    :root {
        --feedback-frame-bg: #f9f9f9;
        --feedback-border-color: #e0e0e0;
        --text-dark: #000000;
        --text-meta: #666666;
        --primary-color: #008374;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --modal-bg: rgba(0, 0, 0, 0.9);
        --modal-content-bg: transparent;
    }

    /* Umum */
    * {
        box-sizing: border-box;
    }

    /* Reset Gaya Dasar Carousel */
    .glide__slide {
        margin: 0;
        padding: 0;
    }

    .glide__slide a {
        display: block;
        text-decoration: none;
    }

    .glide__slide img {
        display: block;
        margin: 0;
        padding: 0;
        max-height: 250px;
        width: 100%;
        object-fit: cover;
        cursor: pointer;
        border-radius: 5px;
        transition: transform 0.3s ease;
    }

    .glide__slide img:hover {
        transform: scale(1.05);
    }

    /* Kontainer Slides: Hapus margin kanan, dan tambahkan style flexbox */
    .glide__slides {
        display: flex;
        align-items: center;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Tampilkan panah navigasi */
    .glide__arrows {
        display: block;
    }

    /* Tampilkan bullets navigasi */
    .glide__bullets {
        display: block;
    }

    .galeri-section {
        margin-bottom: 20px;
        margin-top: 20px;
    }

    /* Style untuk Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 2;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: var(--modal-bg);
    }

    .modal-content {
        position: relative;
        margin: 5% auto; /* Adjusted margin */
        max-width: 70%; /* Reduced max-width */
        max-height: 80%; /* Reduced max-height */
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 0;
        overflow: hidden;
        background-color: var(--modal-content-bg);
        box-shadow: none;
    }

    .modal-content img {
        max-width: 100%;
        max-height: 70vh; /* Reduced max-height of the image itself */
        object-fit: contain;
    }

    .modal-caption {
        display: none;
    }

    .modal-close {
        position: absolute;
        top: 10px;
        right: 25px;
        color: #fff;
        font-size: 35px;
        font-weight: bold;
        transition: color 0.3s ease;
        cursor: pointer;
        z-index: 3;
    }

    .modal-close:hover,
    .modal-close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* Style Feedback (TIDAK BERUBAH) */
    .feedback-section-title {
        font-size: 1.8rem !important;
        font-weight: 600 !important;
        color: var(--text-dark) !important;
        margin-bottom: 30px !important;
        position: relative !important;
        padding-bottom: 10px !important;
    }

    .feedback-section-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: var(--primary-color);
        position: absolute;
        bottom: 0;
        left: 0;
    }

    .feedback-item .feedback-header {
        margin-bottom: 8px;
    }

    .feedback-item .feedback-author {
        font-weight: bold;
        color: var(--text-dark);
        font-size: 0.95rem;
        margin: 0 0 2px 0;
        display: block;
        line-height: 1.3;
    }

    .feedback-item .feedback-date {
        font-size: 0.75rem;
        color: var(--text-meta);
        display: block;
        line-height: 1.3;
    }

    .feedback-item .feedback-date i.fas {
        margin-right: 4px;
        color: inherit;
    }

    .feedback-item .feedback-content {
        color: var(--text-dark);
        line-height: 1.65;
        font-size: 0.9rem;
        margin-bottom: 12px;
    }

    .feedback-item .feedback-content p {
        margin-top: 0;
        margin-bottom: 0;
        color: var(--text-dark);
    }

    /* Tombol Aksi (Edit/Hapus) */
    /* ... (CSS Anda yang lain, termasuk variabel warna dan style tombol) ... */

    /* Tombol Aksi (Edit/Hapus) */
    .feedback-item .feedback-actions {
        display: flex !important;
        /* PENTING: Jadikan container ini flexbox */
        gap: 8px !important;
        /* Jarak antar item (tombol Edit dan form Hapus) */
        align-items: center !important;
        /* Menyejajarkan item secara vertikal jika tingginya berbeda */
        margin-top: 10px !important;
        /* Beri jarak dari konten di atasnya */
    }

    /* Style untuk form tombol Hapus agar bisa inline dengan tombol Edit */
    .feedback-item .feedback-actions .form-feedback-delete {
        display: inline-block !important;
        /* PENTING: Agar form tidak mengambil lebar penuh */
        margin: 0 !important;
        /* Hapus margin default form jika ada */
        padding: 0 !important;
        /* Hapus padding default form jika ada */
        line-height: 1 !important;
        /* Untuk membantu alignment jika ada teks di sekitar form */
    }

    /* Style umum untuk tombol di dalam feedback-actions (sudah ada sebelumnya, pastikan benar) */
    .feedback-item .feedback-actions .btn {
        padding: 5px 12px !important;
        font-size: 0.8rem !important;
        border-radius: 20px !important;
        text-decoration: none !important;
        border-width: 1px !important;
        border-style: solid !important;
        transition: background-color 0.2s ease, opacity 0.2s ease, color 0.2s ease, border-color 0.2s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        line-height: 1.4 !important;
        cursor: pointer;
        /* Tambahkan cursor pointer */
    }

    .feedback-item .feedback-actions .btn i {
        margin-right: 5px !important;
    }

    .feedback-item .feedback-actions .btn-feedback-edit {
        background-color: var(--warning-color);
        border-color: var(--warning-color);
        color: var(--warning-text-color);
    }

    .feedback-item .feedback-actions .btn-feedback-edit:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        color: var(--warning-text-color);
    }

    .feedback-item .feedback-actions .btn-feedback-delete {
        background-color: var(--danger-color);
        border-color: var(--danger-color);
        color: white;
    }

    .feedback-item .feedback-actions .btn-feedback-delete:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    /* ... (Sisa CSS Anda) ... */

    /* "Belum ada feedback" */
    .no-feedback {
        text-align: center;
        padding: 25px;
        background-color: var(--feedback-frame-bg);
        border-radius: 10px;
        color: var(--text-meta);
        border: 1px solid var(--feedback-border-color);
        margin-bottom: 25px;
    }

    .no-feedback p {
        color: var(--text-meta);
    }

    .no-feedback i.fas {
        margin-right: 8px;
        font-size: 1.1rem;
    }

    /* Form Feedback */
    .feedback-form-container {
        background-color: #fff;
        border: 1px solid var(--feedback-border-color);
        border-radius: 10px;
        padding: 25px;
        margin-top: 30px;
        box-shadow: var(--default-shadow);
    }

    .feedback-form-container .form-label {
        color: var(--text-dark);
        font-weight: 500;
    }

    .feedback-form-container .feedback-section-title {
        /* Judul "Berikan Feedback Anda" */
        color: var(--text-dark);
        font-size: 1.5rem;
        margin-bottom: 20px;
        padding-bottom: 10px;
        position: relative;
        display: inline-block;
    }

    .feedback-form-container .feedback-section-title::after {
        background-color: var(--primary-color);

    }

    /* ... (CSS Anda yang lain, termasuk variabel warna) ... */
    .feedback-section-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 30px;
        position: relative;
        /* Diperlukan untuk positioning ::after */
        padding-bottom: 10px;
        /* Memberi ruang untuk garis bawah */
        display: inline-block;
        /* PENTING: Agar lebar elemen sesuai konten judul */
        /* Atau bisa juga 'inline-flex' jika ada ikon di dalam judul */
    }

    .feedback-section-title::after {
        content: '';
        display: block;
        width: 100%;
        /* PENTING: Garis akan selebar judul */
        height: 3px;
        /* Ketebalan garis */
        background: var(--primary-color);
        /* Warna garis */
        position: absolute;
        bottom: 0;
        /* Posisi garis di bagian bawah padding */
        left: 0;
        /* Mulai dari kiri judul */
    }

    /* ... (Sisa CSS Anda) ... */
    .invalid-feedback {
        color: var(--danger-color);
    }

    /* Prompt Login */
    .login-prompt p {
        color: var(--text-dark);
        /* Teks di login prompt hitam */
    }

    .login-prompt .prompt-button {
        display: inline-block;
        padding: 6px 15px;
        margin: 0 4px;
        border-radius: 20px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        border: 1px solid transparent;
        vertical-align: middle;
    }

    .login-prompt .prompt-button-login {
        /* background-color: var(--primary-color) !important; color: white !important; */
        border-color: var(--primary-color);
    }

    .login-prompt .prompt-button-login:hover {
        border-color: #008374;
    }

    .login-prompt .prompt-button-register {
        /* background-color: var(--primary-color) !important; color: #ffffff!important; */
        border-color: var(--primary-color);
    }

    .login-prompt .prompt-button-register:hover {
        background-color: var(--primary-color);
        color: white;
    }

    /* Tombol Kirim Feedback Utama */
    .btn-submit-feedback {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .btn-submit-feedback:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* Tambahan Style */
    .glide__slide {
        margin: 0;
        padding: 0;
    }

    .glide__slide img {
        margin: 0;
        padding: 0;
        max-height: 300px;
        /* Atau ukuran yang sesuai */
        width: 100%;
        /* Biarkan lebar menyesuaikan */
        object-fit: cover;
        /* Penting untuk mengisi ruang tanpa distorsi */
    }

    /*CSS Agar Rapi*/
    .glide__slides {
        /* Tambahkan kode ini */
        display: flex;
        align-items: center;
    }

    * {
        box-sizing: border-box;
    }

    /* Style untuk menghilangkan jarak di carousel */
    .galeri-section .glide__slide {
        margin-right: 0px;
    }

    .galeri-section .glide__slides {
        margin-right: 0px;
    }
</style>

@section('content')

<main id="main">
    <br><br><br>
    <!-- ======= Berita Detail Section ======= -->
    <section id="berita-detail" class="blog-details">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-8 entries">
                    <article class="entry entry-single">
                        {{-- ... Konten Artikel Berita (Hapus style inline warna hitam dari sini) ... --}}
                        <div class="entry-img">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                    class="img-fluid"
                                    style="width: 100%; object-fit: cover; max-height: 500px;">
                            @else
                                <img src="{{ asset('assets/img/news.jpg') }}" alt="Default Image" class="img-fluid"
                                    style="width: 100%; object-fit: cover; max-height: 500px;">
                            @endif
                        </div>

                        {{-- Galeri Gambar Carousel --}}
                        @if($berita->images->isNotEmpty())
                            <div class="galeri-section">
                                <div class="glide" id="glideCarousel">
                                    <div class="glide__track" data-glide-el="track">
                                        <ul class="glide__slides">
                                            @foreach($berita->images as $image)
                                                 <li class="glide__slide">
                                                    <a href="#" data-image="{{ asset('storage/' . $image->image_path) }}" onclick="openModal(this); return false;">
                                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gambar Berita" class="img-fluid">
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="glide__arrows" data-glide-el="controls">
                                        <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><</button>
                                        <button class="glide__arrow glide__arrow--right" data-glide-dir=">">></button>
                                    </div>

                                    <div class="glide__bullets" data-glide-el="bullets">
                                        @foreach($berita->images as $key => $image)
                                            <button class="glide__bullet" data-glide-dir="={{ $key }}"></button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- Galeri Gambar End Carousel --}}
                         <!-- Modal untuk Menampilkan Gambar Lebih Besar -->
                        <div id="imageModal" class="modal">
                            <span class="modal-close" onclick="closeModal()">×</span>
                            <div class="modal-content">
                                <img id="modalImage">
                            </div>
                        </div>

                        <h1 class="entry-title" style="color:#000000">{{ $berita->judul }}</h1>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center">
                                    <i class="fas fa-clock"></i>
                                    <time
                                        datetime="{{ $berita->tanggal_upload ?? $berita->created_at }}">{{ \Carbon\Carbon::parse($berita->tanggal_upload ?? $berita->created_at)->translatedFormat('d M Y, H:i') }}</time>
                                </li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            {!! nl2br(e($berita->deskripsi)) !!}
                        </div>
                    </article><!-- End Blog Entry -->

                    <br>
                    {{-- Bagian Feedback yang Dimodifikasi (Hapus style inline warna hitam dari sini) --}}
                    <div class="feedback-section">
                        <h3 class="feedback-section-title">Feedback Pengunjung</h3>
                        <div class="feedback-list">
                            @if ($berita->feedback->count() > 0)
                                @foreach ($berita->feedback->sortByDesc('created_at') as $item)
                                    @php
                                        $userName = $item->user ? $item->user->name : ($item->nama ?? 'Anonim');
                                        $userAvatar = $item->user ? $item->user->avatar : null;
                                        $initials = '';
                                        if ($userName !== 'Anonim') {
                                            $names = explode(' ', $userName);
                                            $initials = strtoupper(substr($names[0], 0, 1));
                                            if (count($names) > 1) {
                                                $initials .= strtoupper(substr(end($names), 0, 1));
                                            } elseif (strlen($names[0]) > 1) {
                                                $initials = strtoupper(substr($names[0], 0, 2));
                                            }
                                        } else {
                                            $initials = 'AN';
                                        }
                                    @endphp
                                    <div class="feedback-item">
                                        <div class="feedback-avatar-container">
                                            <div class="feedback-avatar" title="{{ $userName }}">
                                                @if ($userAvatar)
                                                    <img src="{{ asset('storage/' . $userAvatar) }}"
                                                        alt="{{ $userName }}">
                                                @else
                                                    {{ $initials }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="feedback-main-content">
                                            {{-- Wrapper BARU untuk Author dan Tanggal --}}
                                            <div class="feedback-header">
                                                <h4 class="feedback-author">{{ $userName }}</h4>
                                                <time class="feedback-date" datetime="{{ $item->created_at }}">
                                                    <i class="fas fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y, H:i') }}
                                                    ({{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }})
                                                </time>
                                            </div>
                                            <div class="feedback-content">
                                                <p>{{ $item->isi }}</p>
                                            </div>
                                            {{-- ... di dalam loop @foreach ... --}}
                                            @auth
                                                @if (Auth::user()->id == $item->user_id || Auth::user()->role == 'admin')
                                                    <div class="feedback-actions">
                                                        {{-- Container ini akan kita jadikan flex --}}
                                                        <a href="{{ route('feedback.edit', $item->id) }}"
                                                            class="btn btn-sm btn-feedback-edit" title="Edit Feedback">
                                                            <i class="fas fa-pencil-alt"></i> Edit
                                                        </a>
                                                        {{-- Form untuk tombol Hapus --}}
                                                        <form action="{{ route('feedback.destroy', $item->id) }}"
                                                            method="POST" class="form-feedback-delete">
                                                            {{-- Tambahkan class di sini --}}
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-feedback-delete"
                                                                title="Hapus Feedback"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus feedback ini?')">
                                                                <i class="fas fa-trash-alt"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
                                            {{-- ... --}}
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                {{-- ... (no feedback message) ... --}}
                            @endif
                        </div>
                        {{-- Form Feedback (Hapus style inline warna hitam dari sini) --}}
                        @auth
                            @php
                                $userHasFeedback = $berita->feedback()->where('user_id', Auth::id())->exists();
                            @endphp

                            @if (!$userHasFeedback)
                                <div class="feedback-form-container">
                                    <h4 class="feedback-section-title"
                                        style="font-size: 1.5rem; margin-bottom:20px; padding-bottom: 5px;">Berikan
                                        Feedback Anda</h4>
                                    {{-- ... (alert messages) ... --}}
                                    @if (session('success_feedback'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success_feedback') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    @if ($errors->feedback_form->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Oops! Terjadi kesalahan:</strong>
                                            <ul>
                                                @foreach ($errors->feedback_form->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form action="{{ route('feedback.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="berita_id" value="{{ $berita->id }}">
                                        <div class="mb-3">
                                            <label for="isi_feedback" class="form-label">Komentar Anda *</label>
                                            <textarea name="isi" id="isi_feedback"
                                                class="form-control @error('isi', 'feedback_form') is-invalid @enderror"
                                                rows="5" required placeholder="Tuliskan feedback Anda di sini...">{{ old('isi') }}</textarea>
                                            @error('isi', 'feedback_form')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary btn-submit-feedback">
                                                <i class="fas fa-paper-plane"></i> Kirim Feedback
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="user-feedback-notice">
                                    <p><i class="fas fa-check-circle"></i> Anda sudah memberikan feedback untuk berita
                                        ini. Anda dapat mengedit atau menghapusnya pada daftar di atas.</p>
                                </div>
                            @endif
                        @else
                            <div class="login-prompt">
                                <p><i class="fas fa-sign-in-alt"></i> Anda harus
                                    <a href="{{ route('login') }}"
                                        class="prompt-button prompt-button-login">login</a> atau
                                    <a href="{{ route('register') }}"
                                        class="prompt-button prompt-button-register">daftar</a>
                                    terlebih dahulu untuk memberikan feedback.
                                </p>
                            </div>
                        @endauth
                    </div>
                    {{-- End Feedback Section --}}
                </div>
                <!-- End Blog entries list -->

                <div class="col-lg-4">
                    {{-- ... Sidebar (Hapus style inline warna hitam dari sini) ... --}}
                    <div class="sidebar">
                        <div class="sidebar-item recent-posts">
                            <h3 class="sidebar-title fw-bold" style="color:#000000">Berita Terbaru Lainnya</h3>
                            <div class="mt-3">
                                @forelse ($recentBeritas as $recentBerita)
                                    @if ($recentBerita->id != $berita->id)
                                        <div class="post-item mt-3">
                                            @if ($recentBerita->gambar)
                                                <img src="{{ asset('storage/' . $recentBerita->gambar) }}"
                                                    alt="{{ $recentBerita->judul }}" class="img-fluid mb-2"
                                                    style="width:80px; height:60px; object-fit:cover; float:left; margin-right:15px; border-radius:5px;">
                                            @else
                                                <img src="{{ asset('assets/img/news.jpg') }}" alt="Default Image"
                                                    class="img-fluid mb-2"
                                                    style="width:80px; height:60px; object-fit:cover; float:left; margin-right:15px; border-radius:5px;">
                                            @endif
                                            <h4 style="font-size: 1rem; margin-bottom: 5px;"><a
                                                    href="{{ route('beritas.show', $recentBerita->id) }}"
                                                    style="text-decoration:none;">{{ Str::limit($recentBerita->judul, 50) }}</a>
                                            </h4>
                                            <time
                                                datetime="{{ $recentBerita->tanggal_upload ?? $recentBerita->created_at }}"
                                                style="font-size:0.8rem;">{{ \Carbon\Carbon::parse($recentBerita->tanggal_upload ?? $recentBerita->created_at)->translatedFormat('d M Y') }}</time>
                                            <div style="clear:both;"></div>
                                        </div>
                                    @endif
                                @empty
                                    <p>Tidak ada berita terbaru lainnya.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.6.0/dist/glide.min.js"></script>
    <script>
        new Glide('#glideCarousel', {
            type: 'carousel',
            startAt: 0,
            perView: 3, // Sesuaikan jumlah gambar yang terlihat
            autoplay: 3000, // Optional: Putar otomatis
            gap: 0, // Optional: Jarak antar gambar, kurangi nilai ini (letakkan di sini)
            breakpoints: {
                800: {
                    perView: 2
                },
                600: {
                    perView: 1
                }
            }
        }).mount()
    </script>
     <script>
        function openModal(element) {
            var imageSrc = element.dataset.image;
            var modalImage = document.getElementById("modalImage");

            // Set the source of the image
            modalImage.src = imageSrc;

            // Show the modal
            var modal = document.getElementById("imageModal");
            modal.style.display = "block";
        }

        function closeModal() {
            document.getElementById("imageModal").style.display = "none";
        }

        window.onclick = function(event) {
            var modal = document.getElementById("imageModal");
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
    <script>
        window.setTimeout(function() {
            $(".alert-success, .alert-danger").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush