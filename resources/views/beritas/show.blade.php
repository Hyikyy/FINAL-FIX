{{-- COBA LETAKKAN TAG STYLE DI SINI, DI ATAS @extends --}}
<style>
    /* Variabel Warna (Definisikan di :root jika belum atau sesuaikan) */
    :root {
        --feedback-frame-bg: #f9f9f9; /* Warna background frame komentar yang hangat/netral */
        --feedback-border-color: #e0e0e0; /* Warna border frame */
        --text-dark: #000000;       /* Teks utama hitam */
        --text-meta: #666666;       /* Teks meta (tanggal, dll) lebih lembut */
        --primary-color: #008374;   /* Warna primer Anda */
        --warning-color: #ffc107;   /* Warna kuning untuk edit */
        --warning-text-color: #212529; /* Teks untuk tombol kuning */
        --danger-color: #dc3545;    /* Warna merah untuk hapus */
        --hover-shadow: 0 5px 15px rgba(0,0,0,0.1); /* Shadow lebih jelas saat hover */
        --default-shadow: 0 2px 8px rgba(0,0,0,0.07); /* Shadow default */
    }

    /* Judul Section Feedback */
    .feedback-section-title {
        font-size: 1.8rem !important;
        font-weight: 600 !important;
        color: var(--text-dark) !important;
        margin-bottom: 30px !important;
        position: relative !important;
        padding-bottom: 10px !important;
    }
    .feedback-section-title::after {
        content: '' !important; display: block !important; width: 60px !important; height: 3px !important;
        background: var(--primary-color) !important;
        position: absolute !important; bottom: 0 !important; left: 0 !important;
    }

    .feedback-item .feedback-header {
        margin-bottom: 8px !important; /* Jarak antara header (nama+tanggal) dan konten komentar */
    }

    .feedback-item .feedback-author {
    font-weight: bold !important;
    color: var(--text-dark) !important;
    font-size: 0.95rem !important;
    margin: 0 0 2px 0 !important; /* Margin bawah kecil untuk jarak ke tanggal */
    display: block !important; /* Membuat nama author mengambil lebar penuh dan mendorong tanggal ke bawah */
    line-height: 1.3 !important;
}

.feedback-item .feedback-date {
    font-size: 0.75rem !important;
    color: var(--text-meta) !important;
    display: block !important; /* Membuat tanggal juga mengambil lebar penuh di bawah nama */
    line-height: 1.3 !important;
}
.feedback-item .feedback-date i.fas {
    margin-right: 4px !important;
    color: inherit !important;
}

.feedback-item .feedback-content {
    color: var(--text-dark) !important;
    line-height: 1.65 !important;
    font-size: 0.9rem !important;
    margin-bottom: 12px !important; /* Jarak ke tombol aksi jika ada */
}
.feedback-item .feedback-content p {
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    color: var(--text-dark) !important;
}

