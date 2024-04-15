@extends('user.base')
@section('header')
    <meta name="description"
        content="sewa baliho, billboard, bando jalan, led banner, jpo, videotron, megatron di provinsi {{ strtolower(request('province')) }}">
    <meta name="keyword" content="baliho, billboard, bando jalan, led banner, jpo, videotron, megatron">
    <title>sewa baliho, billboard di provinsi {{ strtolower(request('province')) }}</title>
    <meta name="og:image" content="">
    <meta name="og:site_name" content="">
    <meta name="og:description"
        content="sewa baliho, billboard, bando jalan, led banner, jpo, videotron, megatron di provinsi {{ strtolower(request('province')) }}">
    <meta name="og:title" content="sewa baliho, billboard di provinsi {{ strtolower(request('province')) }}">
@endsection
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
                    <p class="title mb-4 ">Titik Billboard di {{ request('province') }}</p>
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

    <p class="title-content text-center">Titik di {{ request('province') }}</p>
    <div class="list-article">

        @foreach ($titik as $d)
            <a class="card-article" href="/detailtitik/{{ $d->slug }}">
                <img src="{{ $dom . $d->image3 }}" />

                <div class="article-content">
                    <div class="article-wrapper">
                        <p class="title">{{ $d->address }}</p>
                        <p class="time">{{ $d->city->province->name }}, {{ $d->city->name }}</p>
                        <hr>

                    </div>
                </div>
            </a>
        @endforeach

    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $titik->links() }}
    </div>
@endsection
