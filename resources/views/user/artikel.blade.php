@extends('user.base')

@section('morecss')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
@endsection
@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/youseeartikel.png') }}" />
        </div>
        <div class="article-headline">
            <div class="article-content">
                <div class="article-wrapper">
                    <p class="title">{{ $newArtikel->title ?? 'Belum ada artikel' }}</p>
                    <p class="time">
                        {{ $newArtikel != null ? date_format($newArtikel->created_at, 'd M Y H:m') : 'Tidak ada tanggal' }}
                    </p>
                    <hr>
                    <div class="isi">{!! $newArtikel->content ?? 'Belum ada isi artikel' !!}
                    </div>
                </div>
                <div class="btn-wrapper">
                    @if ($newArtikel != null)
                        <a href="{{ route('article.detail', ['slug' => $newArtikel->slug]) }}">Baca Selengkapnya</a>
                    @endif
                </div>
            </div>
            <img src="{{ asset($newArtikel->image ?? 'images/local/login.jpg') }}" />
        </div>


        <p class="title-content ">Semua Artikel yang Kami Sajikan</p>

        <div class="search-wrapper">
            <div class="search-field">
                <span class="material-symbols-outlined text-grey">
                    search
                </span>
                <input type="text" placeholder="Pencarian Artikel" />

            </div>
        </div>

        <div class="list-article">

            {{--            @for ($i = 0; $i < 20; $i++) --}}
            {{--                <div class="card-article"> --}}
            {{--                    <img src="{{ asset('images/local/login.jpg') }}"/> --}}

            {{--                    <div class="article-content"> --}}
            {{--                        <div class="article-wrapper"> --}}
            {{--                            <p class="title">Judul Artikel, Judul Artikel, Judul Artikel, </p> --}}
            {{--                            <p class="time">12 Feb 2024 16:13</p> --}}
            {{--                            <hr> --}}

            {{--                            <div class="btn-wrapper"> --}}
            {{--                                <a href="/detailartikel/slug-artikel"><span>Baca Selengkapnya</span><span --}}
            {{--                                        class="material-symbols-outlined"> --}}
            {{--                                        arrow_right_alt --}}
            {{--                                    </span></a> --}}
            {{--                            </div> --}}
            {{--                        </div> --}}
            {{--                    </div> --}}
            {{--                </div> --}}
            {{--            @endfor --}}

            @foreach ($data as $key => $d)
                <div class="card-article">
                    <img src="{{ asset($d->image) }}" />
                    <div class="article-content">
                        <div class="article-wrapper">
                            <p class="title">{{ $d->title }}</p>
                            <p class="time">{{ date_format($d->created_at, 'd M Y H:m') }}</p>
                            <hr>

                            <div class="btn-wrapper">
                                <a href="{{ route('article.detail', ['slug' => $d->slug]) }}"><span>Baca
                                        Selengkapnya</span><span class="material-symbols-outlined">
                                        arrow_right_alt
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $data->links() }}
        </div>

    </div>
@endsection
