@extends('user.base')

@section('morecss')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
@endsection
@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/getintouch.png') }}" />
        </div>
        <div class="pencarian-container contact">
            <div class="pencarian-content w-100">
                <div class="pencarian-wrapper ">
                    <div class="row ">
                        <div class="col-md-8  col-sm-12 p-sm-20 sm-mb-30">
                            <p class="title mb-0 text-start  ">Berikan Kami Pesan</p>
                            <p class="title mb-3 text-start  "> atau Kritik dan Saran</p>
                            <div class="d-flex position-relative ">

                                <form class="flex-grow-1 ">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="p-nama" name="p-nama"
                                            placeholder="Nama">
                                        <label for="p-nama" class="form-label">Nama</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="p-nowa" name="p-nowa"
                                            placeholder="Nomor Whatsapp">
                                        <label for="p-nowa" class="form-label">Nomor Whatsapp</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <textarea type="text" class="form-control" id="p-pesan" name="p-pesan" rows="5" placeholder="pesan"
                                            style="min-height: 200px"></textarea>
                                        <label for="p-pesan" class="form-label">Pesan</label>
                                    </div>


                                    <div class="w-100 d-flex  justify-content-start  ">
                                        <button type="submit" class="btn btn-primary  ">Submit</button>

                                    </div>
                                </form>
                                <div class="me-3 ms-3 sm-none " style="width: 1px; border : 1px solid #eee"></div>
                            </div>

                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="contact">

                                <p class="header">Contact Us</p>
                                <p class="text"><span><img class="icon-text"
                                            src="{{ asset('images/local/icon/home-address.png') }}" /></span>Jalan
                                    Balai Pustaka No.23,RW 6/RW 15, Rawamangun, Kecamatan Pulo Gadung, Kota Jakarta
                                    Timur, DKI
                                    Jakarta 13220 </p>
                                <p class="text"> <span style="min-width: 50px"></span>Jl. Yos Sudarso No.19B, Tj. Anom,
                                    Kwarasan,
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

                            <div class="contact">
                                <p class="header">Our Social Media</p>
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
                                            <circle class="cls-637b8512f95e86b59c57a11c-1" cx="12" cy="12"
                                                r="4.77">
                                            </circle>
                                            <circle class="cls-637b8512f95e86b59c57a11c-2" cx="18.2" cy="5.8"
                                                r="1.43">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-map">
        <iframe class="maps"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d293.9466519176885!2d110.81705148983241!3d-7.590324536466774!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a1729b9b85ab1%3A0xe17f1069e9cba7a0!2sSEE%20DIGITAL%20AGENCY!5e0!3m2!1sen!2sid!4v1709533137084!5m2!1sen!2sid"
            style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
    <div class="morethan10000">
        <img src="{{ asset('images/local/city.jpg') }}" />
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
            <p>Tersedia lebih dari 10.000 titik billboard, menjangkau beragam target audiens di seluruh wilayah dengan
                efektif
                dan efisien </p>
            <div class="d-flex justify-content-center ">
                <a class="btn-pasangiklan">
                    Pasang Iklan Sekarang
                </a>
            </div>
        </div>
    </div>
@endsection
