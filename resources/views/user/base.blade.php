<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Yousee Indonesia || Sewa Billboard, Media Iklan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    {{-- BOOTSTRAP --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- CSS --}}
    <link href="{{ asset('css/genosstyle.v.01.css') }}" rel="stylesheet" />

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Thambi+2:wght@400;500;700;800&display=swap"
        rel="stylesheet">


    {{-- DATA TABLES --}}
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />


    {{-- ICON --}}


    {{-- SWEEET ALERT --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css"
        integrity="sha256-h2Gkn+H33lnKlQTNntQyLXMWq7/9XI2rlPCsLsVcUBs=" crossorigin="anonymous">


    @yield('morecss')

</head>

<body>
    <nav class="g-navbar container ">
        <img src="{{ asset('images/local/logo-yousee-panjang.png') }}" />
        <div class="g-nav-menu">
            <a class="menu active" href="/">Home<span class="indicator "></span></a>
            <a class="menu" href="/services">Services<span class="indicator"></span></a>
            <a class="menu" href="/titik-kami">Titik Kami<span class="indicator"></span></a>
            <a class="menu" href="/portfolio">Portfolio<span class="indicator"></span></a>
            <a class="menu" href="/artikel">Artikel<span class="indicator"></span></a>
            <a class="menu" href="/contact">Contact<span class="indicator"></span></a>
        </div>
        <div class="g-nav-social">
            <a>
                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    stroke-width="1.5" width="20" height="20">
                    <defs>
                        <style>
                            .cls-637b8512f95e86b59c57a11c-1 {
                                fill: none;
                                stroke: currentColor;
                                stroke-miterlimit: 10;
                            }

                            .cls-637b8512f95e86b59c57a11c-2 {
                                fill: currentColor;
                            }
                        </style>
                    </defs>
                    <rect class="cls-637b8512f95e86b59c57a11c-1" x="1.5" y="1.5" width="21" height="21"
                        rx="3.82"></rect>
                    <circle class="cls-637b8512f95e86b59c57a11c-1" cx="12" cy="12" r="4.77"></circle>
                    <circle class="cls-637b8512f95e86b59c57a11c-2" cx="18.2" cy="5.8" r="1.43"></circle>
                </svg>
            </a>
            <a>
                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    stroke-width="1.5" width="20" height="20">
                    <defs>
                        <style>
                            .cls-637b8512f95e86b59c57a116-1 {
                                fill: none;
                                stroke: currentColor;
                                stroke-miterlimit: 10;
                            }
                        </style>
                    </defs>
                    <path class="cls-637b8512f95e86b59c57a116-1"
                        d="M17.73,6.27V1.5h-1A7.64,7.64,0,0,0,9.14,9.14v.95H6.27v3.82H9.14V22.5h4.77V13.91h2.86V10.09H13.91V9.14a2.86,2.86,0,0,1,2.86-2.87Z">
                    </path>
                </svg></a>
            <a>
                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    stroke-width="1.5" width="20" height="20">
                    <defs>
                        <style>
                            .cls-637b8512f95e86b59c57a137-1 {
                                fill: none;
                                stroke: currentColor;
                                stroke-miterlimit: 10;
                            }
                        </style>
                    </defs>
                    <path class="cls-637b8512f95e86b59c57a137-1"
                        d="M12.94,1.61V15.78a2.83,2.83,0,0,1-2.83,2.83h0a2.83,2.83,0,0,1-2.83-2.83h0a2.84,2.84,0,0,1,2.83-2.84h0V9.17h0A6.61,6.61,0,0,0,3.5,15.78h0a6.61,6.61,0,0,0,6.61,6.61h0a6.61,6.61,0,0,0,6.61-6.61V9.17l.2.1a8.08,8.08,0,0,0,3.58.84h0V6.33l-.11,0a4.84,4.84,0,0,1-3.67-4.7H12.94Z">
                    </path>
                </svg>
            </a>
        </div>

    </nav>
    @yield('content')

    {{-- ONE TIME --}}
    <div class="onetime-services">


        <div class="content">
            <p class="title">Dapatkan Harga Sewa Billboard dalam Satu Waktu. Praktis!</p>
            <p class="text">Dapatkan paket penawaran dari beberapa lokasi billboard yang kamu inginkan. Siap
                mennjangkau
                audiens lebih
                luas hingga di seluruh wilayah di Indonesia. Daftar harga sewa billboard langsung kami kirim secara
                cepat,
                tepat, akurat!</p>
            <a class="btn-pasangiklan">
                Dapatkan Harga Sewa
            </a>
        </div>

        <img class="imagefooter2" src="{{ asset('images/local/footerimage2.png') }}" />


    </div>


    <footer class="footer">
        <div class="row gx-3 ">
            <div class="col-4">
                <img class="footer-logo" src="{{ asset('images/local/logo-yousee.png') }}" />

                <p class="footer-tag">Pasang Iklan Billboard di Seluruh INDONESIA</p>
            </div>
            <div class="col-4">
                <p class="header">Contact Us</p>
                <p class="text"><span><img class="icon-text"
                            src="{{ asset('images/local/icon/home-address.png') }}" /></span>Jalan
                    Balai Pustaka No.23,RW 6/RW 15, Rawamangun, Kecamatan Pulo Gadung, Kota Jakarta
                    Timur, DKI
                    Jakarta 13220 </p>
                <p class="text"> <span style="min-width: 50px"></span>Jl. Yos Sudarso No.19B, Tj. Anom, Kwarasan,
                    Kec.
                    Grogol,
                    Kab. Sukoharjo, Jawa Tengah
                    57552</p>
                <p class="text"><span><img class="icon-text"
                            src="{{ asset('images/local/icon/phone.png') }}" /></span>0271-6008012</p>
                <p class="text"><span><img class="icon-text"
                            src="{{ asset('images/local/icon/whatsapp.png') }}" /></span> 0812 2605 9817</p>
                <p class="text"><span><img class="icon-text"
                            src="{{ asset('images/local/icon/email.png') }}" /></span>official@yousee-indonesia.com
                </p>
            </div>

            <div class="col-4">
                <p class="header">Social Media</p>
                <div class="g-nav-social">
                    <a>
                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" stroke-width="1.5" width="20" height="20">
                            <defs>
                                <style>
                                    .cls-637b8512f95e86b59c57a11c-1 {
                                        fill: none;
                                        stroke: currentColor;
                                        stroke-miterlimit: 10;
                                    }

                                    .cls-637b8512f95e86b59c57a11c-2 {
                                        fill: currentColor;
                                    }
                                </style>
                            </defs>
                            <rect class="cls-637b8512f95e86b59c57a11c-1" x="1.5" y="1.5" width="21"
                                height="21" rx="3.82"></rect>
                            <circle class="cls-637b8512f95e86b59c57a11c-1" cx="12" cy="12" r="4.77">
                            </circle>
                            <circle class="cls-637b8512f95e86b59c57a11c-2" cx="18.2" cy="5.8" r="1.43">
                            </circle>
                        </svg>
                    </a>
                    <a>
                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" stroke-width="1.5" width="20" height="20">
                            <defs>
                                <style>
                                    .cls-637b8512f95e86b59c57a116-1 {
                                        fill: none;
                                        stroke: currentColor;
                                        stroke-miterlimit: 10;
                                    }
                                </style>
                            </defs>
                            <path class="cls-637b8512f95e86b59c57a116-1"
                                d="M17.73,6.27V1.5h-1A7.64,7.64,0,0,0,9.14,9.14v.95H6.27v3.82H9.14V22.5h4.77V13.91h2.86V10.09H13.91V9.14a2.86,2.86,0,0,1,2.86-2.87Z">
                            </path>
                        </svg></a>
                    <a>
                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" stroke-width="1.5" width="20" height="20">
                            <defs>
                                <style>
                                    .cls-637b8512f95e86b59c57a137-1 {
                                        fill: none;
                                        stroke: currentColor;
                                        stroke-miterlimit: 10;
                                    }
                                </style>
                            </defs>
                            <path class="cls-637b8512f95e86b59c57a137-1"
                                d="M12.94,1.61V15.78a2.83,2.83,0,0,1-2.83,2.83h0a2.83,2.83,0,0,1-2.83-2.83h0a2.84,2.84,0,0,1,2.83-2.84h0V9.17h0A6.61,6.61,0,0,0,3.5,15.78h0a6.61,6.61,0,0,0,6.61,6.61h0a6.61,6.61,0,0,0,6.61-6.61V9.17l.2.1a8.08,8.08,0,0,0,3.58.84h0V6.33l-.11,0a4.84,4.84,0,0,1-3.67-4.7H12.94Z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
        <hr>
        <div class="d-flex justify-content-between  ">
            <p>
                © 2024 Yousee Indonesia, All Rights Reserved
            </p>


        </div>
    </footer>
</body>

</html>
