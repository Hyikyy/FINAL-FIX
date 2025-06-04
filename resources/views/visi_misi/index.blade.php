@extends('layouts.app')

@section('title', 'Struktur Organisasi')
@section('description', 'Struktur Organisasi HIMATIF')
@section('keywords', 'struktur, organisasi, himatif')

@section('content')

  <main id="main">

            <!-- ======= Visi Misi Section ======= -->
        <section id="visi-misi" class="team" style="margin-top: 30px; margin-bottom: 10px;">
            <div class="container" data-aos="fade-up">

                <div class="section-header" style="margin-top: 65px; margin-bottom: 10px;">
                    <h2 class="text-center fw-bold" style="color: black;">Visi dan Misi HIMATIF</h2>  <!-- Tambahkan fw-bold dan style -->
                    <p class="text-center">Berikut adalah visi dan misi Himpunan Mahasiswa Teknologi Informasi.</p>
                </div>

                <div class="row">
                    <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="card" style="border: 1px solid #343a40;">  <!-- Tambahkan style border -->
                            <div class="card-body">
                                <h5 class="card-title">Visi</h5>
                                @if(count($visiMisi) > 0 && !empty(trim($visiMisi[0]->visi))) {{-- Menambahkan pengecekan !empty(trim(...)) --}}
                                    {{-- AWAL PERUBAHAN UNTUK VISI --}}
                                    <div style="padding-left: 0px; line-height: 1.6;"> {{-- Menghapus padding-left dari <ol> dan menambahkan line-height --}}
                                        {!! nl2br(e(trim($visiMisi[0]->visi))) !!}
                                    </div>
                                    {{-- AKHIR PERUBAHAN UNTUK VISI --}}
                                @else
                                    Belum ada visi yang ditetapkan.
                                @endif

                                <hr>  <!-- Garis pemisah -->

                                <h5 class="card-title">Misi</h5>
                                <ol style="list-style-type: decimal; padding-left: 20px;">
                                    @if(count($visiMisi) > 0 && !empty(trim($visiMisi[0]->misi))) {{-- Menambahkan pengecekan !empty(trim(...)) --}}
                                        @php
                                            $misi = $visiMisi[0]->misi;
                                            $misi = str_replace(["\r\n", "\r"], "\n", $misi);
                                            $misiLines = explode("\n", $misi);
                                        @endphp
                                        @foreach($misiLines as $misiLine)
                                            @php
                                                $misiLine = trim($misiLine);
                                            @endphp
                                            @if(!empty($misiLine))
                                                <li>{{ $misiLine }}</li>
                                            @endif
                                        @endforeach
                                    @else
                                        Belum ada misi yang ditetapkan.
                                    @endif
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Visi Misi Section -->

</main><!-- End #main -->

@endsection
