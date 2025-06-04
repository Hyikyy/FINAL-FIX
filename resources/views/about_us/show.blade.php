@extends('layouts.app')

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

    <!-- ======= Detail Section ======= -->
    <section id="details" class="team">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow" style="border: 1px solid #000;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <div style="border-right: 1px solid #000; height: 100%; padding: 10px;">
                                    @if($data->gambar)
                                        @php
                                            $imagePath = '';
                                            if($type == 'Dosen'){
                                                $imagePath = asset('storage/images/' . $data->gambar);
                                            } elseif($type == 'Asisten Dosen') {
                                                $imagePath = asset('storage/teaching_assistants/' . $data->gambar);
                                            } else {
                                                $imagePath = asset('storage/' . $data->gambar);
                                            }
                                        @endphp
                                        <img src="{{ $imagePath }}" class="card-img rounded-left" alt="{{ $data->nama }}" style="object-fit: cover; height: 100%; width: 100%;">
                                    @else
                                        <img src="{{ asset('assets/img/no-image.png') }}" class="card-img rounded-left" alt="Default Image" style="object-fit: cover; height: 100%; width: 100%;">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" style="padding: 20px; position: relative;">
                                    <h4 class="card-title" style="color: black; margin-bottom: 15px;"><strong>{{ $data->nama }}</strong></h4>
                                    <p class="card-text" style="margin-bottom: 10px; color:#000000">
                                        @if($type != 'Alumni')
                                            <strong>Jabatan:</strong> {{ $data->nama_jabatan ?? 'Tidak ada jabatan' }}
                                        @else
                                            {{ $data->nama_cantik ?? 'Tidak ada nama cantik' }}
                                        @endif
                                    </p>

                                    @if($type != 'Alumni')
                                        <p class="card-text" style="margin-bottom: 10px; color:#000000">
                                            <strong style="color:#000000">Deskripsi:</strong>
                                            <div style="overflow-x: auto; white-space: normal;">
                                                {!! nl2br(e($data->deskripsi_jabatan ?? $data->deskripsi ?? 'Tidak ada deskripsi.')) !!}
                                            </div>
                                        </p>
                                    @endif

                                    @if(isset($data->email))
                                        <p class="card-text" style="margin-bottom: 10px; color:#000000"><strong>Email:</strong> {{ $data->email }}</p>
                                    @endif

                                    @if(isset($data->bidang_keahlian))
                                        <p class="card-text" style="margin-bottom: 10px;color:#000000"><strong>Bidang Keahlian:</strong> {{ $data->bidang_keahlian }}</p>
                                    @endif
                                            <br><br><br>
                                    <div style="position: absolute; bottom: 20px; right: 20px;">
                                        <a href="{{ route('dosen.showPublic') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Detail Section -->

</main><!-- End #main -->

@endsection
