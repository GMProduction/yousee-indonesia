@extends('user.base')

@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/youseeservices.png') }}" />
        </div>
    </div>

    <div class="g-services">

        <div class="g-menu">
            <a class="menu active">
                Billboard
            </a>
            <a class="menu">
                Baliho
            </a>
            <a class="menu">
                Bando Jalan
            </a>
            <a class="menu">
                Videotron
            </a>
            <a class="menu">
                Megatron
            </a>
            <a class="menu">
                JPO
            </a>
            <a class="menu">
                Led Banner
            </a>
        </div>


        <div class="g-content">



            <img
                src="data:image/jpeg;base64,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">
            <div class="text">
                <p class="title">
                    Billboard
                </p>
                <hr>
                <p class="definition">
                    Lorem ipsum dolor sit amet consectetur. Consequat aenean a sagittis et tincidunt sapien. A ut sit
                    dignissim nulla eros. Arcu cum enim ante vestibulum dui risus risus amet. Ornare nec lorem vivamus
                    pulvinar sem eleifend in non tortor.
                </p>
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
