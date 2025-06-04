@extends('layouts.app')

@section('title', 'Agenda Kegiatan HIMATIF')
@section('description', 'Daftar agenda kegiatan terbaru dari HIMATIF.')
@section('keywords', 'agenda, kegiatan, himatif')

@section('content')

  <main id="main">

    <!-- ======= Agenda Section ======= -->
    <section id="agenda" class="agenda" style="margin-top: 50px; margin-bottom: 0px;">
      <div class="container" data-aos="fade-up">

        <div class="section-title" style="margin-top: 70px;">
          <h2>Agenda Terbaru</h2>
          <p>Ikuti terus agenda kegiatan HIMATIF untuk mendapatkan informasi terkini.</p>
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Nama Kegiatan</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($agendas as $agenda)
              <tr>
                <td>{{ \Carbon\Carbon::parse($agenda->tanggal_kegiatan)->isoFormat('dddd, D MMMM YYYY') }}</td>
                <td>{{ $agenda->nama_kegiatan }}</td>
                <td>{{ Str::limit($agenda->deskripsi, 150) }}</td>
                <td>
                  <a href="{{ route('agendas.public', $agenda->id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="mt-5 d-flex justify-content-center">

        </div>

      </div>
    </section><!-- End Agenda Section -->

  </main><!-- End #main -->

@endsection
