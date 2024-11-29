@extends('user.base')

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
                        <a class="prov" href="/titik/DKI JAKARTA"><img
                                src="{{ asset('images/local/icon/provinsi/jakarta.webp') }}" /><span>DKI
                                Jakarta</span></a>
                        <a class="prov" href="/titik/JAWA BARAT"><img
                                src="{{ asset('images/local/icon/provinsi/jawabarat.png') }}" />Jawa
                            Barat</a>
                        <a class="prov" href="/titik/JAWA TENGAH"><img
                                src="{{ asset('images/local/icon/provinsi/jawatengah.png') }}" />Jawa
                            Tengah</a>
                        <a class="prov" href="/titik/JAWA TIMUR"><img
                                src="{{ asset('images/local/icon/provinsi/jawatimur.png') }}" />Jawa
                            Timur</a>
                        <a class="prov" href="/titik/DI YOGYAKARTA"><img
                                src="{{ asset('images/local/icon/provinsi/jogja.png') }}" />DI Yogyakarta</a>
                        <a class="prov" href="/titik/BALI"><img
                                src="{{ asset('images/local/icon/provinsi/bali.jpg') }}" />BALI</a>

                        <a class="prov" href="/titik/SUMATERA UTARA"><img
                                src="{{ asset('images/local/icon/provinsi/sumaterautara.png') }}" />SUMATERA
                            UTARA</a>
                        <a class="prov" href="/titik/SUMATERA BARAT"><img
                                src="{{ asset('images/local/icon/provinsi/sumaterabarat.png') }}" />SUMATERA
                            BARAT</a>
                        <a class="prov" href="/titik/SUMATERA SELATAN"><img
                                src="{{ asset('images/local/icon/provinsi/sumateraselatan.png') }}" />SUMATERA SELATAN</a>
                        <a class="prov" href="/titik/KALIMANTAN"><img
                                src="{{ asset('images/local/icon/provinsi/kalimantan.png') }}" />KALIMANTAN</a>
                        <a class="prov" href="/titik/SULAWESI"><img
                                src="{{ asset('images/local/icon/provinsi/sulawesi.png') }}" />SULAWESI</a>
                        <a class="prov" href="/titik/PAPUA"><img
                                src="{{ asset('images/local/icon/provinsi/papua.png') }}" />PAPUA</a>
                        <a class="prov" href="/titik/MALUKU"><img
                                src="{{ asset('images/local/icon/provinsi/maluku.png') }}" />MALUKU</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <p class="title-content text-center">Titik Kami</p>
    <div class="section-description ">
        <p>Kami bangga memiliki jaringan titik yang luas dan beragam, mencakup seluruh wilayah Indonesia. Dengan titik-titik
            kami yang tersebar di berbagai provinsi, kami siap membantu Anda menjangkau audiens Anda dimanapun mereka
            berada. Keberadaan titik kami yang banyak dan strategis ini memungkinkan kami untuk memberikan layanan terbaik
            bagi kebutuhan promosi dan informasi Anda.
        </p>


    </div>
    <div class="list-titik">

        @foreach ($titik as $d)
            <a class="card-article" href="/listing/{{ $d->slug }}">

                <img src="{{ $dom . $d->image2 }}" />
                <div
                    style="position: absolute; top: 50%; right: 0; transform: translateY(-50%); background-color: green; padding: 2px 10px; border-radius: 5px 0 0 5px; font-size: 0.8rem; color: white;">
                    {{ $titik[0]->type->name }}</div>
                <div class="article-content">
                    <div class="article-wrapper">
                        <p class="title mt-2"> {{ $d->city->province->name }}</p>
                        <p class="time">{{ $d->city->name }}</p>
                        <p class="alamat">{{ $d->address }}</p>
                        <hr>


                    </div>
                </div>
            </a>
        @endforeach


        {{--        @for ($i = 0; $i < 20; $i++) --}}
        {{--            <div class="card-article"> --}}
        {{--                <img src="{{ asset('images/local/login.jpg') }}" /> --}}

        {{--                <div class="article-content"> --}}
        {{--                    <div class="article-wrapper"> --}}
        {{--                        <p class="title">Jl. Slamet Riyadi no 123 Banjarsari Surakarta</p> --}}
        {{--                        <p class="time">Jawa Tengah, Surakarta</p> --}}
        {{--                        <hr> --}}

        {{--                        <div class="btn-wrapper"> --}}
        {{--                            <a href="/listing/slug-titik"><span>Lihat Titik</span><span --}}
        {{--                                    class="material-symbols-outlined"> --}}
        {{--                                    arrow_right_alt --}}
        {{--                                </span></a> --}}
        {{--                        </div> --}}
        {{--                    </div> --}}
        {{--                </div> --}}
        {{--            </div> --}}
        {{--        @endfor --}}

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
            ScrollReveal().reveal('.list-titik', slideUp);
            ScrollReveal().reveal('.g-hero', slideUp);
            // Tambahkan lebih banyak elemen sesuai kebutuhan
        });
    </script>
@endsection
