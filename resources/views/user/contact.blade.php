@extends('user.base')


@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/getintouch.png') }}" />
        </div>
        <div class="pencarian-container contact">
            <div class="pencarian-content w-100">
                <div class="pencarian-wrapper ">
                    <div class="row ">
                        <div class="col-md-8 col-sm-12 p-sm-20 sm-mb-30">
                            <p class="title mb-0 text-start">{{ __('messages.Berikan_Kami_Pesan') }}</p>
                            <p class="title mb-3 text-start">{{ __('messages.atau_Kritik_dan_Saran') }}</p>

                            @if (session('message'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <div class="d-flex position-relative">
                                <form class="flex-grow-1" method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="p-nama" name="name"
                                            placeholder="{{ __('messages.nama') }}">
                                        <label for="p-nama" class="form-label">{{ __('messages.nama') }}</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" id="phone" name="phone" class="form-control"
                                            pattern="[0-9\s]{11,14}" required />
                                        <label for="p-nowa" class="form-label">{{ __('messages.no_wa') }}</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <textarea type="text" class="form-control" id="p-pesan" name="message" rows="5"
                                            placeholder="{{ __('messages.pesan') }}" style="min-height: 200px"></textarea>
                                        <label for="p-pesan" class="form-label">{{ __('messages.pesan') }}</label>
                                    </div>

                                    <div class="w-100 d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

                                <div class="me-3 ms-3 sm-none" style="width: 1px; border: 1px solid #eee"></div>
                            </div>
                        </div>


                        <div class="col-md-4 col-sm-12">
                            <div class="contact">

                                <p class="header">Contact Us</p>
                                <p class="text"><span><img class="icon-text"
                                            src="{{ asset('images/local/icon/home-address.png') }}" /></span>{{ $profiles[0]->head_office_address }}
                                </p>
                                <p class="text"> <span style="min-width: 50px"></span>{{ $profiles[0]->address }}</p>
                                <p class="text"><span><img class="icon-text"
                                            src="{{ asset('images/local/icon/phone.png') }}" /></span>{{ $profiles[0]->phone }}
                                </p>
                                <p class="text"><span><img class="icon-text"
                                            src="{{ asset('images/local/icon/whatsapp.png') }}" /></span> <a
                                        class="d-block" style="color: grey;"
                                        href="https://wa.me/6281393700771?text=Halo,%20Yousee-indonesia.com"
                                        target="_blank">
                                        {{ preg_replace('/^0/', '62', $profiles[0]->whatsapp) }}</a></p>
                                <p class="text"><span><img class="icon-text"
                                            src="{{ asset('images/local/icon/email.png') }}" /></span>{{ $profiles[0]->email }}
                                </p>
                            </div>

                            <div class="contact">
                                <p class="header">Our Social Media</p>
                                <div class="g-nav-social d-flex ">
                                    <a href="{{ $profiles[0]->instagram }}" target="_blank">
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
                                    <a href="{{ $profiles[0]->facebook }}" target="_blank">
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
                                    <a href="{{ $profiles[0]->tiktok }}" target="_blank">
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
    <div class="morethan10000">
        <img src="{{ asset('images/local/city.jpg') }}" />
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
            <p>{{ trans('messages.10.000_titik_billboard_strategi') }} </p>
            <div class="d-flex justify-content-center ">
                <a class="btn-pasangiklan" href="https://wa.me/6281393700771?text=Halo,%20Yousee-indonesia.com"
                    target="_blank">
                    {{ trans('messages.pasang_sekarang') }}
                </a>
            </div>
        </div>
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
            ScrollReveal().reveal('.contact-map', slideUp);
            ScrollReveal().reveal('.g-container-clients', slideUp);
            ScrollReveal().reveal('.morethan10000', slideUp);

            // Tambahkan lebih banyak elemen sesuai kebutuhan
        });
    </script>
@endsection