/* Tombol Aksi (Edit/Hapus) - pastikan margin-top jika diperlukan */
.feedback-item .feedback-actions {
    display: flex !important;
    gap: 8px !important;
    align-items: center !important;
    margin-top: auto; /* Mendorong tombol ke bawah jika ada ruang ekstra di .feedback-main-content */
                     /* atau gunakan margin-top: 8px; jika ingin jarak tetap */
}

    /* --- Item Feedback (Komentar) --- */
    .feedback-list .feedback-item {
        background-color: var(--feedback-frame-bg) !important;
        border: 1px solid var(--feedback-border-color) !important;
        border-radius: 10px !important;
        padding: 20px !important;
        margin-bottom: 20px !important; /* Mengurangi margin bawah sedikit */
        box-shadow: var(--default-shadow) !important;
        display: flex !important;
        align-items: flex-start !important;
        gap: 15px !important;
        transition: box-shadow 0.3s ease-in-out, transform 0.2s ease-in-out !important;
    }

    .feedback-list .feedback-item:hover {
        box-shadow: var(--hover-shadow) !important;
        transform: translateY(-2px) !important;
    }

    /* Avatar/Profil */
    .feedback-item .feedback-avatar-container {
        flex-shrink: 0 !important;
        padding-top: 3px !important;
    }

    .feedback-item .feedback-avatar {
        width: 48px !important;
        height: 48px !important;
        border-radius: 50% !important;
        background-color: var(--primary-color) !important;
        color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-weight: 600 !important;
        font-size: 1.1rem !important;
        text-transform: uppercase !important;
        overflow: hidden !important;
        border: 2px solid white !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.15) !important;
    }

    .feedback-item .feedback-avatar img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    /* Konten Utama Feedback */
    .feedback-item .feedback-main-content {
        flex-grow: 1 !important;
        display: flex !important;
        flex-direction: column !important;
    }

    .feedback-item .feedback-header {
        margin-bottom: 8px !important;
    }

    .feedback-item .feedback-author {
        font-weight: bold !important;
        color: var(--text-dark) !important;
        font-size: 0.95rem !important;
        margin: 0 !important;
        display: inline !important;
    }

    .feedback-item .feedback-date {
        font-size: 0.75rem !important;
        color: var(--text-meta) !important;
        margin-left: 0px !important;
    }
    .feedback-item .feedback-date i.fas {
        margin-right: 4px !important;
        color: inherit !important;
    }

    .feedback-item .feedback-content {
        color: var(--text-dark) !important;
        line-height: 1.65 !important;
        font-size: 0.9rem !important;
        margin-bottom: 12px !important;
    }
    .feedback-item .feedback-content p {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        color: var(--text-dark) !important; /* Pastikan paragraf juga hitam */
    }

    /* Tombol Aksi (Edit/Hapus) */
/* ... (CSS Anda yang lain, termasuk variabel warna dan style tombol) ... */

/* Tombol Aksi (Edit/Hapus) */
.feedback-item .feedback-actions {
    display: flex !important;       /* PENTING: Jadikan container ini flexbox */
    gap: 8px !important;           /* Jarak antar item (tombol Edit dan form Hapus) */
    align-items: center !important; /* Menyejajarkan item secara vertikal jika tingginya berbeda */
    margin-top: 10px !important;   /* Beri jarak dari konten di atasnya */
}

/* Style untuk form tombol Hapus agar bisa inline dengan tombol Edit */
.feedback-item .feedback-actions .form-feedback-delete {
    display: inline-block !important; /* PENTING: Agar form tidak mengambil lebar penuh */
    margin: 0 !important;             /* Hapus margin default form jika ada */
    padding: 0 !important;            /* Hapus padding default form jika ada */
    line-height: 1 !important;        /* Untuk membantu alignment jika ada teks di sekitar form */
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
    cursor: pointer; /* Tambahkan cursor pointer */
}
.feedback-item .feedback-actions .btn i {
    margin-right: 5px !important;
}

.feedback-item .feedback-actions .btn-feedback-edit {
    background-color: var(--warning-color) !important;
    border-color: var(--warning-color) !important;
    color: var(--warning-text-color) !important;
}
.feedback-item .feedback-actions .btn-feedback-edit:hover {
    background-color: #e0a800 !important;
    border-color: #d39e00 !important;
    color: var(--warning-text-color) !important;
}

.feedback-item .feedback-actions .btn-feedback-delete {
    background-color: var(--danger-color) !important;
    border-color: var(--danger-color) !important;
    color: white !important;
}
.feedback-item .feedback-actions .btn-feedback-delete:hover {
    background-color: #c82333 !important;
    border-color: #bd2130 !important;
}

/* ... (Sisa CSS Anda) ... */    /* "Belum ada feedback" */
    .no-feedback {
        text-align: center !important; padding: 25px !important; background-color: var(--feedback-frame-bg) !important;
        border-radius: 10px !important; color: var(--text-meta) !important; border: 1px solid var(--feedback-border-color) !important;
        margin-bottom: 25px !important;
    }
    .no-feedback p {
        color: var(--text-meta) !important;
    }
    .no-feedback i.fas { margin-right: 8px !important; font-size: 1.1rem !important; }

    /* Form Feedback */
    .feedback-form-container {
        background-color: #fff !important; border: 1px solid var(--feedback-border-color) !important;
        border-radius: 10px !important; padding: 25px !important; margin-top: 30px !important;
        box-shadow: var(--default-shadow) !important;
    }
    .feedback-form-container .form-label {
        color: var(--text-dark) !important;
        font-weight: 500 !important;
    }
     .feedback-form-container .feedback-section-title { /* Judul "Berikan Feedback Anda" */
        color: var(--text-dark) !important;
        font-size: 1.5rem !important;
        margin-bottom: 20px !important;
        padding-bottom: 10px !important;
        position: relative !important;
        display: inline-block !important;
    }
    .feedback-form-container .feedback-section-title::after {
        background-color: var(--primary-color) !important;

    }

    /* ... (CSS Anda yang lain, termasuk variabel warna) ... */

