@extends('user.base')

@section('morecss')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"
        integrity="sha256-FZsW7H2V5X9TGinSjjwYJ419Xka27I8XPDmWryGlWtw=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
        integrity="sha256-5uKiXEwbaQh9cgd2/5Vp6WmMnsUr3VZZw0a8rKnOKNU=" crossorigin="anonymous">
@endsection

@section('content')
    @php
        $locale = app()->getLocale();
    @endphp
    <div class="g-hero">
        <img class="hero-logo" src="{{ asset('images/local/logo-yousee.png') }}" />
        <div class="hero-text">
            <img src="{{ asset('images/local/titikseluruhindonesia' . (app()->getLocale() === 'en' ? '_engver' : '') . '.png') }}"
                class="img-titikseluruhindonesia" />

        </div>
        <img class="hero-image mb-5" src="{{ asset('images/local/indonesiamaps.png') }}" />

        <br>
        <a class="btn-pasangiklan mt-5" href="{{ url($locale . '/titik-kami') }}">
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

    <section class="achievement-hero-section position-relative d-flex align-items-center"
        style="background-image: url('{{ asset('images/local/penghargaan.jpg') }}');">

        {{-- <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-25"></div> --}}

        <div class="container position-relative z-2 py-5">
            <div class="row justify-content-end py-lg-5">
                <div class="col-lg-6 col-xl-5 ms-auto" data-aos="fade-up" data-aos-duration="1200">

                    <div class="glass-card p-4 p-md-5 rounded-5 text-white">
                        <div
                            class="d-inline-flex align-items-center gap-2 mb-4 px-3 py-2 rounded-pill bg-white bg-opacity-10 border border-white border-opacity-25">
                            <i class="bi bi-trophy-fill text-warning"></i>
                            <span class="text-uppercase ls-1 fw-bold small">Penghargaan & Sertifikasi</span>
                        </div>

                        <h2 class="display-5 fw-bolder mb-4" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                            Bukti Nyata Komitmen Kualitas & Inovasi.
                        </h2>

                        <p class="lead text-white-50 mb-5" style="font-weight: 300;">
                            Diakui secara resmi oleh pemimpin industri global. Berbagai penghargaan ini menegaskan posisi
                            YouSee sebagai mitra teknologi display terpercaya di Indonesia.
                        </p>

                        <button type="button"
                            class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm hover-glow d-flex align-items-center gap-3"
                            data-bs-toggle="modal" data-bs-target="#achievementsGridModal">
                            <span class="text-black">Lihat Galeri Penghargaan</span>
                            <i class="bi bi-arrow-right-circle-fill text-primary fs-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="achievementsGridModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 rounded-5 shadow-lg overflow-hidden">

                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <div>
                        <h4 class="fw-bold mb-1">Galeri Sertifikat</h4>
                        <p class="text-muted small">Klik pada gambar untuk melihat detail dokumen.</p>
                    </div>
                    <button type="button" class="btn-close bg-light p-2 rounded-circle"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">

                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm achievement-thumb cursor-pointer"
                                onclick="viewDetail(this)" data-title="Quality Management System"
                                data-desc="Quality Management System."
                                data-file="{{ asset('images/local/iso-9001.jpg') }}">
                                <div class="thumb-wrapper overflow-hidden rounded-3 position-relative bg-light">
                                    <img src="{{ asset('images/local/iso-9001.jpg') }}"
                                        class="w-100 h-100 object-fit-cover thumb-img" alt="Thumbnail">

                                    <div class="thumb-overlay d-flex align-items-center justify-content-center">
                                        <i class="bi bi-eye-fill text-white fs-3"></i>
                                    </div>
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-danger text-uppercase"
                                        style="font-size: 0.6rem;">PDF</span>
                                </div>

                                <div class="card-body p-3 text-center">
                                    <h6 class="fw-bold text-dark mb-0 small text-truncate">Quality Management System</h6>
                                    <small class="text-muted" style="font-size: 0.7rem;">ISO 9001.jpg</small>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm achievement-thumb cursor-pointer"
                                onclick="viewDetail(this)" data-title="Anti bribery Management System"
                                data-desc="Anti bribery Management System."
                                data-file="{{ asset('images/local/iso-37001.jpg') }}">
                                <div class="thumb-wrapper overflow-hidden rounded-3 position-relative bg-light">
                                    <img src="{{ asset('images/local/iso-37001.jpg') }}"
                                        class="w-100 h-100 object-fit-cover thumb-img" alt="Thumbnail">

                                    <div class="thumb-overlay d-flex align-items-center justify-content-center">
                                        <i class="bi bi-eye-fill text-white fs-3"></i>
                                    </div>
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-danger text-uppercase"
                                        style="font-size: 0.6rem;">PDF</span>
                                </div>

                                <div class="card-body p-3 text-center">
                                    <h6 class="fw-bold text-dark mb-0 small text-truncate">Anti bribery Management System
                                    </h6>
                                    <small class="text-muted" style="font-size: 0.7rem;">ISO 37001.jpg</small>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm achievement-thumb cursor-pointer"
                                onclick="viewDetail(this)" data-title="Occupational Healt & Safety Management System"
                                data-desc="Occupational Healt & Safety Management System."
                                data-file="{{ asset('images/local/iso-45001.jpg') }}">
                                <div class="thumb-wrapper overflow-hidden rounded-3 position-relative bg-light">
                                    <img src="{{ asset('images/local/iso-45001.jpg') }}"
                                        class="w-100 h-100 object-fit-cover thumb-img" alt="Thumbnail">

                                    <div class="thumb-overlay d-flex align-items-center justify-content-center">
                                        <i class="bi bi-eye-fill text-white fs-3"></i>
                                    </div>
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-danger text-uppercase"
                                        style="font-size: 0.6rem;">PDF</span>
                                </div>

                                <div class="card-body p-3 text-center">
                                    <h6 class="fw-bold text-dark mb-0 small text-truncate">Occupational Healt & Safety
                                        Management System</h6>
                                    <small class="text-muted" style="font-size: 0.7rem;">ISO 45001</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="achievementDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg bg-dark text-white">

                <div class="modal-header border-0 pb-0">
                    <h6 class="modal-title fw-bold text-white" id="detailTitle">Title Here</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-0 text-center position-relative d-flex align-items-center justify-content-center bg-black rounded-bottom-4 overflow-hidden"
                    style="min-height: 400px; max-height: 80vh;">

                    <img id="detailImg" src="" class="img-fluid d-none" style="max-height: 75vh;"
                        alt="Detail">

                    <iframe id="detailPdf" src="" class="w-100 h-100 d-none"
                        style="min-height: 500px; border:0;"></iframe>

                </div>

                <div class="modal-footer border-0 pt-0 bg-dark rounded-bottom-4">
                    <p id="detailDesc" class="text-white-50 small mb-0 w-100 text-center"></p>
                </div>
            </div>
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

    <script>
        // Variable global untuk modal detail
        let detailModalInstance = null;

        function viewDetail(element) {
            const title = element.getAttribute('data-title');
            const desc = element.getAttribute('data-desc');
            const fileUrl = element.getAttribute('data-file'); // URL File Asli

            // 1. Isi Konten Modal Detail
            document.getElementById('detailTitle').innerText = title;
            document.getElementById('detailDesc').innerText = desc;

            const imgEl = document.getElementById('detailImg');
            const pdfEl = document.getElementById('detailPdf');

            // 2. Cek Tipe File (PDF atau Gambar)
            if (fileUrl.toLowerCase().endsWith('.pdf')) {
                imgEl.classList.add('d-none');
                pdfEl.classList.remove('d-none');
                pdfEl.src = fileUrl;
            } else {
                pdfEl.classList.add('d-none');
                imgEl.classList.remove('d-none');
                imgEl.src = fileUrl;
            }

            // 3. Buka Modal Detail
            // Note: Modal Grid di belakangnya biarkan tetap terbuka
            const modalEl = document.getElementById('achievementDetailModal');

            if (detailModalInstance) {
                detailModalInstance.show();
            } else {
                detailModalInstance = new bootstrap.Modal(modalEl);
                detailModalInstance.show();
            }
        }

        // Opsional: Bersihkan src iframe saat modal ditutup agar video/pdf berhenti load
        document.getElementById('achievementDetailModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('detailPdf').src = "";
            document.getElementById('detailImg').src = "";
        });
    </script>
@endsection
