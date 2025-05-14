@extends('layouts.app')

@section('title', 'Edit Feedback')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Edit Feedback</h2>
                    <ol>
                        <li><a href="{{ route('welcome') }}">Beranda</a></li>
                        <li><a href="{{ route('beritas.public', $feedback->berita_id) }}">Detail Berita</a></li>
                        <li>Edit Feedback</li>
                    </ol>
                </div>
            </div>
        </div><!-- End Breadcrumbs -->

        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">

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

                        <form action="{{ route('feedback.update', $feedback->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="tanggal">Tanggal *</label>
                                <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', \Carbon\Carbon::parse($feedback->tanggal)->format('Y-m-d\TH:i')) }}" required>
                                <small class="text-muted">Format: YYYY-MM-DD HH:MM</small>
                            </div>

                            <div class="mb-3">
                                <label for="isi">Feedback *</label>
                                <textarea name="isi" id="isi" class="form-control" rows="5" required>{{ old('isi', $feedback->isi) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Feedback</button>
                            <a href="{{ route('beritas.show', $feedback->berita_id) }}" class="btn btn-secondary">Kembali</a>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection