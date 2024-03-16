@extends('user.base')

@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/youseeservices.png') }}" />
        </div>
    </div>


    <div class="g-services ">

        <div class="g-menu " role="tablist">
            <a class="menu active" data-bs-toggle="pill" href="#services1">
                Billboard
            </a>
            <a class="menu" data-bs-toggle="pill" href="#services2">
                Baliho
            </a>
            <a class="menu" data-bs-toggle="pill" href="#services3">
                Bando Jalan
            </a>
            <a class="menu" data-bs-toggle="pill" href="#services4">
                Videotron
            </a>
            <a class="menu" data-bs-toggle="pill" href="#services5">
                Megatron
            </a>
            <a class="menu" data-bs-toggle="pill" href="#services6">
                JPO
            </a>
            <a class="menu" data-bs-toggle="pill" href="#services7">
                Led Banner
            </a>
        </div>


        <div class="tab-content">
            <div id="services1" class="tab-pane active">
                <div class="g-content ">
                    <img src="{{ asset('images/local/login.jpg') }}">
                    <div class="text">
                        <p class="title">
                            Billboard
                        </p>
                        <hr>
                        <p class="definition">
                            Lorem ipsum dolor sit amet consectetur. Consequat aenean a sagittis et tincidunt sapien. A ut
                            sit
                            dignissim nulla eros. Arcu cum enim ante vestibulum dui risus risus amet. Ornare nec lorem
                            vivamus
                            pulvinar sem eleifend in non tortor.
                        </p>
                    </div>
                </div>
            </div>

            <div id="services2" class="tab-pane fade">
                <div class="g-content">
                    <img src="{{ asset('images/local/login.jpg') }}">
                    <div class="text">
                        <p class="title">
                            #2
                        </p>
                        <hr>
                        <p class="definition">
                            Lorem ipsum dolor sit amet consectetur. Consequat aenean a sagittis et tincidunt sapien. A ut
                            sit
                            dignissim nulla eros. Arcu cum enim ante vestibulum dui risus risus amet. Ornare nec lorem
                            vivamus
                            pulvinar sem eleifend in non tortor.
                        </p>
                    </div>
                </div>
            </div>
            <div id="services3" class="tab-pane fade">
                <div class="g-content">
                    <img src="{{ asset('images/local/login.jpg') }}">
                    <div class="text">
                        <p class="title">
                            #3
                        </p>
                        <hr>
                        <p class="definition">
                            Lorem ipsum dolor sit amet consectetur. Consequat aenean a sagittis et tincidunt sapien. A ut
                            sit
                            dignissim nulla eros. Arcu cum enim ante vestibulum dui risus risus amet. Ornare nec lorem
                            vivamus
                            pulvinar sem eleifend in non tortor.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="space-between-menus"></div>
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
@endsection
