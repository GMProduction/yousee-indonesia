@extends('user.base')

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
            <a class="btn-pasangiklan">
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
            @for ($i = 1; $i < 15; $i++)
                <img class="client" loading="lazy" src="{{ asset('images/local/clients/' . $i . '.webp') }}" />
            @endfor

        </div>
    </div>


    {{-- TESTIMONIES --}}
    <div class="g-container-testimoni">
        <div class="title-container">
            <p class="title">Pelanggan Kami
                yang Puas</p>

            <div class="arrow-container">
                <a class="arrow">
                    <img src="{{ asset('images/local/icon/chevron_left.png') }}" />
                </a>

                <a class="arrow">
                    <img src="{{ asset('images/local/icon/chevron_right.png') }}" />
                </a>
            </div>
        </div>
        <div class="row  gx-5">
            @for ($i = 0; $i < 4; $i++)
                <div class="col-3">
                    <div class="testimoni-card">
                        <p class="quote">“</p>
                        <p class="testimoni-text ">“Iklan ini benar-benar mengubah cara saya melihat produk ini. Saya sangat
                            puas
                            dengan kreativitas
                            dan efektivitasnya.”</p>
                        <hr>
                        <div class="testimoni-profile">
                            <img class="testimoni-profpic" src="{{ asset('images/local/login.jpg') }}" />
                            <div>
                                <p class="testimoni-name">Joko Paryanto</p>
                                <p class="testimoni-position">CEO (Logan Food)</p>
                                <span>
                                    <img src="{{ asset('images/local/star.png') }}" />
                                    <img src="{{ asset('images/local/star.png') }}" />
                                    <img src="{{ asset('images/local/star.png') }}" />
                                    <img src="{{ asset('images/local/star.png') }}" />
                                    <img src="{{ asset('images/local/star.png') }}" />
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor

        </div>

    </div>


    <div class="mb-5"></div>
    {{-- PORTFOLIO --}}
    <div class="g-portfolio">
        <p class="title ">Portfolio Kami</p>
        <div class="portfolio-wrapper">
            <div class="portfolio">
                <img src="{{ asset('images/local/login.jpg') }}" />
            </div>
            <div class="portfolio">
                <img src="{{ asset('images/local/login.jpg') }}" />
            </div>
            <div class="portfolio">
                <img src="{{ asset('images/local/login.jpg') }}" />
            </div>
            <div class="portfolio">
                <img src="{{ asset('images/local/login.jpg') }}" />
            </div>
            <div class="portfolio">
                <img src="{{ asset('images/local/login.jpg') }}" />
            </div>
            <div class="portfolio">
                <img src="{{ asset('images/local/login.jpg') }}" />
            </div>
            <div class="portfolio">
                <img src="{{ asset('images/local/login.jpg') }}" />
            </div>
            <div class="portfolio">
                <img src="{{ asset('images/local/login.jpg') }}" />
            </div>
        </div>
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


    <script src="{{ asset('js/fitty.min.js') }}"></script>
    <script>
        fitty('.fittopage');
    </script>
@endsection()
