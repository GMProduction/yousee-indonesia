@extends('user.base')

@section('morecss')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
@endsection
@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/carititik.png') }}" />
        </div>
        <div class="pencarian-container">
            <div class="pencarian-content">
                <div class="pencarian-wrapper">
                    <p class="title">Tersedia titik diseluruh INDONESIA</p>
                    <div class="prov-wrapper">
                        <a class="prov"><img src="{{ asset('images/local/icon/provinsi/jakarta.webp') }}" /><span>DKI
                                Jakarta</span></a>
                        <a class="prov"><img src="{{ asset('images/local/icon/provinsi/jawabarat.png') }}" />Jawa
                            Barat</a>
                        <a class="prov"><img src="{{ asset('images/local/icon/provinsi/jawatengah.png') }}" />Jawa
                            Tengah</a>
                        <a class="prov"><img src="{{ asset('images/local/icon/provinsi/jawatimur.png') }}" />Jawa
                            Timur</a>
                        <a class="prov"><img src="{{ asset('images/local/icon/provinsi/jogja.png') }}" />DI Yogyakarta</a>
                        <a class="prov"><img src="{{ asset('images/local/icon/provinsi/bali.jpg') }}" />BALI</a>

                        <a class="prov"><img src="{{ asset('images/local/icon/provinsi/sumaterautara.png') }}" />SUMATERA
                            UTARA</a>
                        <a class="prov"><img src="{{ asset('images/local/icon/provinsi/sumaterabarat.png') }}" />SUMATERA
                            BARAT</a>
                        <a class="prov"><img
                                src="{{ asset('images/local/icon/provinsi/sumateraselatan.png') }}" />SUMATERA SELATAN</a>
                        <a class="prov"><img
                                src="{{ asset('images/local/icon/provinsi/kalimantan.png') }}" />KALIMANTAN</a>
                        <a class="prov"><img src="{{ asset('images/local/icon/provinsi/sulawesi.png') }}" />SULAWESI</a>
                        <a class="prov"><img src="{{ asset('images/local/icon/provinsi/papua.png') }}" />PAPUA</a>
                        <a class="prov"><img src="{{ asset('images/local/icon/provinsi/maluku.png') }}" />MALUKU</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <p class="title-content text-center">Titik di Jawa Tengah</p>
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
                            <a href="#"><span>Lihat Titik</span><span class="material-symbols-outlined">
                                    arrow_right_alt
                                </span></a>
                        </div>
                    </div>
                </div>
            </div>
        @endfor

    </div>
@endsection
