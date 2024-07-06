@extends('layout.landing')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <h3>{{ $data->judul_berita }}</h3>
        </div>
    </div>
    <div class="container-md mt-5">
        <div class="row">
            <div class="col-md-8 col-xxl-8 col-xl-8 col-sm-12">
                <div class="row" data-aos="zoom-in" data-aos-delay="100">
                    <div class="mb-5">
                        <img src="{{ asset('gambarBerita/' . $data->gambar) }}" alt="" class="w-100">
                    </div>
                    <div class="w-100">
                        @php
                            echo $data->isi_berita;
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
