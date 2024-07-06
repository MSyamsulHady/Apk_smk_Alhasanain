@extends('layout.landing')
@section('content')
    <section id="hero" class="d-flex justify-content-center align-items-center">

    </section>
    <main id="main">


        <!-- ======= Popular Courses Section ======= -->
        <section id="popular-courses" class="courses">
            <div class="container">

                <div class="section-title">
                    <p>BERITA</p>
                </div>

                <div class="row">
                    @foreach ($berita as $item)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                            <div class="course-item">
                                <img src="{{ asset('gambarBerita/' . $item->gambar) }}" class="img-fluid" alt="...">
                                <div class="course-content mt-3">
                                    <h3>{{ $item->judul_berita }}</h3>
                                    <div class="trainer-rank d-flex align-items-center">
                                        <a href="{{ route('detailBerita', $item->id_berita) }}"
                                            class="btn btn-sm btn-outline-info">lihat >></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Popular Courses Section -->

    </main>
@endsection