.feedback-section-title {
    font-size: 1.8rem !important;
    font-weight: 600 !important;
    color: var(--text-dark) !important;
    margin-bottom: 30px !important;
    position: relative !important; /* Diperlukan untuk positioning ::after */
    padding-bottom: 10px !important; /* Memberi ruang untuk garis bawah */
    display: inline-block !important; /* PENTING: Agar lebar elemen sesuai konten judul */
                                      /* Atau bisa juga 'inline-flex' jika ada ikon di dalam judul */
}

.feedback-section-title::after {
    content: '' !important;
    display: block !important;
    width: 100% !important; /* PENTING: Garis akan selebar judul */
    height: 3px !important;  /* Ketebalan garis */
    background: var(--primary-color) !important; /* Warna garis */
    position: absolute !important;
    bottom: 0 !important; /* Posisi garis di bagian bawah padding */
    left: 0 !important;   /* Mulai dari kiri judul */
}

/* ... (Sisa CSS Anda) ... */

    .invalid-feedback {
        color: var(--danger-color) !important;
    }

    /* Prompt Login */
    .login-prompt p {
        color: var(--text-dark) !important; /* Teks di login prompt hitam */
    }
    .login-prompt .prompt-button {
        display: inline-block !important; padding: 6px 15px !important; margin: 0 4px !important;
        border-radius: 20px !important; text-decoration: none !important; font-weight: 500 !important;
        font-size: 0.85rem !important; transition: all 0.3s ease !important;
        border: 1px solid transparent !important; vertical-align: middle !important;
    }
    .login-prompt .prompt-button-login {
        /* background-color: var(--primary-color) !important; color: white !important; */
        border-color: var(--primary-color) !important;
    }
    .login-prompt .prompt-button-login:hover {  border-color: #008374 !important; }
    .login-prompt .prompt-button-register {
        /* background-color: var(--primary-color) !important; color: #ffffff!important; */
        border-color: var(--primary-color) !important;
    }
    .login-prompt .prompt-button-register:hover { background-color: var(--primary-color) !important; color: white !important; }

    /* Tombol Kirim Feedback Utama */
    .btn-submit-feedback {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: white !important;
    }
    .btn-submit-feedback:hover {
        background-color: #0056b3 !important;
        border-color: #0056b3 !important;
    }

</style>

@extends('layouts.app')

@section('title', $berita->judul)
@section('description', Str::limit(strip_tags($berita->deskripsi), 150))
@section('keywords', 'berita, detail, himatif, ' . $berita->judul)

{{-- HAPUS @push('styles') ... @endpush jika CSS sudah di atas --}}

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
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="img-fluid" style="width: 100%; object-fit: cover; max-height: 500px;">
                            @else
                                <img src="{{ asset('assets/img/news.jpg') }}" alt="Default Image" class="img-fluid" style="width: 100%; object-fit: cover; max-height: 500px;">
                            @endif
                        </div>

                        <h1 class="entry-title" style="color:#000000">{{ $berita->judul }}</h1>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center">
                                    <i class="fas fa-clock"></i>
                                    <time datetime="{{ $berita->tanggal_upload ?? $berita->created_at }}">{{ \Carbon\Carbon::parse($berita->tanggal_upload ?? $berita->created_at)->translatedFormat('d F Y, H:i') }}</time>
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
                    } else if (strlen($names[0]) > 1) {
                        $initials = strtoupper(substr($names[0], 0, 2));
                    }
                } else {
                    $initials = 'AN';
                }
            @endphp
            <div class="feedback-item">
                <div class="feedback-avatar-container">
                    <div class="feedback-avatar" title="{{ $userName }}">
                        @if($userAvatar)
                            <img src="{{ asset('storage/' . $userAvatar) }}" alt="{{ $userName }}">
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
                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y, H:i') }} ({{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }})
                        </time>
                    </div>
                    <div class="feedback-content">
                        <p>{{ $item->isi }}</p>
                    </div>
                    {{-- ... di dalam loop @foreach ... --}}
