@extends('user.base')

@section('morecss')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"
        integrity="sha256-FZsW7H2V5X9TGinSjjwYJ419Xka27I8XPDmWryGlWtw=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
        integrity="sha256-5uKiXEwbaQh9cgd2/5Vp6WmMnsUr3VZZw0a8rKnOKNU=" crossorigin="anonymous">
@endsection

@section('content')
    <div class="g-hero">
        <img class="hero-logo" src="{{ asset('images/local/logo-yousee.png') }}" />
        <div class="hero-text">
            <img src="{{ asset('images/local/titikseluruhindonesia.png') }}" class="img-titikseluruhindonesia" />
        </div>
        <img class="hero-image" src="{{ asset('images/local/indonesiamaps.png') }}" />
    </div>

    <div class="g-info">
        <div class="info container ">
            <span class="score">5</span>
            <div class="d-flex flex-column ">
                <span class="definition">Tahun </span>
                <span class="definition">Pengalaman </span>
            </div>
        </div>
        <div class="line"></div>
        <div class="info container ">
            <span class="score">2K+</span>
            <div class="d-flex flex-column ">
                <span class="definition">Titik Iklan </span>
                <span class="definition">Strategis </span>
            </div>
        </div>
        <div class="line"></div>
        <div class="info container ">
            <span class="score">8K+</span>
            <div class="d-flex flex-column ">
                <span class="definition">Happy</span>
                <span class="definition">Customer </span>
            </div>
        </div>
        <div class="line"></div>
        <div class="info container ">
            <span class="score">4,6</span>
            <div class="d-flex flex-column ">
                <span class="definition">Overal</span>
                <span class="definition">Rating </span>
            </div>
        </div>
    </div>

    <div class="mb-5"></div>
    <div class="g-container-left">
        <div class="content">
            <p class="title">Titik Strategis Tersebar di Seluruh Indonesia</p>
            <p class="text">Menyediakan lebih dari 10.000 titik iklan billboard. Sebaran titik iklan yang luas, mampu
                menjangkau hingga
                seluruh kota di Indonesia. Kemudahan dalam sewa billboard berbeda wilayah. Atur harga sewa billboard
                Anda,
                pilih durasi tayang mulai dari mingguan ataupun bulanan.
            </p>
            <a class="btn-pasangiklan"
                href="https://api.whatsapp.com/send?phone=6281226059817&text=Halo%2C%20saya%20mau%20tanya%20tentang%20pasang%20billboard"
                target="_blank">
                Pasang Iklan Sekarang
            </a>
        </div>

        <img src="{{ asset('images/local/resize-indo.png') }}" alt="titik-iklan-billboard-indonesia" />
    </div>

    {{-- CLIENTS --}}
    <div class="g-container-clients">
        <div class="content">
            <p class="title">Our Happy Clients</p>
            <p class="text">Sebagai perusahaan billboard, kami telah dipercaya untuk mengerjakan pemasangan iklan
                dengan berbagai macam media seperti billboard, baliho, LED Banner, JPO, Bando Jalan & Videotron. Mulai
                dari brand multinasional hingga institusi pemerintahan sudah mempercayakan kebutuhan iklan luar ruang
                kepada kami.


            </p>
            <div class="mb-5"></div>

        </div>

        <div class="client-list">
            @foreach ($clients as $client)
                <img class="client" loading="lazy" src="{{ asset($client->image) }}" />
            @endforeach

        </div>
    </div>


    {{-- TESTIMONIES --}}
    <div class="g-container-testimoni">




        <section class="splide" aria-label="Splide Basic HTML Example">
            <div class="title-container">
                <p class="title">Pelanggan Kami
                    yang Puas</p>
                <div class="arrow-container splide__arrows">
                    <button class="arrow splide__arrow--prev">
                        <img src="{{ asset('images/local/icon/chevron_left.png') }}" />
                    </button>
                    <button class="arrow splide__arrow--next">
                        <img src="{{ asset('images/local/icon/chevron_right.png') }}" />
                    </button>
                </div>
            </div>

            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($testimonies as $testimoni)
                        <li class="splide__slide">
                            <div class="testimoni-card">
                                <p class="quote">“</p>
                                <p class="testimoni-text ">“{{ $testimoni->content }}”</p>
                                <hr>
                                <div class="testimoni-profile">
                                    <img class="testimoni-profpic" src="{{ asset($testimoni->image) }}" />
                                    <div>
                                        <p class="testimoni-name">{{ $testimoni->name }}</p>
                                        <span>
                                            @for ($i = 0; $i < $testimoni->star; $i++)
                                                <img src="{{ asset('images/local/star.png') }}" />
                                            @endfor

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>



    <div class="mb-5"></div>
    {{-- PORTFOLIO --}}
    <div class="g-portfolio">
        <p class="title mb-0">Portfolio Kami</p>
    </div>
    <div role="main">
        <ul class="tiles-wrap animated" id="wookmark1">
            <!-- These are our grid blocks -->
            @foreach ($portfolios as $portfolio)
                <li>
                    <img src="{{ asset($portfolio->image) }}" />
                </li>
            @endforeach

        </ul>
    </div>

    {{-- ONE WEEK SERVICES --}}
    <div class="oneweek-services">
        <img src={{ asset('images/local/calendar.jpg') }} />
        <div>
            <p class="title">Pasang Iklan Billboard 1 Minggu Tetap Dilayani. Fleksibel!</p>
            <p class="text">Maksimalkan performa iklan Anda, kami rekomendasikan untuk memasang lebih dari 1 titik di
                wilayah yang
                berbeda dengan durasi yang sama. Dengan jangkauan lebih dari 10.000 titik iklan, pemasangan iklan
                billboardmu bisa dimulai dengan durasi 1 minggu saja. Sebebas itu!</p>
            <a class="btn-pasangiklan">
                Konsultasi Gratis
            </a>
        </div>
    </div>
@endsection

@section('morejs')
    <script>
        var splide = new Splide('.splide', {
            classes: {
                arrows: 'splide__arrows your-class-arrows',
                arrow: 'splide__arrow your-class-arrow',
                prev: 'splide__arrow--prev your-class-prev',
                next: 'splide__arrow--next your-class-next',
            },
            breakpoints: {
                1366: {
                    perPage: 3,

                },
                1024: {
                    perPage: 2,

                },
                767: {
                    perPage: 1,

                },

            },
            type: 'loop',
            perPage: 4,
            perMove: 1,
            prevArrow: $('#prev'),
            nextArrow: $('#next'),
            pagination: false,
        });

        splide.mount();

        <
        script type = "text/javascript" >
            window.onload = function() {
                var wookmark1 = new Wookmark("#wookmark1", {
                    outerOffset: 10, // Optional, the distance to the containers border
                    itemWidth: 210, // Optional, the width of a grid item
                });
            }; <
        />
    </script>
@endsection
