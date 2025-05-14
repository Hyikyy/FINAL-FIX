@extends('layouts.app')

@section('title', $berita->judul)
@section('description', $berita->deskripsi)
@section('keywords', 'berita, detail, ' . $berita->judul)

@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Detail Berita</h2>
                <ol>
                    <li><a href="{{ route('welcome') }}">Beranda</a></li>
                    <li><a href="{{ route('beritas.public') }}">Berita</a></li>
                    <li>Detail</li>
                </ol>
            </div>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Berita Detail Section ======= -->
    <section id="berita-detail" class="blog-details">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <div class="entry-img">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="img-fluid" style="width: 100%; object-fit: cover; max-height: 500px;">
                            @else
                                <img src="{{ asset('assets/img/news.jpg') }}" alt="Default Image" class="img-fluid" style="width: 100%; object-fit: cover; max-height: 500px;">
                            @endif
                        </div>

                        <h1 class="entry-title">
                            <a href="#">{{ $berita->judul }}</a>
                        </h1>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="{{ $berita->tanggal }}">{{ \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') }}</time></a></li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            <p>
                                {!! nl2br(e($berita->deskripsi)) !!}
                            </p>
                        </div>

                    </article><!-- End Blog Entry -->

                    {{-- Daftar Feedback --}}
                    <div class="feedback-list">
                        <h3 class="section-title">Feedback</h3>

                        @if ($berita->feedback->count() > 0)
                            @foreach ($berita->feedback as $feedback)
                                <div class="feedback-item">
                                    <h4>{{ $feedback->user ? $feedback->user->name : $feedback->nama }}</h4>
                                    <time datetime="{{ $feedback->tanggal }}">{{ \Carbon\Carbon::parse($feedback->tanggal)->format('d F Y, H:i') }}</time>
                                    <p>{{ $feedback->isi }}</p>

                                    @auth
                                        @if (Auth::user()->id == $feedback->user_id)
                                            <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus feedback ini?')">Hapus</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            @endforeach
                        @else
                            <p>Belum ada feedback.</p>
                        @endif
                    </div>

                    {{-- Form Feedback --}}
                    @auth
                        @php
                            $userHasFeedback = $berita->feedback()->where('user_id', Auth::id())->exists();
                        @endphp

                        @if (!$userHasFeedback)
                            <div class="feedback-form">
                                <h3 class="section-title">Berikan Feedback</h3>

                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('feedback.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="berita_id" value="{{ $berita->id }}">
                                 <input type="hidden" name="nama" value="{{ Auth::user()->name }}">

                                <div class="mb-3">
                                    <label for="tanggal">Tanggal *</label>
                                    <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', \Carbon\Carbon::now()->format('Y-m-d\TH:i')) }}" required>
                                    <small class="text-muted">Format: YYYY-MM-DD HH:MM</small>
                                </div>

                                <div class="mb-3">
                                    <label for="isi">Feedback *</label>
                                    <textarea name="isi" id="isi" class="form-control" rows="5" required>{{ old('isi') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Kirim Feedback</button>
                            </form>
                            </div>
                        @else
                            <p>Anda sudah memberikan feedback untuk berita ini.  Anda dapat mengedit atau menghapusnya di atas.</p>
                        @endif
                    @else
                        <p>Anda harus <a href="{{ route('login') }}">login</a> untuk memberikan feedback.</p>
                    @endauth

                </div><!-- End Blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">
                        {{-- Anda bisa menambahkan sidebar di sini, misalnya:
                            - Recent Posts
                            - Categories
                            - Tags
                            - Search Form
                        --}}
                        <div class="sidebar-item recent-posts">
                            <h3 class="sidebar-title">Berita Terbaru</h3>
                            <div class="mt-3">
                                @foreach ($recentBeritas as $recentBerita)
                                <div class="post-item clearfix">
                                    <h4><a href="{{ route('beritas.public', $recentBerita->id) }}">{{ $recentBerita->judul }}</a></h4>
                                    <time datetime="{{ $recentBerita->tanggal }}">{{ \Carbon\Carbon::parse($recentBerita->tanggal)->format('d F Y') }}</time>
                                </div>
                                @endforeach
                            </div>
                        </div><!-- End sidebar recent posts-->
                    </div><!-- End Blog Sidebar -->

                </div><!-- End Blog Sidebar -->

            </div>

        </div>
    </section><!-- End Berita Detail Section -->

</main><!-- End #main -->

@endsection