@auth
    @if (Auth::user()->id == $item->user_id || (Auth::user()->role == 'admin'))
        <div class="feedback-actions"> {{-- Container ini akan kita jadikan flex --}}
            <a href="{{ route('feedback.edit', $item->id) }}" class="btn btn-sm btn-feedback-edit" title="Edit Feedback">
                <i class="fas fa-pencil-alt"></i> Edit
            </a>
            {{-- Form untuk tombol Hapus --}}
            <form action="{{ route('feedback.destroy', $item->id) }}" method="POST" class="form-feedback-delete"> {{-- Tambahkan class di sini --}}
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-feedback-delete" title="Hapus Feedback" onclick="return confirm('Apakah Anda yakin ingin menghapus feedback ini?')">
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
                                    <h4 class="feedback-section-title" style="font-size: 1.5rem; margin-bottom:20px; padding-bottom: 5px;">Berikan Feedback Anda</h4>
                                    {{-- ... (alert messages) ... --}}
                                     @if(session('success_feedback'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success_feedback') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form action="{{ route('feedback.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="berita_id" value="{{ $berita->id }}">
                                        <div class="mb-3">
                                            <label for="isi_feedback" class="form-label">Komentar Anda *</label>
                                            <textarea name="isi" id="isi_feedback" class="form-control @error('isi', 'feedback_form') is-invalid @enderror" rows="5" required placeholder="Tuliskan feedback Anda di sini...">{{ old('isi') }}</textarea>
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
                                    <p><i class="fas fa-check-circle"></i> Anda sudah memberikan feedback untuk berita ini. Anda dapat mengedit atau menghapusnya pada daftar di atas.</p>
                                </div>
                            @endif
                        @else
                            <div class="login-prompt">
                                <p><i class="fas fa-sign-in-alt"></i> Anda harus
                                    <a href="{{ route('login') }}" class="prompt-button prompt-button-login">login</a> atau
                                    <a href="{{ route('register') }}" class="prompt-button prompt-button-register">daftar</a>
                                    terlebih dahulu untuk memberikan feedback.
                                </p>
                            </div>
                        @endauth
                    </div>{{-- End Feedback Section --}}
                </div><!-- End Blog entries list -->

                <div class="col-lg-4">
                    {{-- ... Sidebar (Hapus style inline warna hitam dari sini) ... --}}
                     <div class="sidebar">
                        <div class="sidebar-item recent-posts">
                            <h3 class="sidebar-title fw-bold" style="color:#000000">Berita Terbaru Lainnya</h3>
                            <div class="mt-3">
                                @forelse ($recentBeritas as $recentBerita)
                                    @if($recentBerita->id != $berita->id)
                                    <div class="post-item mt-3">
                                        @if($recentBerita->gambar)
                                            <img src="{{ asset('storage/' . $recentBerita->gambar) }}" alt="{{ $recentBerita->judul }}" class="img-fluid mb-2" style="width:80px; height:60px; object-fit:cover; float:left; margin-right:15px; border-radius:5px;">
                                        @else
                                            <img src="{{ asset('assets/img/news.jpg') }}" alt="Default Image" class="img-fluid mb-2" style="width:80px; height:60px; object-fit:cover; float:left; margin-right:15px; border-radius:5px;">
                                        @endif
                                        <h4 style="font-size: 1rem; margin-bottom: 5px;"><a href="{{ route('beritas.show', $recentBerita->id) }}" style="text-decoration:none;">{{ Str::limit($recentBerita->judul, 50) }}</a></h4>
                                        <time datetime="{{ $recentBerita->tanggal_upload ?? $recentBerita->created_at }}" style="font-size:0.8rem;">{{ \Carbon\Carbon::parse($recentBerita->tanggal_upload ?? $recentBerita->created_at)->translatedFormat('d M Y') }}</time>
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

@endsection

@push('scripts')
<script>
    window.setTimeout(function() {
        $(".alert-success, .alert-danger").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
</script>
@endpush
