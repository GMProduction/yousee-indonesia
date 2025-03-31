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
            <img src="{{ asset('images/local/titikseluruhindonesia' . (app()->getLocale() === 'en' ? '_engver' : '') . '.png') }}"
                class="img-titikseluruhindonesia" />

        </div>
        <img class="hero-image mb-5" src="{{ asset('images/local/indonesiamaps.png') }}" />

        <br>
        <a class="btn-pasangiklan mt-5" href="/titik-kami">
            {{ trans('messages.pilih_titik_sekarang') }}
        </a>
    </div>

    <div class="g-info">
        <div class="info container ">
            <span class="score tahun-pengalaman">0</span>
            <div class="d-flex flex-column ">
                <span class="definition">{{ trans('messages.tahun') }} </span>
                <span class="definition">{{ trans('messages.pengalaman') }} </span>
            </div>
        </div>
        <div class="line"></div>
        <div class="info container ">
            <span class="score  titikstrategis">0</span>
            <div class="d-flex flex-column ">
                <span class="definition">{{ trans('messages.home_titik_iklan') }} </span>
                <span class="definition">{{ trans('messages.home_strategis') }} </span>
            </div>
        </div>
        <div class="line"></div>
        <div class="info container ">
            <span class="score happycustomer">0</span>
            <div class="d-flex flex-column ">
                <span class="definition">Happy</span>
                <span class="definition">Customer </span>
            </div>
        </div>
        <div class="line"></div>
        <div class="info container ">
            <span class="score overalrating">0</span>
            <div class="d-flex flex-column ">
                <span class="definition">Overal</span>
                <span class="definition">Rating </span>
            </div>
        </div>
    </div>

    <div class="mb-5"></div>
    <div class="g-container-left">
        <div class="content">
            {{-- <h1>{{ trans('messages.about') }}</h1>
            <a href="{{ route('change.language', 'en') }}">English</a> |
            <a href="{{ route('change.language', 'id') }}">Indonesia</a>
            @php
                dump(App::getLocale());
                dump(lang_path('id/messages.php'));
            @endphp --}}
            <p class="title">{{ trans('messages.titik_tersebar_indonesia') }}</p>
            <p class="text">{{ trans('messages.10000_titik') }}
            </p>
            <a class="btn-pasangiklan" href="https://wa.me/6281393700771?text=Halo,%20Yousee-indonesia.com" target="_blank">
                {{ trans('messages.pasang_sekarang') }}
            </a>
        </div>

        <img src="{{ asset('images/local/resize-indo.png') }}" alt="titik-iklan-billboard-indonesia" />
    </div>

    {{-- CLIENTS --}}
    <div class="g-container-clients">
        <div class="content">
            <p class="title">Our Happy Clients</p>
            <p class="text">{{ trans('messages.happy_client_description') }}


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
                <p class="title">{{ trans('messages.pelanggan_puas') }}</p>
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
        <p class="title mb-0">{{ trans('messages.portfolio_kami') }}</p>
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
        <img src={{ asset('images/local/calendar2.png') }} />
        <div>
            <p class="title">{{ trans('messages.billboard_cepat') }}</p>
            <p class="text">{{ trans('messages.10.000_titik_billboard_strategi') }}</p>
            <a class="btn-pasangiklan" href="https://wa.me/6281393700771?text=Halo,%20Yousee-indonesia.com" target="_blank">
                {{ trans('messages.konsultasi_gratis') }}
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
    </script>
    <script type="text/javascript">
        window.onload = function() {
            var itemWidth = window.innerWidth < 820 ? 110 : 210;

            var wookmark1 = new Wookmark("#wookmark1", {
                outerOffset: 10, // Optional, the distance to the containers border
                itemWidth: itemWidth, // Optional, the width of a grid item
            });
        };

        // Opsional: Mendengarkan perubahan ukuran jendela untuk mengatur ulang lebar item
        window.addEventListener('resize', function() {
            var newWidth = window.innerWidth < 820 ? 110 : 210;
            if (newWidth !== itemWidth) {
                itemWidth = newWidth;
                wookmark1.updateOptions({
                    itemWidth: itemWidth
                });
            }
        });
    </script>

    <script>
        var slideUp = {
            distance: '50%',
            origin: 'bottom',
            delay: 300,
        };
        document.addEventListener('DOMContentLoaded', function() {
            ScrollReveal().reveal('.g-hero', slideUp);
            ScrollReveal().reveal('.g-info', slideUp);
            ScrollReveal().reveal('.g-container-left', slideUp);
            ScrollReveal().reveal('.g-container-clients', slideUp);
            ScrollReveal().reveal('.g-container-testimoni', slideUp);
            ScrollReveal().reveal('.g-portfolio', slideUp);
            ScrollReveal().reveal('.oneweek-services', slideUp);
            // Tambahkan lebih banyak elemen sesuai kebutuhan
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Fungsi animateValue seperti sebelumnya
            function animateValue(obj, start, end, duration, suffix = '') {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    const value = Math.floor(progress * (end - start) + start);
                    obj.innerHTML = (value >= 1000 ? Math.floor(value / 1000) + 'K' : value) + (progress === 1 ?
                        suffix : ''); // Mengonversi nilai ke format K ketika lebih dari atau sama dengan 1000
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            // Fungsi observer untuk menjalankan animasi
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {

                        const tahunPengalamanElement = document.querySelector('.tahun-pengalaman');
                        if (tahunPengalamanElement) {
                            animateValue(tahunPengalamanElement, 0, 5, 1000); // Durasi 500ms
                        }

                        const titikstrategisElement = document.querySelector('.titikstrategis');
                        if (titikstrategisElement) {
                            animateValue(titikstrategisElement, 0, 2000,
                                1000, '+'); // Durasi 1000ms, dari 0 ke 2000
                        }

                        const happycustomerElement = document.querySelector('.happycustomer');
                        if (happycustomerElement) {
                            animateValue(happycustomerElement, 0, 8000, 1000, '+'); // Durasi 500ms
                        }

                        const overalratingElement = document.querySelector('.overalrating');
                        if (overalratingElement) {
                            animateValue(overalratingElement, 0, 4, 1000, ',6'); // Durasi 500ms
                        }

                        // observer.unobserve(target); // Stop observing target after animation
                    }
                });
            }, {
                threshold: 0.1 // Trigger when 10% of the element is in the viewport
            });

            // Menambahkan elemen yang ingin di-observe
            document.querySelectorAll('.score').forEach((elem) => {
                observer.observe(elem);
            });
        });

        document.addEventListener("scroll", function() {
            var scrolledHeight = window.pageYOffset;
            var parallaxElement = document.querySelector('.oneweek-services'),
                limit = parallaxElement.offsetTop + parallaxElement.offsetHeight;
            if (scrolledHeight > parallaxElement.offsetTop && scrolledHeight <= limit) {
                parallaxElement.style.backgroundPositionY = (scrolledHeight - parallaxElement.offsetTop) / 2 + "px";
            } else {
                parallaxElement.style.backgroundPositionY = "0";
            }
        });
    </script>
@endsection
