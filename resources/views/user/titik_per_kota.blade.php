@extends('user.base')
@section('header')
    <meta name="description"
        content="sewa baliho, billboard, bando jalan, led banner, jpo, videotron, megatron di kota {{ strtolower(request('city')) }}">
    <meta name="keyword" content="baliho, billboard, bando jalan, led banner, jpo, videotron, megatron">
    <title>sewa baliho, billboard di Kota {{ strtolower(request('city')) }}</title>
    <meta name="og:image" content="">
    <meta name="og:site_name" content="">
    <meta name="og:description"
        content="sewa baliho, billboard, bando jalan, led banner, jpo, videotron, megatron di kota {{ strtolower(request('city')) }}">
    <meta name="og:title" content="sewa baliho, billboard di kota {{ strtolower(request('city')) }}">
@endsection

@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/carititik.png') }}" />
        </div>
        <div class="pencarian-container">
            <div class="pencarian-content">
                <div class="pencarian-wrapper">
                    <p class="title mb-4 ">Titik Billboard di {{ request('city') }}</p>
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

    <p class="title-content text-center">Titik di {{ request('city') }}</p>
    <div class="list-titik">

        @foreach ($titik as $d)
            <a class="card-article" href="/listing/{{ $d->slug }}">
                <img src="{{ $dom . $d->image2 }}" />
                <div
                    style="position: absolute; top: 50%; right: 0; transform: translateY(-50%); background-color: green; padding: 2px 10px; border-radius: 5px 0 0 5px; font-size: 0.8rem; color: white;">
                    {{ $titik[0]->type->name }}</div>
                <div class="article-content">
                    <div class="article-wrapper">
                        <p class="title mt-2"> {{ $d->city->name }}</p>
                        <p class="time">{{ $d->city->name }}</p>
                        <p class="alamat">{{ $d->address }}</p>
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

@section('morejs')
    <script>
        var slideUp = {
            distance: '50%',
            origin: 'bottom',
            delay: 300,
        };
        document.addEventListener('DOMContentLoaded', function() {
            ScrollReveal().reveal('.g-hero', slideUp);
            ScrollReveal().reveal('.list-titik', slideUp);
        });
    </script>
@endsection
