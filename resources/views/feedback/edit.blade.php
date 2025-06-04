@extends('layouts.app')

@section('title', 'Edit Feedback')

@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2></h2>
                    <ol>
                        <li></li>
                        <li></li>
                        <li></li>
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
                                <label for="isi">Feedback *</label>
                                <textarea name="isi" id="isi" class="form-control" rows="5" required>{{ old('isi', $feedback->isi) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Feedback</button>
                            <a href="{{ route('beritas.show', $feedback->berita_id) }}" class="btn btn-secondary">Back</a>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
