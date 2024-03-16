@extends('user.base')

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
                    <img src="{{ asset('images/local/login.jpg') }}" />

                    <p class="title mb-3 ">Jalan A Yani, Manahan, Banjarsari, Surakarta, Jawa Tengah</p>

                    <div class="p-3">
                        <div class="row">
                            <div class="col-4">
                                <div class="info">
                                    <span class="material-symbols-outlined  ">
                                        location_on
                                    </span>
                                    <div>
                                        <p class="title-part">Lokasi Titik</p>
                                        <p class="content-part">Barat Terminal Tirtonadi Solo</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="info">
                                    <span class="material-symbols-outlined">
                                        location_city
                                    </span>
                                    <div>
                                        <p class="title-part">Kota</p>
                                        <p class="content-part">Surakarta</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-4">
                                <div class="info">
                                    <span class="material-symbols-outlined">
                                        area_chart
                                    </span>
                                    <div>
                                        <p class="title-part">Provinsi</p>
                                        <p class="content-part">Jawa Tengah</p>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class=" border rounded position-relative ">
                            <div class="w-100 d-flex justify-content-start pt-3 mb-3 ">
                                <span class="spesifikasi">Spesifikasi</span>
                            </div>
                            <div class="row p-3">
                                <div class="col-4">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            mms
                                        </span>
                                        <div>
                                            <p class="title-part">Type Media</p>
                                            <p class="content-part">Billboard</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-4">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            output_circle
                                        </span>
                                        <div>
                                            <p class="title-part">Sisi</p>
                                            <p class="content-part">1 Sisi</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-4">

                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            decimal_increase
                                        </span>
                                        <div>
                                            <p class="title-part">Jumlah</p>
                                            <p class="content-part">1 Media Iklan</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-4">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            move_selection_left
                                        </span>
                                        <div>
                                            <p class="title-part">Posisi</p>
                                            <p class="content-part">Horizontal</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-4">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            trending_flat
                                        </span>
                                        <div>
                                            <p class="title-part">Panjang</p>
                                            <p class="content-part">10 Meter</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-4">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            arrow_upward
                                        </span>
                                        <div>
                                            <p class="title-part">Tinggi</p>
                                            <p class="content-part">5 Meter</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            traffic
                                        </span>
                                        <div>
                                            <p class="title-part">Trafik /hari</p>
                                            <p class="content-part">14567</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <p class="title-content ">Titik Kami yang Lain</p>

        <div class="list-article">

            @for ($i = 0; $i < 20; $i++)
                <div class="card-article">
                    <img src="{{ asset('images/local/login.jpg') }}" />

                    <div class="article-content">
                        <div class="article-wrapper">
                            <p class="title">Jl. Slamet Riyadi no 123 Banjarsari Surakarta</p>
                            <p class="time">Jawa Tengah, Surakarta</p>
                            <hr>

                            <div class="btn-wrapper">
                                <a href="/detailtitik/slug-titik"><span>Lihat Titik</span><span
                                        class="material-symbols-outlined">
                                        arrow_right_alt
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor

        </div>
    @endsection
