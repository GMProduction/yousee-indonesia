@extends('user.base')

@section('header')
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="og:image" content="">
    <meta name="og:site_name" content="">
    <meta name="og:description" content="">
    <meta name="og:title" content="{{$article ? $article->title : ''}}">
@endsection
@section('morecss')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
@endsection
@section('content')
    <div class="g-hero">
        <div class="hero-text">
            <img src="{{ asset('images/local/youseeartikel.png') }}" />
        </div>
        <div class="article-full">
            <div class="article-content">
                <div class="article-wrapper">
                    <img src="{{ $article->image }}" />

                    <h3 class="title">{{$article->title}}</h3>
                    <p class="time">{{date_format($article->created_at, 'd M Y H:m')}}</p>
                    <hr>
                    <p class="isi">{!! $article->content !!}
                    </p>

                    <p class="text-start mt-5 fw-bold">Tags: </p>
                    <div class="tag-wrapper">
                        @foreach($article->text_tag as $d)
                            <a class="tag-artikel" href="{{route('article.tag',['tag' => $d])}}">{{$d}}</a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>


        <p class="title-content ">Baca Juga Artikel yang lain</p>

        <div class="search-wrapper">
            <div class="search-field">
                <span class="material-symbols-outlined text-grey">
                    search
                </span>
                <input type="text" placeholder="Pencarian Artikel" />

            </div>
        </div>

        <div class="list-article">

            @for ($i = 0; $i < 20; $i++)
                <div class="card-article">
                    <img src="{{ asset('images/local/login.jpg') }}" />

                    <div class="article-content">
                        <div class="article-wrapper">
                            <p class="title">Judul Artikel, Judul Artikel, Judul Artikel, </p>
                            <p class="time">12 Feb 2024 16:13</p>
                            <hr>

                            <div class="btn-wrapper">
                                <a href="/detailartikel/slug-artikel"><span>Baca Selengkapnya</span><span
                                        class="material-symbols-outlined">
                                        arrow_right_alt
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor

        </div>
    @endsection
