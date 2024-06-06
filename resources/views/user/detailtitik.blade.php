@extends('user.base')
@section('header')
    <meta name="description"
        content="{{ $data ? $data->type->name . ' - ' . $data->address . ' - ' . $data->location : '' }}">
    <meta name="keyword" content="{{ $data->type->name }}">
    <meta name="og:image" content="">
    <meta name="og:site_name" content="">
    <meta name="og:description"
        content="{{ $data ? $data->type->name . ' - ' . $data->address . ' - ' . $data->location : '' }}">
    <meta name="og:title" content="{{ $data ? $data->address : '' }}">
@endsection
@section('morecss')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
@endsection
@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/titikseluruhindonesia.png') }}" />
        </div>
        <div class="detail-titik">
            <div class="detailtitik-content">
                <div class="detailtitik-wrapper">
                    <img src="{{ $dom . $data->image2 }}" />

                    <p class="title mb-3 ">{{ $data->address }}</p>

                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="info">
                                    <span class="material-symbols-outlined  ">
                                        location_on
                                    </span>
                                    <div>
                                        <p class="title-part">Lokasi Titik</p>
                                        <p class="content-part">{{ $data->location }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="info">
                                    <span class="material-symbols-outlined">
                                        location_city
                                    </span>
                                    <div>
                                        <p class="title-part">Kota</p>
                                        <p class="content-part">{{ $data->city->name }}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="info">
                                    <span class="material-symbols-outlined">
                                        area_chart
                                    </span>
                                    <div>
                                        <p class="title-part">Provinsi</p>
                                        <p class="content-part">{{ $data->city->province->name }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class=" border rounded position-relative ">
                            <div class="w-100 d-flex justify-content-start pt-3 mb-3 ">
                                <span class="spesifikasi">Spesifikasi</span>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-4 col-sm-6">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            mms
                                        </span>
                                        <div>
                                            <p class="title-part">Type Media</p>
                                            <p class="content-part">{{ $data->type->name }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            output_circle
                                        </span>
                                        <div>
                                            <p class="title-part">Sisi</p>
                                            <p class="content-part">{{ $data->side }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 col-sm-12">

                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            decimal_increase
                                        </span>
                                        <div>
                                            <p class="title-part">Jumlah</p>
                                            <p class="content-part">{{ $data->address }}</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            move_selection_left
                                        </span>
                                        <div>
                                            <p class="title-part">Posisi</p>
                                            <p class="content-part">{{ $data->position }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            trending_flat
                                        </span>
                                        <div>
                                            <p class="title-part">Panjang</p>
                                            <p class="content-part">{{ $data->width }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            arrow_upward
                                        </span>
                                        <div>
                                            <p class="title-part">Tinggi</p>
                                            <p class="content-part">{{ $data->height }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            traffic
                                        </span>
                                        <div>
                                            <p class="title-part">Trafik /hari</p>
                                            <p class="content-part">{{ $data->trafic }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="title-content ">Titik Kami yang Lain di {{ $data->city->name }}</p>

    <div class="list-article">

        @foreach ($titik as $d)
            <div class="card-article">
                <img src="{{ $dom . $d->image2 }}" />

                <div class="article-content">
                    <div class="article-wrapper">
                        <p class="title">{{ $d->address }}</p>
                        <p class="time">{{ $d->city->province->name }}, {{ $d->city->name }}</p>
                        <hr>

                        <div class="btn-wrapper">
                            <a href="/detailtitik/{{ $d->slug }}"><span>Lihat Titik</span><span
                                    class="material-symbols-outlined">
                                    arrow_right_alt
                                </span></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@section('morejs')
    <script>
        var slideUp = {
            distance: '50%',
            origin: 'bottom',
            delay: 300,
        };
        document.addEventListener('DOMContentLoaded', function() {
            ScrollReveal().reveal('.g-hero', slideUp);
            ScrollReveal().reveal('.detail-titik', slideUp);
        });
    </script>
@endsection
