@extends('user.base')
@section('title', $data->address)
@section('header')
    <meta name="description"
        content="{{ $data ? $data->type->name . ' - ' . $data->address . ' - ' . $data->location : '' }}">
    <meta name="keyword" content="{{ $data->type->name }}">
    <meta name="og:image" content="">
    <meta name="og:site_name" content="">
    <meta name="og:description"
        content="{{ $data ? $data->type->name . ' - ' . $data->address . ' - ' . $data->location : '' }}">
    <meta name="og:title" content="{{ $data ? $data->address : '' }}">
@endsection
@section('morecss')
@endsection
@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/titikseluruhindonesia.png') }}" />
        </div>
        <div class="detail-titik">
            <div class="detailtitik-content">
                <div class="detailtitik-wrapper">
                    <img src="{{ $dom . $data->image2 }}" />

                    <div class="row  mb-5">
                        <!-- Kolom 1 -->
                        <div class="col">
                            <button id="addToCartButton" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                                class="btn btn-primary d-flex align-items-center justify-content-center">
                                <!-- Ikon keranjang di kiri -->
                                <span>Read More</span>
                            </button>
                        </div>
                        <!-- Kolom 2 -->
                        <div class="col">
                            <button id="addToCartButton"
                                onclick="addToCart({{ $data->id }}, '{{ $data->address }}', '{{ $data->slug }}')"
                                class="btn btn-secondary d-flex align-items-center justify-content-center">
                                <i class="material-symbols-outlined me-3">shopping_cart</i>
                                <!-- Ikon keranjang di kiri -->
                                <span>{{ trans('messages.masukan_keranjang') }}</span>
                            </button>
                        </div>
                        <!-- Kolom 3 -->
                        <div class="col">
                            <a id="addToCartButton" href="{{ url(app()->getLocale() . '/titik-kami') }}"
                                class="btn btn-third d-flex align-items-center justify-content-center">
                                <!-- Ikon keranjang di kiri -->
                                <span>{{ trans('messages.lihat_titik_lain') }}</span>
                            </a>
                        </div>
                    </div>


                    <div class="collapse" id="collapseExample">

                        <p class="title mb-3 ">{{ trans('messages.sewa') }} {{ $data->type->name }}
                            {{ ucfirst(strtolower(trim(str_replace(['KOTA ', 'KABUPATEN '], '', $data->city->name)))) }}
                            <br> {{ $data->address }}
                        </p>

                        <div class="p-3">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="info">
                                        <span class="material-symbols-outlined  ">
                                            location_on
                                        </span>
                                        <div>
                                            <p class="title-part">{{ trans('messages.lokasi_titik') }}</p>
                                            <p class="content-part">{{ $data->location }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            location_city
                                        </span>
                                        <div>
                                            <p class="title-part">{{ trans('messages.kota') }}</p>
                                            <p class="content-part">{{ $data->city->name }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="info">
                                        <span class="material-symbols-outlined">
                                            area_chart
                                        </span>
                                        <div>
                                            <p class="title-part">{{ trans('messages.provinsi') }}</p>
                                            <p class="content-part">{{ $data->city->province->name }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>



                            <div class=" border rounded position-relative ">
                                <div class="w-100 d-flex justify-content-start pt-3 mb-3 ">
                                    <span class="spesifikasi">{{ trans('messages.spesifikasi') }}</span>
                                </div>
                                <div class="row p-3">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="info">
                                            <span class="material-symbols-outlined">
                                                mms
                                            </span>
                                            <div>
                                                <p class="title-part">{{ trans('messages.type_media') }}</p>
                                                <p class="content-part">{{ $data->type->name }}</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="info">
                                            <span class="material-symbols-outlined">
                                                output_circle
                                            </span>
                                            <div>
                                                <p class="title-part">{{ trans('messages.sisi') }}</p>
                                                <p class="content-part">{{ $data->side }}</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4 col-sm-12">

                                        <div class="info">
                                            <span class="material-symbols-outlined">
                                                decimal_increase
                                            </span>
                                            <div>
                                                <p class="title-part">{{ trans('messages.alamat') }}</p>
                                                <p class="content-part">{{ $data->address }}</p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                        <div class="info">
                                            <span class="material-symbols-outlined">
                                                move_selection_left
                                            </span>
                                            <div>
                                                <p class="title-part">{{ trans('messages.posisi') }}</p>
                                                <p class="content-part">{{ $data->position }}</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="info">
                                            <span class="material-symbols-outlined">
                                                trending_flat
                                            </span>
                                            <div>
                                                <p class="title-part">{{ trans('messages.panjang') }}</p>
                                                <p class="content-part">{{ $data->width }}</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="info">
                                            <span class="material-symbols-outlined">
                                                arrow_upward
                                            </span>
                                            <div>
                                                <p class="title-part">{{ trans('messages.tinggi') }}</p>
                                                <p class="content-part">{{ $data->height }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="info">
                                            <span class="material-symbols-outlined">
                                                traffic
                                            </span>
                                            <div>
                                                <p class="title-part">{{ trans('messages.trafik') }}</p>
                                                <p class="content-part">
                                                    @if ($data->trafic == 0 || $data->trafic === null)
                                                        Proses Update
                                                    @else
                                                        {{ $data->trafic }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="title-content text-center">{{ trans('messages.titik_kami_yang_lain') }} {{ $data->city->name }}</p>

    <div class="list-article">

        @foreach ($titik as $d)
            <a class="card-article" href="/{{ app()->getLocale() }}/listing/{{ $d->slug }}">
                <img src="{{ $dom . $d->image2 }}" />

                <div class="article-content">
                    <div class="article-wrapper">
                        <p class="title">{{ $d->address }}</p>
                        <p class="time">{{ $d->city->province->name }}, {{ $d->city->name }}</p>
                    </div>
                </div>
            </a>
        @endforeach

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
            ScrollReveal().reveal('.detail-titik', slideUp);
        });
    </script>
@endsection
