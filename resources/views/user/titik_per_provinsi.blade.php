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
                    <p class="title mb-4 ">Titik Billboard di Jawa Tengah</p>
                    <p>Dengan memiliki titik billboard di seluruh Indonesia, Anda memiliki kesempatan luar biasa untuk
                        mencapai audiens yang luas dan beragam di seluruh negeri. Dari pantai-pantai eksotis di Bali hingga
                        jalan-jalan sibuk di Jakarta, dan dari pedesaan di Jawa hingga kota-kota kosmopolitan di Sumatera,
                        titik billboard Anda tersebar di seluruh negeri. Ini memberi Anda keunggulan kompetitif untuk
                        memasarkan produk atau layanan Anda kepada masyarakat Indonesia dengan cara yang kuat dan efektif.
                    </p>
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
